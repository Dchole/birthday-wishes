<?php
include_once "../config/api-key.php";

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
    $token = apiKey();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        array(
            "Authorization: App $token",
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
        return $response;
    }

    curl_close($ch);
}
