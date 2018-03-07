<?php

require_once "pdo.php";
session_start();

?>

<!DOCTYPE html>
<html>
<head>
<title>Besnik Abrashi - Index Page</title>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

    <style>
        th, td {
            padding: 5px;
        }
        
    </style>
</head>

<body>
    <div class="container">
        <h2>Welcome to the Automobiles Database</h2>
        <?php
        
        if ( ! isset($_SESSION['email']) )  {
        
            echo('<p><a href="login.php">Please log in</a></p>');;
            echo('<p>Attempt to <a href="add.php">add data</a> without logging in</p>');
        }
        
        
        else {
            
        if ( isset($_SESSION['error']) ) {
            echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
            unset($_SESSION['error']);
        }
        if ( isset($_SESSION['success']) ) {
            echo '<p style="color:green">'.$_SESSION['success']."</p>\n";
            unset($_SESSION['success']);
        }
        echo('<table border="1">'."\n");
        echo "<tr><th>Make</th><th>Model</th><th>Year</th><th>Mileage</th><th>Action</th>";
        $stmt = $pdo->query("SELECT auto_id, make, model, year, mileage FROM autos");
        while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
            
            echo "<tr><td>";
            echo(htmlentities($row['make']));
            echo("</td><td>");
            echo(htmlentities($row['model']));
            echo("</td><td>");
            echo(htmlentities($row['year']));
            echo("</td><td>");
            echo(htmlentities($row['mileage']));
            echo("</td><td>");
            echo('<a href="edit.php?auto_id='.$row['auto_id'].'">Edit</a> / ');
            echo('<a href="delete.php?auto_id='.$row['auto_id'].'">Delete</a>');
            echo("</td></tr>\n");    
        }
        echo('</table>');
        
        echo('<br/>');
        echo('<form>');
        echo('<a href="add.php">Add New Entry</a>');
        echo('<br/>');
        echo('<br/>');
        echo('<a href="logout.php">Logout</a>');
        echo('</form>');
        }
        ?>
    </div>
</body>