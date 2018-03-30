<?php
require_once "pdo.php";
session_start();

if ( ! isset($_SESSION['email']) ) {
    die('ACCESS DENIED');
}

if ( isset($_POST['cancel']) ) {
    header("Location: index.php");
    return;
}

if ( isset($_POST['delete']) && isset($_POST['profile_id']) ) {
    $sql = "DELETE FROM profile WHERE profile_id = :zip";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':zip' => $_POST['profile_id']));
    $_SESSION['success'] = 'Profile deleted';
    header( 'Location: index.php' ) ;
    return;
}

// Guardian: Make sure that profile_id is present
if ( ! isset($_GET['profile_id']) ) {
  $_SESSION['error'] = "Missing profile_id";
  header('Location: index.php');
  return;
}

$stmt = $pdo->prepare("SELECT profile_id, first_name, last_name FROM profile WHERE profile_id = :xyz");
$stmt->execute(array(":xyz" => $_GET['profile_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
    $_SESSION['error'] = 'Bad value for profile_id';
    header( 'Location: index.php' ) ;
    return;
}
$profile_id = $row['profile_id'];
?>
<?php
    
    require_once "head.php";

?>
<h1>Deleting Profile</h1>

<?php
    $stmt = $pdo->prepare("SELECT profile_id, first_name, last_name FROM profile WHERE profile_id = :xyz");
    $stmt->execute(array(":xyz" => $_GET['profile_id']));
    while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
        echo "<p>First Name: ";
        echo(htmlentities($row['first_name']));
        echo "</p>";
        echo "<p>Last Name: ";
        echo(htmlentities($row['last_name']));
        echo "</p>";
    }
?>

<form method="post">
    <input type="hidden" name="profile_id" value="<?= $profile_id ?>">
    <input type="submit" value="Delete" name="delete">
    <input type="submit" value="Cancel" name="cancel">
</form>
