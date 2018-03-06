<?php 

session_start();
require_once "pdo.php";

if ( ! isset($_SESSION['email']) ) {
    die('Not logged in');
}

if ( isset($_POST['logout']) ) {
    header("Location: view.php");
    return;
}

if (isset($_POST['add'])) {
    if ( ! isset($_POST['make']) || strlen($_POST['make']) < 1  ) {
        $_SESSION["error"] = "Make is required.";
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
            (make, year, mileage) VALUES ( :mk, :yr, :mi)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':mk' => $_POST['make'],
            ':yr' => $_POST['year'],
            ':mi' => $_POST['mileage'])
        );
        $_SESSION['success'] = "Record inserted";
        header("Location: view.php");
        return;
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Besnik Abrashi - Autos Database</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <h1>Tracking Autos for <?php
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
                <p>Make: <input type="text" name="make" size="60" /></p>
                <p>Year: <input type="text" name="year" /></p>
                <p>Mileage: <input type="text" name="mileage" /></p>
                <input type="submit" name="add" value="Add" />
                <input type="submit" name="logout" value="Cancel" />
            </form>
            
        </div>
    </body>
</html>