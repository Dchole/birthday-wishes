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

  if ($member_arr["id"]) {
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
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Find Account</title>
  <link rel="stylesheet" href="../static/styles/main.css" />
</head>

<body>
  <h1 class="srOnly">Find Account</h1>
  <main>
    <h2>Enter Account Address</h2>
    <form id="edit-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <div>
        <label for="account">Account</label>
        <input type="text" id="account" name="account" autofocus required />
      </div>
      <button>Submit</button>
    </form>
  </main>
</body>

</html>