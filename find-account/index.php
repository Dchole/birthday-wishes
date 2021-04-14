<?php
include_once "../config/Database.php";
include_once "../models/Member.php";
include_once "../lib/Sender.php";
include_once "../utils/sanitize.php";
include_once "../utils/redirect.php";
include_once "../utils/parse-user.php";

session_start();

if (isset($_GET["account"])) {

  $database = new Database();
  $db = $database->connect();

  $member = new Member($db);

  $member->account = $_GET["account"];

  $member->readOne();

  $member_arr = parseUser($member);

  if ($member_arr["account"]) {
    $confirmationCode = random_int(1000, 9999);

    $sender = new Sender($member->account, $member->channel);
    $sender->sendMessage("Confirmation Code: $confirmationCode", true);

    $_SESSION["confirmation_code"] = $confirmationCode;
    $_SESSION["user"] = $member_arr;
    redirect("confirmation");
  } else {
    echo "<p>No Account Match</p>";
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
    <h2>Enter Account Address</h2>
    <form id="edit-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <div class="form-control">
        <label for="account">Account</label>
        <input type="text" id="account" name="account" autofocus required />
      </div>
      <button>Submit</button>
    </form>
  </main>
</body>

</html>