<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Account Details</title>
</head>

<body>
  <h1>Edit Details</h1>
  <main>
    <h2>Enter Account Address</h2>
    <form id="edit-form" action="find-account.php" method="POST">
      <div>
        <label for="account">Account</label>
        <input type="text" id="account" name="account" required />
      </div>
      <button>Submit</button>
    </form>
  </main>
</body>

</html>