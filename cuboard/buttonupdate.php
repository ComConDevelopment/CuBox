<?php

include("include/nosession.php");
require("include/mysqlcon.php");
    				
		$id = $_REQUEST['id'];
    	$value = $_REQUEST['value'];
    	$code = $_REQUEST['code'];

    	$sendcode = substr($code, 0, 5);
    	$sendcharcode = substr($code, 6, 1);

    	$switchon = "sudo /home/pi/raspberry-remote/./send $sendcode $sendcharcode 1";
    	$switchoff = "sudo /home/pi/raspberry-remote/./send $sendcode $sendcharcode 0";    							

    	if ($value == 0)
		{										
			mysqli_query($con,"UPDATE control SET status=1 WHERE cid=$id");
			shell_exec($switchon);										
		}
		else
		{
			mysqli_query($con,"UPDATE control SET status=0 WHERE cid=$id");
			shell_exec($switchoff);
		}


	mysqli_close($con);

?>