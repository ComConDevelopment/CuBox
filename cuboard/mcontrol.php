<!DOCTYPE HTML>
<html>

<head>
<link href="css/mstyle.css" rel="stylesheet">
<script language="javascript" type="text/javascript">

function updatebutton(id,value,code){
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
    			}
  			}
    		
    		var queryString = "?id=" + id + "&value=" + value + "&code" + code;
    		xmlhttp.open("POST", "buttonupdate.php" + queryString, false);
    		xmlhttp.send();

		}

    </script>

</head>


<?php
include 'include\nosession.php';
?>


<body id="control">


<div id="navigationbar">
    <ul id="list-nav">
    	<li id="navcontrol"><a href="">Mobile Control</a></li>
    </ul>
</div>

<div class="box">

	<h2>Zimmerbeschreibung</h2>
	<h3>Schalterart</h3>
	<div style="position: relative; width: 0px; height: 0px;">
		<div class="temp">
		<p>0,0&deg;C</p>
	</div>
	</div>

	<?php
	//MySQL Connect----------------------------------------------
							$con=mysqli_connect("localhost","cubox","qubox","cuboard");
							// Check connection
							if (mysqli_connect_errno($con))
  							{
  							echo "Failed to connect to MySQL: " . mysqli_connect_error();
  							}
							mysqli_select_db($con,"cuboard");

	//Button---------------------------

  						echo "<form action='$_SERVER[PHP_SELF]' method=POST >";	
							echo "<table>";							
  							$query = "SELECT * FROM control";
   							$result = mysqli_query($con,$query);

   							while ($row = mysqli_fetch_object($result))
   							{
   							echo "<tr>";
								echo "<td>$row->name</td>";
								echo "</tr>";
								echo "<tr>";
								if ($row->status ==1)
								{	
									echo "<td><Button onclick=updatebutton('$row->cid','$row->status','$row->code') >an</Button></td>";
								}
 								else
 								{
 									echo "<td><Button onclick=updatebutton('$row->cid','$row->status','$row->code') >aus</Button></td>";
 								}
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