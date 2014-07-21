<?php

include("../include/nosession.php");
include("../include/pushbullet.php");
require("../include/mysqlcon.php");
    		
		

		$id = $_REQUEST['id'];
    	$value = $_REQUEST['value'];
    	$code = $_REQUEST['code'];
    	$rid = $_REQUEST['rid'];

    	
    	if ($code == "Push-Benachrichtigungen") 
    	{
    		if ($value == 0)
			{										
				mysqli_query($con,"UPDATE settings SET status=1 WHERE sid=1");
			}
			else
			{
				mysqli_query($con,"UPDATE settings SET status=0 WHERE sid=1");
			}
    	}
    	else
    	{
    		$result=mysqli_query($con, "SELECT room FROM room WHERE rid=$rid");
    		while ($row = mysqli_fetch_object($result))
    		{
 				$room=$row->room;   	
    		}
    	   	
    		$resultcontrol=mysqli_query($con, "SELECT name FROM control WHERE cid=$id");
    		while ($row = mysqli_fetch_object($resultcontrol))
    		{
 				$name=$row->name;   	
    		}
    	   	
    		$resultsettings=mysqli_query($con, "SELECT code,status FROM settings WHERE sid=1");
    		while ($row = mysqli_fetch_object($resultsettings))
    		{
 				$apikey=$row->code;   	
 				$push=$row->status;
    		}


    	$sendcode = substr($code, 0, 5);
    	$sendcharcode = substr($code, 6, 1);

    	$switchon = "sudo /home/pi/raspberry-remote/./send $sendcode $sendcharcode 1";
    	$switchoff = "sudo /home/pi/raspberry-remote/./send $sendcode $sendcharcode 0";    							

    	if ($value == 0)
		{										
			mysqli_query($con,"UPDATE control SET status=1 WHERE cid=$id");
			shell_exec($switchon);

			if ($push == 1)
			{
				try 
				{
					$p = new PushBullet($apikey);
					$p->pushNote('ujAmPyZyvC0djAuXDo0g56', $room, $name .' wurde eingeschaltet.');
				} catch (PushBulletException $e) 
				{ 
 				 die($e->getMessage());
				}
			}
		}
		else
		{
			mysqli_query($con,"UPDATE control SET status=0 WHERE cid=$id");
			shell_exec($switchoff);

			if ($push == 1)
			{	
				try 
				{
					$p = new PushBullet($apikey);
					$p->pushNote('ujAmPyZyvC0djAuXDo0g56', $room, $name .' wurde ausgeschaltet.');
				} catch (PushBulletException $e) 
				{ 
 				 die($e->getMessage());
				}
			}	
					
		}
		}


	mysqli_close($con);

?>