<?php
session_start();
require_once('pdo.php');

$empty_username = false;
$incorrect_pass = false;
$email_check = false;
$pass = "";
$username = "";

if (isset($_POST['email']) && isset($_POST['pass'])) {
    if ($_POST['email'] == "" || $_POST['pass'] == "") {
        $empty_username = true;
    } else {
        if (strpos($_POST['email'], "@")) {
            $username = $_POST['email'];
            $pass = $_POST['pass'];
        } else {
            $email_check = true;
        }
    }
}

$stored_hash = md5("php123"); // Replace this with the actual stored hash value

if ($pass !== "") {
    $hashedpass = md5($pass);
    if ($hashedpass == $stored_hash) {
		$_SESSION['username'] = $_POST['email'];
		$_SESSION['pass'] = $hashedpass;
        header("Location: index.php");
        error_log("Login success " . $_POST['email']);
        return;
    } else {
        $incorrect_pass = true;
        error_log("Login fail " . $_POST['email'] . " $hashedpass");
    }
}

?>






<!DOCTYPE html>
<html>
<head>
<title>Ameen Mohammad Said's Login Page</title>

<link rel="stylesheet" 
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" 
    integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" 
    crossorigin="anonymous">

<link rel="stylesheet" 
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" 
    integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" 
    crossorigin="anonymous">

<link rel="stylesheet" 
    href="https://code.jquery.com/ui/1.12.1/themes/ui-lightness/jquery-ui.css">

<script
  src="https://code.jquery.com/jquery-3.2.1.js"
  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous"></script>

<script
  src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
  integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30="
  crossorigin="anonymous"></script>

</head>
<body>
<div class="container">
<h1>Please Log In</h1>
<?php
if ($empty_username) {
    echo "<span style='color: red;'>" . htmlspecialchars("User name and password are required") . "</span>";
} elseif ($incorrect_pass) {
    echo "<span style='color: red;'>" . htmlspecialchars("Incorrect password") . "</span>";
} elseif ($email_check) {
    echo "<span style='color: red;'>" . htmlspecialchars("Email must have an at-sign (@)") . "</span>";
}
?>
<form method="POST" action="login.php">
<label for="nam">User Name</label>
<input type="text" name="email" id="nam"><br/>
<label for="id_1723">Password</label>
<input type="password" name="pass" id="id_1723"><br/>
<input type="submit" value="Log In">
<a href="autoscrud.php">Cancel</a></p>
</form>
<p>
For a password hint, view source and find a password hint
in the HTML comments.
<!-- Hint: The password is the three character name of the
programming language used in this class (all lower case)
followed by 123. -->
</p>
</div>
</body>
