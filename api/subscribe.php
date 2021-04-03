<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Access-Control-Allow-Origin, Authorization, X-Requested-With");
header("Content-Type: application/json");

include_once "../config/Database.php";
include_once "../models/Member.php";
include_once "../utils/send-message.php";

$database = new Database();
$db = $database->connect();

$member = new Member($db);

$data = json_decode(file_get_contents("php://input"));

$member->firstName = $data->firstName;
$member->lastName = $data->lastName;
$member->email = $data->email;
$member->dob = $data->dob;

if ($member->createOne()) {
    sendMessage("Hello World", "email");
    echo json_encode(array("message" => "Date Saved Successfully."));
} else {
    echo json_encode(array("message" => "Submission Failed!"));
}
