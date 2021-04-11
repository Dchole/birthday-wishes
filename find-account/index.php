<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Account Details</title>
  <link rel="stylesheet" href="./static/styles/main.css" />
  <script src="static/scripts/requests/find-user.js" type="module" defer></script>
</head>

<body>
  <h1 class="srOnly">Edit Details</h1>
  <main>
    <h2>Enter Account Address</h2>
    <form id="edit-form" action="#">
      <div>
        <label for="account">Account</label>
        <input type="text" id="account" name="account" autofocus required />
      </div>
      <button>Submit</button>
    </form>
  </main>
</body>

</html>