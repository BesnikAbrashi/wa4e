<?php 
require_once "pdo.php";
session_start();

if ( isset($_POST['cancel'] ) ) {
    // Redirect the browser to game.php
    header("Location: index.php");
    return;
}


if ( isset($_POST['profile_id']) && isset($_POST['first_name']) && isset($_POST['last_name'])
     && isset($_POST['email']) && isset($_POST['headline']) && isset($_POST['summary'])  ) {

    // Data validation
    if ( strlen($_POST['first_name']) < 1 || strlen($_POST['last_name']) < 1 || strlen($_POST['email']) < 1 || strlen($_POST['headline']) < 1 || strlen($_POST['summary']) < 1 ) {
        $_SESSION['error'] = 'Missing data';
        header("Location: edit.php?profile_id=".$_POST['profile_id']);
        return;
    }
    
    elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Email must have an at-sign (@)"; 
        header("Location: edit.php?profile_id=" . $_POST["profile_id"]);
        return;
    }
    
    else {

        $sql = "UPDATE profile SET first_name = :first_name,
                last_name = :last_name, email = :email,
                headline = :headline,
                summary = :summary
                WHERE profile_id = :profile_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':profile_id' => $_POST['profile_id'],
            ':first_name' => $_POST['first_name'],
            ':last_name' => $_POST['last_name'],
            ':email' => $_POST['email'],
            ':headline' => $_POST['headline'],
            ':summary' => $_POST['summary']));
        $_SESSION['success'] = 'Profile updated';
        header( 'Location: index.php' ) ;
        return;
    }
}

// Guardian: Make sure that profile_id is present
if ( ! isset($_GET['profile_id']) ) {
  $_SESSION['error'] = "Missing profile_id";
  header('Location: index.php');
  return;
}

$stmt = $pdo->prepare("SELECT * FROM profile where profile_id = :xyz");
$stmt->execute(array(":xyz" => $_GET['profile_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
    $_SESSION['error'] = 'Bad value for profile_id';
    header( 'Location: index.php' ) ;
    return;
}

// Flash pattern
if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}

$profile_id = $row['profile_id'];
$fn = htmlentities($row['first_name']);
$ln = htmlentities($row['last_name']);
$em = htmlentities($row['email']);
$he = htmlentities($row['headline']);
$su = htmlentities($row['summary']);

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Besnik Abrashi - Edit Page</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <h1>Editing Profile for <?php
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
                <input type="text" name="first_name" size="60" value="<?= $fn ?>" /></p>
                <p>Last Name:
                <input type="text" name="last_name" size="60" value="<?= $ln ?>" /></p>
                <p>Email:
                <input type="text" name="email" size="30" value="<?= $em ?>" /></p>
                <p>Headline:<br/>
                <input type="text" name="headline" size="80" value="<?= $he ?>" /></p>
                <p>Summary:<br/>
                <textarea name="summary" rows="8" cols="80"><?= $su ?></textarea>
                <p>
                <input type="hidden" name="profile_id" value="<?= $profile_id ?>" />
                <input type="submit" name="add" value="Save">
                <input type="submit" name="cancel" value="Cancel">
                </p>
            </form>
            
        </div>
    </body>
</html>