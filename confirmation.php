<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Confirm Your Account</title>
  </head>
  <body>
    <h1>Confirm your account</h1>
    <main>
      <h2>Enter the confirmation code</h2>
      <form id="edit-form" action="confirmation-code.php" method="POST">
        <div>
          <label for="code">Confirmation Code</label>
          <input type="text" id="code" name="code" required />
        </div>
        <button>Submit</button>
      </form>
    </main>
  </body>
</html>