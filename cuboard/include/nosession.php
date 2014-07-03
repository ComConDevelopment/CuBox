<?php 
session_start(); 

require 'include\checkmlogin.php';

if(!isset($_SESSION["username"])) 
   { 
            echo "<div id=navigationbar>";
            echo "<ul id=list-nav>";
            echo "<li id=navlogin><a>CuBoard</a></li>";
            echo "</ul>";
            echo "</div>";
            echo "<div class=box align=center>";
            echo "Bitte erst <a href=login.php>einloggen</a>."; 
            echo "</div>";	
   
   exit; 
   } 
?> 