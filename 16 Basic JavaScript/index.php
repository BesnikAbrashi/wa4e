<?php

    require_once "pdo.php";
    session_start();

?>

<!DOCTYPE html>
<html>
<head>
<title>Besnik Abrashi - Resume Registry</title>

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
<h1>Besnik Abrashi's Resume Registry</h1>

    <?php
        
        if ( ! isset($_SESSION['email']) )  {
        
            echo('<p><a href="login.php">Please log in</a></p>');;
            echo('<table border="1">'."\n");
            echo "<tr><th>Name</th><th>Headline</th>";
            $stmt = $pdo->query("SELECT profile_id, first_name, last_name, headline FROM profile");
            while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {

                echo "<tr><td>";
                echo('<a href="view.php?profile_id='.$row['profile_id'].'">');
                echo(htmlentities($row['first_name']));
                echo(" ");
                echo(htmlentities($row['last_name']));
                echo('</a');
                echo("</td><td>");
                echo(htmlentities($row['headline']));
                echo("</td>");
                echo("</tr>\n");    
            }
        echo('</table>');
        }
        
        
        else {
            
            echo('<p><a href="logout.php">Log out</a></p>');;
            
            if ( isset($_SESSION['error']) ) {
                echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
                unset($_SESSION['error']);
            }
            if ( isset($_SESSION['success']) ) {
                echo '<p style="color:green">'.$_SESSION['success']."</p>\n";
                unset($_SESSION['success']);
            }     
            echo('<table border="1">'."\n");
        echo "<tr><th>Name</th><th>Headline</th><th>Action</th>";
        $stmt = $pdo->query("SELECT profile_id, first_name, last_name, headline FROM profile");
        while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
            
            echo "<tr><td>";
            echo('<a href="view.php?profile_id='.$row['profile_id'].'">');
            echo(htmlentities($row['first_name']));
            echo(" ");
            echo(htmlentities($row['last_name']));
            echo('</a');
            echo("</td><td>");
            echo(htmlentities($row['headline']));
            echo("</td><td>");
            echo('<a href="edit.php?profile_id='.$row['profile_id'].'">Edit</a> / ');
            echo('<a href="delete.php?profile_id='.$row['profile_id'].'">Delete</a>');
            echo("</td></tr>\n");    
        }
        echo('</table>');
        
        echo('<br/>');
        echo('<form>');
        echo('<a href="add.php">Add New Entry</a>');
        echo('</form>');
        }
    
        
    ?>

</div>
</body>
