<!DOCTYPE HTML>
<html>

<head>
<link href="../css/style.css" rel="stylesheet">
<script language="javascript" type="text/javascript">

function updatebutton(id,value,code,rid){
   var xmlhttp;
		if (window.XMLHttpRequest)
  		{// code for IE7+, Firefox, Chrome, Opera, Safari
  			xmlhttp=new XMLHttpRequest();
  		}
		else
  		{// code for IE6, IE5
  			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  		}
  			xmlhttp.onreadystatechange=function()
 			{
  				if (xmlhttp.readyState==4 && xmlhttp.status==200)
		    	{			
	    			var id = document.getElementById('id');
    				var value = document.getElementById('value');
            		var code = document.getElementById('code');
            		var rid = document.getElementById('rid');
    			}
  			}
    		
    		var queryString = "?id=" + id + "&value=" + value + "&code=" + code + "&rid=" + rid;
    		xmlhttp.open("POST", "../functions/buttonupdate.php" + queryString, false);
    		xmlhttp.send();

		}

    </script>

</head>


<?php
require("../include/checkmobile.php");
include("../include/nosession.php");
//include 'include\weather.php';

?>


<body id="control">


<div id="navigationbar">
    <ul id="list-nav">
    	<li id="navmusic"><a href="music.php">Music</a></li>
    	<li id="navhome"><a href="home.php">Home</a></li>
    	<li id="navcontrol"><a href="control.php">Control</a></li>
    	<li><a href="csettings.php">Settings</a></li>
    </ul>
</div>


<?php

	require("../include/mysqlcon.php");
	
	$resultroom = mysqli_query($con,"SELECT * FROM room ORDER BY rid");

	echo "<form action='$_SERVER[PHP_SELF]' method=POST >";
	while ($row = mysqli_fetch_object($resultroom))
    {
    	$rid=$row->rid;
		echo "<div class=box>";
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
					echo "<td><Button class=an onclick=updatebutton('$row->cid','$row->status','$row->code','$rid') >an</Button></td>";
				}
 				else
 				{
 					echo "<td><Button onclick=updatebutton('$row->cid','$row->status','$row->code','$rid') >aus</Button></td>";
 				}
 				echo "</tr>";    
 				echo "</table>";
 			}           
        }
        mysqli_free_result($result); 					
		echo "</div>";
	}
   	echo "</form>";


	
	mysqli_close($con);

?>







</body>

</html>