<?php
require_once "pdo.php";
// Demand a GET parameter
if ( ! isset($_GET['email']) || strlen($_GET['email']) < 1  ) {
    die('Email parameter missing');
}

// If the user requested logout go back to index.php
if ( isset($_POST['logout']) ) {
    header('Location: index.php');
    return;
}

$failure = false;
$success = false;

if (isset($_POST['add'])) {
    if ( ! isset($_POST['make']) || strlen($_POST['make']) < 1  ) {
        $failure = "Make is required";
    }
    else if ( ! is_numeric($_POST['year']) || ! is_numeric($_POST['mileage']) ) {
        $failure = "Mileage and year must be numeric";
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
        $success = "Record Inserted";
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Besnik Abrashi - Autos Database</title>
        <?php require_once "bootstrap.php"; ?>
    </head>
    <body>
        <div class="container">
            <h1>Tracking Autos for <?php
                if ( isset($_REQUEST['email']) ) {
                    echo htmlentities($_REQUEST['email']);
                }
                ?>
            </h1>
            <?php
            // Note triple not equals and think how badly double
            // not equals would work here...
            if ( $failure !== false ) {
                // Look closely at the use of single and double quotes
                echo('<p style="color: red;">'.$failure.'</p>');
            }
            else {
                echo('<p class="text-success">'.$success.'</p>');
            }
            ?>
            <form method="post">
                <p>Make: <input type="text" name="make" size="60" /></p>
                <p>Year: <input type="text" name="year" /></p>
                <p>Mileage: <input type="text" name="mileage" /></p>
                <input type="submit" name="add" value="Add" />
                <input type="submit" name="logout" value="Logout" />
            </form>
            
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
        </div>
    </body>
</html>