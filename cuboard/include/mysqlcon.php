<?php	
	//MySQL Connect----------------------------------------------
							$con=mysqli_connect("localhost","cubox","qubox","cuboard");
							// Check connection
							if (mysqli_connect_errno($con))
  							{
  							echo "Failed to connect to MySQL: " . mysqli_connect_error();
  							}
							mysqli_select_db($con,"cuboard");
?>