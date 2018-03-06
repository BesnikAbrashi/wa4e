<?php 

session_start();
require_once "pdo.php";

if ( ! isset($_SESSION['email']) ) {
    die('Not logged in');
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
            
            if ( isset($_SESSION['success']) ) {
                echo('<p style="color: green;">'.htmlentities($_SESSION['success'])."</p>\n");
                unset($_SESSION['success']);
            }
            
            ?>
            
            <h2>Automobiles</h2>
            <ul>
            <?php
                $stmt = $pdo->query("SELECT DISTINCT make, year, mileage FROM autos ORDER BY make");
                while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
                    echo "<li>";
                    echo(htmlentities($row['make']));
                    echo " ";
                    echo(htmlentities($row['year']));
                    echo " / ";
                    echo(htmlentities($row['mileage']));
                    echo("</li>\n");
                }
            ?>
            </ul>
            <div>
               <a href="add.php">Add New</a> |
               <a href="logout.php">Logout</a>
            </div>
        </div>
    </body>
</html>