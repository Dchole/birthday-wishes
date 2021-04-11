<?php
include_once "../config/Database.php";
include_once "../models/Member.php";
include_once "../lib/Sender.php";
include_once "../utils/format-date.php";

$database = new Database();
$db = $database->connect();

$member = new Member($db);

$result = $member->read();

$num = $result->rowCount();

if ($num > 0) {
    $members_arr = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        if (date("d-m") == formatDate($dob) && $confirmed) {
            $sender = new Sender($account, $channel);
            $sender->sendMessage("Happy Birthday!!!");
        }
    }
} else {
    echo "<h1>No subscribed members</h1>";
}
