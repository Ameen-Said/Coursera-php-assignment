<?php
session_start();
require_once("pdo.php");

if (isset($_SESSION['username']) && isset($_SESSION['pass'])) {
    $username = $_SESSION['username'];
} else{
    die("Not logged in");
}


if (isset($_GET['autos_id']) && !empty($_GET['autos_id'])) {
    $autos_id = $_GET['autos_id'];

    $stmt = $pdo->prepare("DELETE FROM autos WHERE autos_id = :autos_id");
    $stmt->bindParam(':autos_id', $autos_id);
    if(isset($_POST['delete'])){
    $stmt->execute();
    
    header("Location: index.php"); 
    return;

    }

}

$_SESSION['data_deleted'] = true;
?>
<html>
<head>
<title>Deleting...</title>

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

<p>Confirm: Deleting ameen</p>
<form method="post"><input type="hidden" name="autos_id" value="0"> <input type="submit" value="Delete" name="delete"><a href="index.php">Cancel</a>
</form>
</div>
</body>
