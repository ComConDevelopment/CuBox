<?php 
session_start(); 


if(!isset($_SESSION["username"])) 
   { 
      header("LOCATION: ../main/login.php");
      exit; 
   } 
?> 