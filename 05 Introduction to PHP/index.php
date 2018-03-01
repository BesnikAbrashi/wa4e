<!DOCTYPE html>
<html>
    <head>
        <title>Besnik Abrashi - Getting started with PHP</title>
    </head>    
    <body>
        <h1>Besnik Abrashi - Getting started with PHP</h1>
        <pre>ASCII ART:
            <?php 
                echo chr(012);
                echo chr(040),chr(040),chr(040),chr(040),chr(052),chr(052),chr(052),chr(052),chr(052),chr(052),chr(052),chr(052),chr(052),chr(052),chr(052),chr(012);         
                echo chr(040),chr(040),chr(040),chr(040),chr(052),chr(040),chr(040),chr(040),chr(040),chr(040),chr(040),chr(040),chr(040),chr(040),chr(052),chr(012);
                echo chr(040),chr(040),chr(040),chr(040),chr(052),chr(040),chr(040),chr(040),chr(040),chr(040),chr(040),chr(040),chr(040),chr(040),chr(052),chr(012);
                echo chr(040),chr(040),chr(040),chr(040),chr(052),chr(040),chr(040),chr(040),chr(040),chr(040),chr(040),chr(040),chr(040),chr(040),chr(052),chr(012);
                echo chr(040),chr(040),chr(040),chr(040),chr(052),chr(040),chr(040),chr(040),chr(040),chr(040),chr(040),chr(040),chr(040),chr(040),chr(052),chr(012);
                echo chr(040),chr(040),chr(040),chr(040),chr(052),chr(052),chr(052),chr(052),chr(052),chr(052),chr(052),chr(052),chr(052),chr(052),chr(052),chr(012);
                echo chr(040),chr(040),chr(040),chr(040),chr(052),chr(040),chr(040),chr(040),chr(040),chr(040),chr(040),chr(040),chr(040),chr(040),chr(052),chr(012);
                echo chr(040),chr(040),chr(040),chr(040),chr(052),chr(040),chr(040),chr(040),chr(040),chr(040),chr(040),chr(040),chr(040),chr(040),chr(052),chr(012);
                echo chr(040),chr(040),chr(040),chr(040),chr(052),chr(040),chr(040),chr(040),chr(040),chr(040),chr(040),chr(040),chr(040),chr(040),chr(052),chr(012);
                echo chr(040),chr(040),chr(040),chr(040),chr(052),chr(040),chr(040),chr(040),chr(040),chr(040),chr(040),chr(040),chr(040),chr(040),chr(052),chr(012);
                echo chr(040),chr(040),chr(040),chr(040),chr(052),chr(040),chr(040),chr(040),chr(040),chr(040),chr(040),chr(040),chr(040),chr(040),chr(052),chr(012);
                echo chr(040),chr(040),chr(040),chr(040),chr(052),chr(052),chr(052),chr(052),chr(052),chr(052),chr(052),chr(052),chr(052),chr(052),chr(052),chr(012);
            ?>
        </pre>
        <p>The SHA256 hash of "Besnik Abrashi" is: 
            <?php 
                print hash('sha256', 'Besnik Abrashi'); 
            ?>
        </p>
        <a href="check.php">Click here to check the error setting</a>
        <br/>
        <a href="fail.php">Click here to cause a traceback</a>
    </body>
</html>