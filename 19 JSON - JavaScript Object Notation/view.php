<?php 

require_once "pdo.php";
require_once "util.php";

session_start();

// Load up the profile in question

// Handle the incoming data

if ( isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['headline']) && isset($_POST['summary']) ){
    
    $msg = validateProfile();
    
    if ( is_string($msg) ) {
        $_SESSION['error'] = $msg;
        header("Location: edit.php?profile_id=" . $_REQUEST["profile_id"]);
        return;
    }
    
    // Validate position entires if present
    $msg = validatePos();
    
    if ( is_string($msg) ) {
        $_SESSION['error'] = $msg;
        header("Location: edit.php?profile_id=" . $_REQUEST["profile_id"]);
        return;
    }
}

// Load up the position and education rows

    $positions = loadPos($pdo, $_REQUEST['profile_id']);
    $schools = loadEdu($pdo, $_REQUEST['profile_id']);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Besnik Abrashi - Profile Information</title>
        <?php require_once "head.php"; ?>
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
                    $edu = 0;
                    echo "<p>Education: ";
                    foreach( $schools as $school ) {
                        $edu++;                        
                        echo "<ul>";
                        echo "<li>";
                        echo(htmlentities($school['year']));
                        echo " : ";
                        echo(htmlentities($school['name']));
                        echo "</li>";
                        echo "</ul>";
                    }
                
                    $pos = 0;
                    echo "<p>Position: ";
                    foreach( $positions as $position ) {
                        $pos++;                        
                        echo "<ul>";
                        echo "<li>";
                        echo(htmlentities($position['year']));
                        echo " : ";
                        echo(htmlentities($position['description']));
                        echo "</li>";
                        echo "</ul>";
                    }
                }
            ?>
            <div>
               <a href="index.php">Done</a> 
            </div>
        </div>
    </body>
</html>