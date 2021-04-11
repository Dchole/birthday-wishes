<?php
include_once "../config/Database.php";
include_once "../models/Member.php";
include_once "../utils/sanitize.php";

session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $code = sanitize_input($_POST["code"]);

  if (intval($code) == $_SESSION["confirmation_code"]) {
    echo "<p>Confirmed</p>";
  } else {
    echo "<p>Error: Wrong Code</p>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../static/styles/main.css" />
  <title>Confirm Your Account</title>
</head>

<body>
  <h1 class="srOnly">Confirm your account</h1>
  <main>
    <h2>Enter the confirmation code</h2>
    <form id="confirmation-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
      <div>
        <label for="code">Confirmation Code</label>
        <input type="text" id="code" name="code" autocomplete="off" autofocus required />
      </div>
      <button>Submit</button>
    </form>
  </main>
</body>

</html>