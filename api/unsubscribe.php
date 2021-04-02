<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Access-Control-Allow-Origin, Authorization, X-Requested-With");
header("Content-Type: application/json");

include_once "../config/Database.php";
include_once "../models/Member.php";

$database = new Database();
$db = $database->connect();

$member = new Member($db);

$data = json_decode(file_get_contents("php://input"));

$member->id = $data->id;

if ($member->deleteOne()) {
    echo json_encode(array("message" => "Subscription Cancelled."));
} else {
    echo json_encode(array("message" => "Submission Failed!"));
}
