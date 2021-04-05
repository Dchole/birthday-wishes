<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once "../config/Database.php";
include_once "../models/Member.php";

$database = new Database();
$db = $database->connect();

$member = new Member($db);

$result = $member->read();

$num = $result->rowCount();

if ($num > 0) {
    $members_arr = array();


    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $member_item = array(
            "id" => $id,
            "firstName" => $firstName,
            "lastName" => $lastName,
            "account" => $account,
            "channel" => $channel,
            "dob" => $dob
        );

        array_push($members_arr, $member_item);

        echo json_encode($members_arr);
    }
} else {
    echo json_encode(array('message' => "No subscribed members"));
}
