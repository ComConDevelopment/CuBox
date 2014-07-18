<?php

include("include/nosession.php");
include("include/pushbullet.php");
require("include/mysqlcon.php");
    		
		

		$id = $_REQUEST['id'];
    	$value = $_REQUEST['value'];
    	$code = $_REQUEST['code'];
    	$rid = $_REQUEST['rid'];

    	$result=mysqli_query($con, "SELECT room FROM room WHERE rid=$rid");
    	while ($row = mysqli_fetch_object($result))
    	{
 			$room=$row->room;   	
    	}

    	mysqli_free_result($result);  
    	   	
    	$result=mysqli_query($con, "SELECT name FROM control WHERE cid=$id");
    	while ($row = mysqli_fetch_object($result))
    	{
 			$name=$row->name;   	
    	}

    	$sendcode = substr($code, 0, 5);
    	$sendcharcode = substr($code, 6, 1);

    	$switchon = "sudo /home/pi/raspberry-remote/./send $sendcode $sendcharcode 1";
    	$switchoff = "sudo /home/pi/raspberry-remote/./send $sendcode $sendcharcode 0";    							

    	if ($value == 0)
		{										
			mysqli_query($con,"UPDATE control SET status=1 WHERE cid=$id");
			shell_exec($switchon);

			try {
			$p = new PushBullet('v1pAxW812rygFz1LGah8McTV5Pb5IlZ5qNujAmPyZyvC0');
			$p->pushNote('ujAmPyZyvC0djAuXDo0g56', $room, $name .' wurde eingeschaltet.');

			} catch (PushBulletException $e) {
 
 			 die($e->getMessage());
			}
		}
		else
		{
			mysqli_query($con,"UPDATE control SET status=0 WHERE cid=$id");
			shell_exec($switchoff);

			try {
			$p = new PushBullet('v1pAxW812rygFz1LGah8McTV5Pb5IlZ5qNujAmPyZyvC0');
			$p->pushNote('ujAmPyZyvC0djAuXDo0g56', $room, $name .' wurde ausgeschaltet.');

			} catch (PushBulletException $e) {
 
 			 die($e->getMessage());
			}
			
		}


	mysqli_close($con);

?>