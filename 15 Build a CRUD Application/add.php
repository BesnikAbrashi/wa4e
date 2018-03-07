<?php 

session_start();
require_once "pdo.php";

if ( ! isset($_SESSION['email']) ) {
    die('ACCESS DENIED');
}

if ( isset($_POST['logout']) ) {
    header("Location: index.php");
    return;
}

if (isset($_POST['add'])) {
    if ( ! isset($_POST['make']) || strlen($_POST['make']) < 1 || ! isset($_POST['model']) || strlen($_POST['model']) < 1 || ! isset($_POST['year']) || strlen($_POST['year']) < 1 || ! isset($_POST['mileage']) || strlen($_POST['mileage']) < 1  ) {
        $_SESSION["error"] = "All fields are required.";
        header( 'Location: add.php' ) ;
        return;
    }
    else if ( ! is_numeric($_POST['year']) || ! is_numeric($_POST['mileage']) ) {
        $_SESSION["error"] = "Mileage and year must be numeric";
        header( 'Location: add.php' ) ;
        return;
    } 
    else {     
        $sql = "INSERT INTO autos
            (make, model, year, mileage) VALUES ( :mk, :md, :yr, :mi)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':mk' => $_POST['make'],
            ':md' => $_POST['model'],
            ':yr' => $_POST['year'],
            ':mi' => $_POST['mileage'])
        );
        $_SESSION['success'] = "Record added";
        header("Location: index.php");
        return;
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Besnik Abrashi - Add Page</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <h1>Tracking Automobiles for <?php
                 if ( isset($_SESSION['email']) ) {
                    echo(htmlentities($_SESSION['email']));
                }
                ?>
            </h1>
            <?php
                if ( isset($_SESSION['error']) ) {
                echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
                unset($_SESSION['error']);
            }
            ?>
            <form method="post">
                <p>Make: <input type="text" name="make" size="40" /></p>
                <p>Model: <input type="text" name="model" size="40" /></p>
                <p>Year: <input type="text" name="year"  size="10" /></p>
                <p>Mileage: <input type="text" name="mileage" size="10" /></p>
                <input type="submit" name="add" value="Add" />
                <input type="submit" name="logout" value="Cancel" />
            </form>
            
        </div>
    </body>
</html>