<?php

require("include/mysqlcon.php");
  
$action = $con->real_escape_string($_POST['action']); 
$updRecArray = $_POST['recArray'];
  
if($action == "updateCustomerPos")
{ 
 $counter = 1;
 foreach ($updRecArray as $recordIDValue) 
 {
 $result = $con->query("UPDATE control SET pos = " . $counter . " WHERE cid = " . $recordIDValue);
 $counter++; 
 }
 echo 'Position gespeichert';
 echo '<pre>';
 print_r($updRecArray);
 echo '</pre>';
}
 
$con->Close();
?>