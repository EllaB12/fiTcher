<?php
//call cities list for autocomplete function
include_once('Includes/init.php');
$cities=new City();
$cities->fetch_cities();
?>