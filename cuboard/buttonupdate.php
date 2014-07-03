<?php

include 'include\nosession.php';

		$con=mysqli_connect("localhost","cubox","qubox","cuboard");
		// Check connection
		if (mysqli_connect_errno($con))
  		{
  			echo "Failed to connect to MySQL: " . mysqli_connect_error();
  		}
		mysqli_select_db($con,"cuboard");
    				
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