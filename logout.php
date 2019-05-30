<?php

    require_once('Includes/init.php');
    global $session;

    $session->logout();
    header('Location:homePageNew.php');

?>