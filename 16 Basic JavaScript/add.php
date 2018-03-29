<?php 

session_start();
require_once "pdo.php";

if ( ! isset($_SESSION['email']) ) {
    die('ACCESS DENIED');
}

if ( isset($_POST['cancel']) ) {
    header("Location: index.php");
    return;
}

if (isset($_POST['add'])) {
    if ( ! isset($_POST['first_name']) || strlen($_POST['first_name']) < 1 || ! isset($_POST['last_name']) || strlen($_POST['last_name']) < 1 || ! isset($_POST['email']) || strlen($_POST['email']) < 1 || ! isset($_POST['headline']) || strlen($_POST['headline']) < 1 || ! isset($_POST['summary']) || strlen($_POST['summary']) < 1   ) {
        $_SESSION["error"] = "All fields are required.";
        header( 'Location: add.php' ) ;
        return;
    }
    else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Email must have an at-sign (@)"; 
        header("Location: add.php");
        return;
    }
    else {     
        $stmt = $pdo->prepare('INSERT INTO profile
        (user_id, first_name, last_name, email, headline, summary) 
        VALUES ( :uid, :fn, :ln, :em, :he, :su)');
    $stmt->execute(array(
        ':uid' => $_SESSION['user_id'],
        ':fn' => $_POST['first_name'],
        ':ln' => $_POST['last_name'],
        ':em' => $_POST['email'],
        ':he' => $_POST['headline'],
        ':su' => $_POST['summary'])
    );
        $_SESSION['success'] = "Profile added";
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
            <h1>Adding Profile for <?php
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
                <p>First Name:
                <input type="text" name="first_name" size="60"/></p>
                <p>Last Name:
                <input type="text" name="last_name" size="60"/></p>
                <p>Email:
                <input type="text" name="email" size="30"/></p>
                <p>Headline:<br/>
                <input type="text" name="headline" size="80"/></p>
                <p>Summary:<br/>
                <textarea name="summary" rows="8" cols="80"></textarea>
                <p>
                <input type="submit" name="add" value="Add">
                <input type="submit" name="cancel" value="Cancel">
                </p>
            </form>
            
        </div>
    </body>
</html>