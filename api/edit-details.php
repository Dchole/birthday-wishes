<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Access-Control-Allow-Origin, Authorization, X-Requested-With");
header("Content-Type: application/json");

include_once "../config/Database.php";
include_once "../models/Member.php";

$database = new Database();
$db = $database->connect();

$member = new Member($db);

$data = json_decode(file_get_contents("php://input"));

$member->id = $data->id;
$member->firstName = $data->firstName;
$member->lastName = $data->lastName;
$member->email = $data->email;
$member->dob = $data->dob;

if ($member->updateOne()) {
    echo json_encode(array("message" => "Details edited Successfully."));
} else {
    echo json_encode(array("message" => "Submission Failed!"));
}