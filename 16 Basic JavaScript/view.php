<?php 

session_start();
require_once "pdo.php";

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Besnik Abrashi - Profile Information</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <h1>Profile Information</h1>
            
            <?php
            
            if ( isset($_SESSION['success']) ) {
                echo('<p style="color: green;">'.htmlentities($_SESSION['success'])."</p>\n");
                unset($_SESSION['success']);
            }
            
            ?>
            
            <?php
                $stmt = $pdo->query("SELECT DISTINCT profile_id, first_name, last_name, email, headline, summary FROM Profile");
                while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
                    echo "<p>First Name: ";
                    echo(htmlentities($row['first_name']));
                    echo "</p>";
                    echo "<p>Last Name: ";
                    echo(htmlentities($row['last_name']));
                    echo "</p>";
                    echo "<p>Email: ";
                    echo(htmlentities($row['email']));
                    echo "</p>Headline: ";
                    echo "<p>";
                    echo(htmlentities($row['headline']));
                    echo "</p>Summary: ";
                    echo "<p>";
                    echo(htmlentities($row['summary']));
                    echo "</p>";
                }
            ?>
            <div>
               <a href="index.php">Done</a> 
            </div>
        </div>
    </body>
</html>