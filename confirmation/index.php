<?php
include_once "../config/Database.php";
include_once "../models/Member.php";
include_once "../utils/sanitize.php";
include_once "../utils/redirect.php";

session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $code = sanitize_input($_POST["code"]);

  if (intval($code) == $_SESSION["confirmation_code"]) {
    $database = new Database();
    $db = $database->connect();

    $member = new Member($db);
    $member->account = $_SESSION["account"];

    if ($_SESSION["user"]) redirect("edit-account-details");
    elseif ($_SESSION["deleting_user"]) {
      $member->deleteOne();
      echo `<p>Unsubscribed Successfully! <span role="img" aria-label="">✅</span></p>`;
      $_SESSION["deleting_user"] = false;
    } else {
      $member->confirm();
      echo `<p>Confirmed <span role="img" aria-label="">✅</span></p>`;
    }
  } else {
    echo `<p>Error: Wrong Code cross <span role="img" aria-label="">❌</span></p>`;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include_once "../templates/head.html" ?>
  <title>Confirm Your Account</title>
</head>

<body>
  <?php include_once "../templates/header.html" ?>
  <main>
    <h2>Confirm your account</h2>
    <form id="confirmation-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
      <div class="form-control">
        <label for="code">Confirmation Code</label>
        <input type="text" id="code" name="code" autocomplete="off" autofocus required />
      </div>
      <button>Submit</button>
    </form>
  </main>
</body>

</html>