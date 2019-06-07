<?php
//Get subjects list from DB
include_once('Includes/init.php');
$subject=new Subject();
$subject->fetch_subjects();
?>