<?php
function sendSMS($message, $recipient)
{

    $ch = curl_init();

    $data = [
        "messages" => [
            [
                "from" => "InfoSMS",
                "destinations" => [
                    [
                        "to" => $recipient
                    ]
                ],
                "text" => $message
            ]
        ]
    ];

    $url = "https://9rvwlr.api.infobip.com/sms/1/text/advanced";

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        array(
            'Authorization: App 0a588f9954bf98da2c21c8a818b540ca-68a60945-5673-427f-a511-33f6928585c3',
            'Content-Type: application/json',
            'Accept: application/json'
        ),
    );
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


    $response = curl_exec($ch);

    if ($e = curl_error($ch)) {
        echo $e;
    } else {
        echo "<pre>$response</pre>";
    }

    curl_close($ch);
}
