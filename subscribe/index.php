<?php

include_once "../config/Database.php";
include_once "../models/Member.php";
include_once "../lib/Sender.php";
include_once "../utils/format-date.php";

session_start();

$string = "string";

$confirmationCode = random_int(1000, 9999);
$_SESSION["confirmation_code"] = $confirmationCode;

$database = new Database();
$db = $database->connect();

$member = new Member($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $member->firstName = $_POST["firstName"];
  $member->lastName = $_POST["lastName"];
  $member->channel = $_POST["channel"];
  $member->account = $_POST["account"];
  $member->dob = formatDate($_POST["dob"]);

  header("location: /wishes/confirmation");
  // if ($member->createOne()) {
  //   $sender = new Sender($member->account, $member->channel);

  //   $confirmationCode = random_int(1000, 9999);
  //   $sender->sendMessage("Confirmation Code: $confirmationCode", true);
  //   header("location: /wishes/confirmation");
  // } else {
  //   echo json_encode(array("message" => "Submission Failed!"));
  // }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Birthday Wishes</title>
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@1,600&family=RobotoRoboto:wght@400;500&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="../static/styles/main.css" />
  <script src="static/scripts/ui.js" defer></script>
  <style>
    main {
      width: min(450px, 100%);
    }
  </style>
</head>

<body>
  <main>
    <div id="cake-banner">
      <span role="img" aria-label="birthday cake emoji">🎂</span>
    </div>
    <h1>Automatic Birthday Wishes</h1>
    <form id="subscription" action="index.php" method="POST">
      <div class="form-control">
        <label for="firstName">First Name</label>
        <input type="text" name="firstName" id="firstName" autocomplete="given-name" autocapitalize="on" autofocus required />
      </div>
      <div class="form-control">
        <label for="lastName">Last Name</label>
        <input type="text" name="lastName" id="lastName" autocomplete="family-name" autocapitalize="on" required />
      </div>
      <fieldset>
        <legend>Choose Messaging Channel</legend>
        <div class="channel">
          <input type="radio" name="channel" id="sms" value="sms" />
          <label for="sms">SMS</label>
        </div>
        <div class="channel">
          <input type="radio" name="channel" id="email" value="email" />
          <label for="email">Email</label>
        </div>
      </fieldset>
      <div class="form-control">
        <label for="account">Account</label>
        <input type="text" name="account" id="account" required />
      </div>
      <div class="form-control">
        <label for="dob">Date of Birth</label>
        <input type="date" name="dob" id="dob" autocomplete="bday" required />
      </div>
      <button type="submit">Subscribe</button>
    </form>
  </main>
</body>

</html>