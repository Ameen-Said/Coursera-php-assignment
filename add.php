<?php 
session_start();
require_once("pdo.php");

if(isset($_POST['cancel']) && $_POST['cancel'] == true){
	

	header("Location:index.php");
	return;
}

if (isset($_SESSION['username']) && isset($_SESSION['pass'])) {
    $username = $_SESSION['username'];
} else{
    die("Not logged in");
}

$required_data = false;
$year_chek = false;
$milage_check = false;
$data_insert = false;
$year_check = false;

if(isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage']) && isset($_POST['model'])){
    if($_POST['make'] !== "" && $_POST['year'] !== "" && $_POST['mileage'] !== "" && $_POST['model'] !== ""){
        if(is_numeric($_POST['year'])){
            if(is_numeric($_POST['mileage'])){
            $make = $_POST['make'];
            $year = $_POST['year'];
            $mileage = $_POST['mileage'];
            $model = $_POST['model'];
           }  else{
                    $milage_check = true;
                  }

        }else{ $year_check = true;}

    }
    else { $required_data = true; }
}

if(isset($make) && isset($year) && isset($mileage) && isset($model)){
    $sql = "INSERT INTO autos (make, year, mileage,model) VALUES (:make, :year , :mileage , :model)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':make',$make);
    $stmt->bindParam(':year',$year);
    $stmt->bindParam(':mileage',$mileage);
    $stmt->bindParam(':model',$model);
    $result = $stmt->execute();
    if($result){
	$_SESSION['data_insert'] = true;
	header("Location:index.php");
	return;
 

    }
       
}


?>

<!DOCTYPE html>
<html>
<head>
<title>Ameen Mohammad Said's Automobile Tracker</title>

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
<h1>Tracking Automobiles for <?php echo $username ?></h1>
<form method="post">
    <?php 
    if($required_data == true){echo "<span style='color: red;'>" . htmlspecialchars("All fields are required") . "</span>";}
    else if ($year_check == true){echo "<span style='color: red;'>" . htmlspecialchars("Year must be numeric") . "</span>"; }
    elseif($milage_check == true){echo  "<span style='color: red;'>" . htmlspecialchars("Mileage must be numeric") . "</span>";}
    ?>
<p>Make:

<input type="text" name="make" size="40"/></p>
<p>Model:

<input type="text" name="model" size="40"/></p>
<p>Year:

<input type="text" name="year" size="10"/></p>
<p>Mileage:

<input type="text" name="mileage" size="10"/></p>
<input type="submit" name='add' value="Add">
<input type="submit" name="cancel" value="Cancel">
</form>
<p>
</div>
<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script></body>
</html>


