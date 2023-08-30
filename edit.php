<?php
session_start();
require_once("pdo.php");

if (isset($_POST['cancel']) && $_POST['cancel'] == true) {
    header("Location: index.php");
    return;
}

if (isset($_SESSION['username']) && isset($_SESSION['pass'])) {
    $username = $_SESSION['username'];
} else {
    die("Not logged in");
}

$required_data = false;
$year_check = false;
$mileage_check = false;
$data_update = false;
$year_check = false;
$_SESSION['updated'] = $data_update;

if (isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage']) && isset($_POST['model'])) {
    if ($_POST['make'] !== "" && $_POST['year'] !== "" && $_POST['mileage'] !== "" && $_POST['model'] !== "") {
        if (is_numeric($_POST['year'])) {
            if (is_numeric($_POST['mileage'])) {
                $make = $_POST['make'];
                $year = $_POST['year'];
                $mileage = $_POST['mileage'];
                $model = $_POST['model'];

                if (isset($_POST['autos_id']) && !empty($_POST['autos_id'])) {
                    $autos_id = $_POST['autos_id'];
                
                    $sql = "UPDATE autos SET make = :make, year = :year, mileage = :mileage, model = :model WHERE autos_id = :autos_id";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':make', $make);
                    $stmt->bindParam(':year', $year);
                    $stmt->bindParam(':mileage', $mileage);
                    $stmt->bindParam(':model', $model);
                    $stmt->bindParam(':autos_id', $autos_id);
                    $stmt->execute();
                    $data_update = true;
                    
                    header('Location: index.php');
                    return;
                }
            } else {
                $mileage_check = true;
            }
        } else {
            $year_check = true;
        }
    } else {
        $required_data = true;
    }
}

if (isset($_GET['autos_id']) && !empty($_GET['autos_id'])) {
    $autos_id = $_GET['autos_id'];

    $stmt = $pdo->prepare("SELECT * FROM autos WHERE autos_id = :autos_id");
    $stmt->bindParam(':autos_id', $autos_id);
    $stmt->execute();
    $selectedRow = $stmt->fetch(PDO::FETCH_ASSOC);
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Automobile</title>
    <link rel="stylesheet" 
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" 
    integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" 
    crossorigin="anonymous">

    <link rel="stylesheet" 
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" 
    integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" 
    crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Editing Automobile</h1>
        <form method="post">
        <?php 
    if($required_data == true){echo "<span style='color: red;'>" . htmlspecialchars("All fields are required") . "</span>";}
    else if ($year_check == true){echo "<span style='color: red;'>" . htmlspecialchars("Year must be numeric") . "</span>"; }
    elseif($mileage_check == true){echo  "<span style='color: red;'>" . htmlspecialchars("Mileage must be numeric") . "</span>";}
    ?>
            <p>Make: <input type="text" name="make" size="40" value="<?= htmlentities($selectedRow['make']) ?>" /></p>
            <p>Model: <input type="text" name="model" size="40" value="<?= htmlentities($selectedRow['model']) ?>" /></p>
            <p>Year: <input type="text" name="year" size="10" value="<?= htmlentities($selectedRow['year']) ?>" /></p>
            <p>Mileage: <input type="text" name="mileage" size="10" value="<?= htmlentities($selectedRow['mileage']) ?>" /></p>
            <input type="hidden" name="autos_id" value="<?= $autos_id ?>">
            <input type="submit" value="Save" >
            <input type="submit" name="cancel" value="Cancel" >
        </form>
    </div>
</body>
</html>
