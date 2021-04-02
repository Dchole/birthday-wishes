<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once "../config/Database.php";
include_once "../models/Member.php";

$database = new Database();
$db = $database->connect();

$member = new Member($db);

$member->id = isset($_GET["id"]) ? $_GET["id"] : die();

$member->readOne();

$member_arr = array(
    "firstName" => $member->firstName,
    "lastName" => $member->lastName,
    "email" => $member->email,
    "dob" => $member->dob
);

print_r(json_encode($member_arr));
