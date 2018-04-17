<?php

    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=misc', 'besnikabrashi', 'besnikabrashi');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>