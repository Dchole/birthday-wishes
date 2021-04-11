<?php
function parseUser($member)
{
    $member_arr = array(
        "firstName" => $member->firstName,
        "lastName" => $member->lastName,
        "account" => $member->account,
        "channel" => $member->channel,
        "dob" => $member->dob
    );

    return $member_arr;
}
