<?php

    session_start();
    unset($_SESSION['email']);
    unset($_SESSION['user_id']);
    header('Location: index.php');