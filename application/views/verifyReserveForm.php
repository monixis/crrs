<?php
error_reporting(0);
session_start();
// Create new $_SESSION variables corresponding with the fields of the associated forms.
$_SESSION['primEmail']= $_POST['primEmail'];
$_SESSION['resDate']= $_POST['resDate'];
$_SESSION['bookType']= $_POST['bookType'];
$_SESSION['roomNum']= $_POST['roomNum'];
$_SESSION['timeStart']= $_POST['timeStart'];
$_SESSION['timeEnd']= $_POST['timeEnd'];
         
?>