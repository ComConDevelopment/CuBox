<?php

include("../include/nosession.php");
require("../include/mysqlcon.php");
    				
		$id = $_REQUEST['id'];
    	$rid = $_REQUEST['rid'];
  														
			mysqli_query($con,"UPDATE control SET rid=$rid WHERE cid=$id");									

	mysqli_close($con);

?>