<?php

include("include/nosession.php");
require("include/mysqlcon.php");
    						
  $id = $_REQUEST['id'];

  mysqli_query($con,"DELETE FROM control WHERE cid=$id");

	mysqli_close($con);

?>