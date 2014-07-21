<html>
<head>
<style type="text/css">
#posupdate {
      text-align: center; 
      color: white;
      background: #1ABC9C;
      font-size: 14pt;
    }
</style>
</head>
<?php

require("../include/mysqlcon.php");
  
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
 echo '<div id=posupdate>Position gespeichert</div>';
}
 
$con->Close();
?>
</html>