<?php

include("include/nosession.php");
require("include/mysqlcon.php");
    						
  $id = $_REQUEST['id'];
  $name = $_REQUEST['name'];

  if ($name == "") 
  {
  	mysqli_query($con,"DELETE FROM room WHERE cid=$id");
  }
  else
  {
  	mysqli_query($con,"DELETE FROM control WHERE cid=$id");
  }
  

	mysqli_close($con);

?>