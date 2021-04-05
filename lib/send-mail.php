<?php
define('MULTIPART_BOUNDARY', '----' . md5(time()));
define('EOL', "\r\n"); // PHP_EOL cannot be used for emails we need the CRFL '\r\n'

function getBodyPart($FORM_FIELD, $value)
{
    if ($FORM_FIELD === 'attachment') {
        $content = 'Content-Disposition: form-data; name="' . $FORM_FIELD . '"; filename="' . basename($value) . '"' . EOL;
        $content .= 'Content-Type: ' . mime_content_type($value) . EOL;
        $content .= 'Content-Transfer-Encoding: binary' . EOL;
        $content .= EOL . file_get_contents($value) . EOL;
    } else {
        $content = 'Content-Disposition: form-data; name="' . $FORM_FIELD . '"' . EOL;
        $content .= EOL . $value . EOL;
    }

    return $content;
}

/*
 * Method to convert an associative array of parameters into the HTML body string
*/
function getBody($fields)
{
    $content = '';
    foreach ($fields as $FORM_FIELD => $value) {
        $values = is_array($value) ? $value : array($value);
        foreach ($values as $v) {
            $content .= '--' . MULTIPART_BOUNDARY . EOL . getBodyPart($FORM_FIELD, $v);
        }
    }
    return $content . '--' . MULTIPART_BOUNDARY . '--'; // Email body should end with "--"
}

/*
 * Method to get the headers for a basic authentication with username and passowrd
*/
function getHeader($username, $password)
{
    // basic Authentication
    $auth = base64_encode("$username:$password");

    // Define the header
    return array('Authorization:Basic ' . $auth, 'Content-Type: multipart/form-data ; boundary=' . MULTIPART_BOUNDARY);
}

function sendMail($message, $recipient, $confirmation)
{

    $url = "";

    // Associate Array of the post parameters to be sent to the API
    $postData = array(
        "from" => "umatBunny@selfserviceib.com",
        "to" => $recipient,
        "subject" => $confirmation ? "Verify Email" : "Happy Birthday",
        "text" => $message,
        "html" => '
<h1>HAPPY BIRTHDAY!!!</h1>
Special Happy birthday wishes :D

',
    );

    // Create the stream context.
    $context = stream_context_create(array(
        'http' => array(
            'method' => 'POST',
            'header' => getHeader('umatBunny', 'jwsz3vd.WG_*3EN'),
            'content' =>  getBody($postData),
        )
    ));

    // Read the response using the Stream Context.
    $response = file_get_contents($url, false, $context);
    echo $response;
}
