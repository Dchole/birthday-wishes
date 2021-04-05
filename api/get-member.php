<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once "../config/Database.php";
include_once "../models/Member.php";

$database = new Database();
$db = $database->connect();

$member = new Member($db);

$member->account = isset($_GET["account"]) ? $_GET["account"] : die();

$member->readOne();

$member_arr = array(
    "id" => $member->id,
    "firstName" => $member->firstName,
    "lastName" => $member->lastName,
    "account" => $member->account,
    "channel" => $member->channel,
    "dob" => $member->dob
);

print_r(json_encode($member_arr));
