<?php 
session_start(); 


if(!isset($_SESSION["username"])) 
   { 
      header("LOCATION: login.php");
      exit; 
   } 
?> 