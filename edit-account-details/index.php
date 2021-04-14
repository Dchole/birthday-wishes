<?php
include_once "../config/Database.php";
include_once "../models/Member.php";
include_once "../utils/parse-user.php";

session_start();

$user = $_SESSION["user"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $database = new Database();
  $db = $database->connect();

  $member = new Member($db);

  $member->firstName = $_POST["firstName"];
  $member->lastName = $_POST["lastName"];
  $member->account = $_POST["account"];
  $member->channel = $_POST["channel"];
  $member->dob = $_POST["dob"];

  if ($member->updateOne()) {
    $member_arr = parseUser($member);

    $_SESSION["user"] = $member_arr;

    echo '<p>Details Edited Successfully <span role="img" aria-label="">✅</span></p>';
  } else {
    echo json_encode(array("message" => "Submission Failed!"));
  }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <?php include_once "../templates/head.html" ?>
</head>

<body>
  <?php include_once "../templates/header.html" ?>
  <main>
    <div id="cake-banner">
      <span role="img" aria-label="birthday cake emoji">🎂</span>
    </div>
    <h2>Edit Account Details</h2>
    <form id="edit-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
      <div class="form-control">
        <label for="firstName">First Name</label>
        <input type="text" name="firstName" id="firstName" autocomplete="given-name" autocapitalize="on" value="<?php echo $user["firstName"] ?>" autofocus required />
      </div>
      <div class="form-control">
        <label for="lastName">Last Name</label>
        <input type="text" name="lastName" id="lastName" autocomplete="family-name" autocapitalize="on" value="<?php echo $user["lastName"] ?>" required />
      </div>
      <fieldset>
        <legend>Choose Messaging Channel</legend>
        <div class="channel">
          <?php
          echo  $user['channel'] == 'sms'
            ? '<input type="radio" name="channel" id="sms" value="sms" checked />'
            : '<input type="radio" name="channel" id="sms" value="sms" />'
          ?>
          <label for="sms">SMS</label>
        </div>
        <div class="channel">
          <?php
          echo $user['channel'] == 'email'
            ? '<input type="radio" name="channel" id="email" value="email" checked />'
            : '<input type="radio" name="channel" id="email" value="email" />'
          ?>
          <label for="email">Email</label>
        </div>
      </fieldset>
      <div class="form-control">
        <label for="account">Account</label>
        <input type="text" name="account" id="account" value="<?php echo $user["account"] ?>" required />
      </div>
      <div class="form-control">
        <label for="dob">Date of Birth</label>
        <input type="date" name="dob" id="dob" autocomplete="bday" value="<?php echo $user["dob"] ?>" required />
      </div>
      <button type="submit">Subscribe</button>
    </form>
  </main>
</body>

</html>