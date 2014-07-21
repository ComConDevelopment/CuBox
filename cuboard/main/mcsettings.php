<!DOCTYPE HTML>
<html>

<head>
<link href="../css/style.css" rel="stylesheet">
<script language="javascript" type="text/javascript">

function ajaxbutton(id,value){
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
    			}
  			}
    		
    		var queryString = "?id=" + id + "&value=" + value;
    		xmlhttp.open("POST", "buttonupdate.php" + queryString, true);
    		xmlhttp.send();
		}

    </script>

</head>


<?php
include("../include/nosession.php");
?>


<body id="settings">


<div id="navigationbar">
    <ul id="list-nav">
      <li id="navsettings"><a href="msettings.php">Settings</a></li>
    	<li id="navmusic"><a href="music.php">Music</a></li>
    	<li id="navhome"><a href="home.php">Home</a></li>
    	<li id="navcontrol"><a href="control.php">Control</a></li>
    </ul>
</div>

<div class="box">

	<h2>Music Settings</h2>
	<h3>Accounts eintragen</h3>


	<?php
  
    require("../include/mysqlcon.php");

	//Button---------------------------

  						echo "<form action='$_SERVER[PHP_SELF]' method=POST >";						
							echo "<table>";							
  							$query = "SELECT * FROM control";
   							$result = mysqli_query($con,$query);

   							while ($row = mysqli_fetch_object($result))
   							{
   							echo "<tr>";
								echo "<td></td>";
                echo "<td></td>";
 								echo "</tr>"; 								
   							}							
							echo "</table>";
							echo "</form>";
							

							
		
							mysqli_free_result($result);
							mysqli_close($con);

	?>

</div>





</body>

</html>