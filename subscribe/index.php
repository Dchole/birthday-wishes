<?php
include_once "../config/Database.php";
include_once "../models/Member.php";
include_once "../lib/Sender.php";
include_once "../utils/format-date.php";
include_once "../utils/redirect.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $database = new Database();
  $db = $database->connect();

  $member = new Member($db);

  $member->firstName = $_POST["firstName"];
  $member->lastName = $_POST["lastName"];
  $member->channel = $_POST["channel"];
  $member->account = $_POST["account"];
  $member->dob = $_POST["dob"];

  if ($member->createOne()) {
    $confirmationCode = random_int(1000, 9999);

    $_SESSION["confirmation_code"] = $confirmationCode;
    $_SESSION["user"] = null;
    $_SESSION["account"] = $member->account;

    $sender = new Sender($member->account, $member->channel);
    $sender->sendMessage("Confirmation Code: $confirmationCode", true);
    redirect("confirmation");
  } else {
    echo json_encode(array("message" => "Submission Failed!"));
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include_once "../templates/head.html"; ?>
  <title>Subscribe</title>
</head>

<body>
  <?php include_once "../templates/header.html"; ?>
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