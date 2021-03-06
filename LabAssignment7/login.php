<?php
require_once "pdo.php";
if ( isset($_POST['cancel'] ) ) {
    // Redirect the browser to game.php
    header("Location: index.php");
    return;
}

$salt = 'XyZzy12*_';
$stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';  // Pw is php123

$failure = false;  // If we have no POST data

// Check to see if we have some POST data, if we do process it
if ( isset($_POST['who']) && isset($_POST['pass']) ) {
    if ( strlen($_POST['who']) < 1 || strlen($_POST['pass']) < 1 ) {
        $failure = "Email and password are required";
    } else {
      if (filter_var($_POST['who'], FILTER_VALIDATE_EMAIL)) {
        $check = hash('md5', $salt.$_POST['pass']);
        if ( $check == $stored_hash ) {
            // Redirect the browser to game.php
            error_log("Login success ".$_POST['who']);
            header("Location: autos.php?name=".urlencode($_POST['who']));
            return;
        } else {
          error_log("Login fail ".$_POST['who']." $check");
            $failure = "Incorrect password";
        }
}
    else{
      $failure ="email must have an at-sign (@)";

}


    }
}

// Fall through into the View
?>

<!DOCTYPE html>

<html lang="en">
<head>
  <title>Noor Syahirah 207542 Lab7</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
  integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css"
  integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
  <link href="starter-template.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <h1>Please Log In</h1>
  <?php
  if ( $failure !== false ) {
      echo('<p style="color: red;">'.htmlentities($failure)."</p>\n");
  }
  ?>
  <form method="POST">
    <label for="name">Email</label>
    <input type="text" name="who" id="name"><br/>
    <label for="id_1723">Password</label>
    <input type="password" name="pass" id="id_1723"><br/>
    <input type="submit" value="Log In">
    <input type="submit" name="cancel" value="Cancel">
  </form>

  <p>For a password hint, view source and find a password hint
in the HTML comments.
<!-- Hint: The password is the four character sound a cat
makes (all lower case) followed by 123. -->
</p>
  </body>
  </html>
