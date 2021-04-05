<?php
include_once "../lib/send-mail.php";
include_once "../lib/send-sms.php";

class Sender
{
    private $recipient;
    private $channel;

    function __construct($recipient, $channel)
    {
        $this->channel = $channel;
        $this->recipient = $recipient;
    }

    function sendMessage($message, $confirmation = false)
    {
        $this->channel == "sms"
            ? sendSMS($message, $this->recipient)
            : sendMail($message, $this->recipient, $confirmation);
    }

    function sendMail($message, $confirmation = false)
    {
    }
}
