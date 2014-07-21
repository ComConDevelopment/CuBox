<?php

include("../include/nosession.php");
require("../include/mysqlcon.php");
    						
  $id = $_REQUEST['id'];
  $kz = $_REQUEST['kz'];

  if ($kz == 0) 
  {
  	mysqli_query($con,"DELETE FROM control WHERE cid=$id");
  }
  else
  {
  	mysqli_query($con,"DELETE FROM room WHERE rid=$id");
  }
  

	mysqli_close($con);

?>