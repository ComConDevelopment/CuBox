<!DOCTYPE HTML>
<html>

<head>
<link href="../css/style.css" rel="stylesheet">
</head>

<?php
include("../include/nosession.php");
?>


<body id="home">

<div id="navigationbar">
    <ul id="list-nav">
    	<li id="navmusic"><a href="music.php">Music</a></li>
    	<li id="navhome"><a href="home.php">Home</a></li>
    	<li id="navcontrol"><a href="control.php">Control</a></li>
    </ul>
</div>


<?php

	require("../include/mysqlcon.php");
	
	$resultroom = mysqli_query($con,"SELECT * FROM room ORDER BY rid");
	
	while ($row = mysqli_fetch_object($resultroom))
    {
    	$rid=$row->rid;
		echo "<div class=box>";
		echo "<div class=temp><p>0&deg;C</p></div>"; 
		echo "<h2>$row->room</h2>";
		echo "<h3>Schalterart</h3>";
		$result = mysqli_query($con,"SELECT * FROM control LEFT JOIN room ON control.rid=room.rid ORDER BY control.pos");
		while ($row = mysqli_fetch_object($result))
        {
            if ($row->rid==$rid)
            {
            	echo "<table>";
            	echo "<tr>";
				echo "<td>$row->name</td>";
				if ($row->status ==1)
				{	
					echo "<td><div id=homeview class=an>an</div></td>";
				}
 				else
 				{
 					echo "<td><div id=homeview>aus</div></td>";
 				}
 				echo "</tr>";    
 				echo "</table>";
 			}           
        }
        mysqli_free_result($result); 					
		echo "</div>";
	}


	
	mysqli_close($con);

?>



</body>

</html>