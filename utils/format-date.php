<?php
function formatDate($dob)
{
    $splitDate = explode("-", $dob);

    $month = $splitDate[1];
    $date =  $splitDate[2];

    return "$date-$month";
}
