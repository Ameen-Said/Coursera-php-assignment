
<?php
session_start();
require_once("pdo.php");


if (isset($_SESSION['username']) && isset($_SESSION['pass'])) {
    $username = $_SESSION['username'];
} else{
    die("Not logged in");
}



$sql2 = "SELECT * FROM autos";
$stmt2 = $pdo->prepare($sql2);
$stmt2->execute();
$result2 = $stmt2->fetchAll(PDO :: FETCH_ASSOC)




?>
<!DOCTYPE html>
<html>
<head>
<title>Chuck Severance's Index Page</title>

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
    <h2>Welcome to the Automobiles Database</h2>
     <?php if (isset($_SESSION['data_insert']) && $_SESSION['data_insert'] == true) {
    echo "<span style='color: green;'>" . htmlspecialchars("Record added.") . "</span>";
	$_SESSION['data_insert'] = false;
     }
    if (isset($_SESSION['updated']) && $_SESSION['updated'] == true) {
        echo "<span style='color: green;'>" . htmlspecialchars("Data updated") . "</span>";
        $_SESSION['updated'] = false;}

        if (isset($_SESSION['data_deleted']) && $_SESSION['data_deleted'] == true) {
            echo "<span style='color: green;'>" . htmlspecialchars("Record deleted") . "</span>";
            $_SESSION['data_deleted'] = false;
} ?>
 
        <?php 
            if ($result2 == false) {
                echo "<p>No rows found</p>";
            } else {
                echo '   <table border="1">
                <thead>
                    <tr>
                        <th>Make</th>
                        <th>Model</th>
                        <th>Year</th>
                        <th>Mileage</th>
                        <th>Action</th>
                    </tr>
                </thead>';
              
                foreach ($result2 as $row) {
                   
                   echo ' <tr>
                        <td>' . $row['make'] . '</td>
                        <td>' . $row['model'] . '</td>
                        <td>' . $row['year'] . '</td>
                        <td>' . $row['mileage'] . '</td>
                        <td>
                            <a href="edit.php?autos_id=' . $row['autos_id'] . '">Edit</a> / 
                            <a href="delete.php?autos_id=' . $row['autos_id'] . '">Delete</a>
                        </td>
                    </tr>';
                }
            }
        ?>
       
    </table>


<p><a href="add.php">Add New Entry</a></p>
<p><a href="logout.php">Logout</a></p>
<p>
<b>Note:</b> Your implementation should retain data across multiple 
logout/login sessions.  This sample implementation clears all its
data on logout - which you should not do in your implementation.
</p>

</div>
</body>



