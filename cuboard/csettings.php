<!DOCTYPE HTML>
<html>

<head>
<link href="css/style.css" rel="stylesheet">
<script language="javascript" type="text/javascript">

function deletebutton(id,name){
   var xmlhttp;
		if (window.XMLHttpRequest)
  		{// code for IE7+, Firefox, Chrome, Opera, Safari
  			xmlhttp=new XMLHttpRequest();
  		}
		else
  		{// code for IE6, IE5
  			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  		}
      if (confirm(unescape('Soll '+name+' wirklich gel%F6scht werden?'))) 
        {
  			xmlhttp.onreadystatechange=function()
 			  {
  				if (xmlhttp.readyState==4 && xmlhttp.status==200)
		    	{			
	    			var id = document.getElementById('id');
            var name = document.getElementById('name');
    			}
  			}

        
    		xmlhttp.open("POST", "buttondelete.php?id=" + id, false);
    		xmlhttp.send();
        }
        else
        {
          location.reload();
        }
		}

    </script>

</head>


<?php
include 'include\nosession.php';
?>


<body id="control">


<div id="navigationbar">
    <ul id="list-nav">
    	<li id="navmusic"><a href="music.php">Music</a></li>
    	<li id="navhome"><a href="home.php">Home</a></li>
    	<li id="navcontrol"><a href="control.php">Control</a></li>
    </ul>
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

	//Buttons----------------------------------------------------
              if ($_SERVER['REQUEST_METHOD'] != "POST")
              {
              echo "<div class=box>";
              echo "<form action='$_SERVER[PHP_SELF]' method=POST >"; 
  						echo "<h2>Control Settings</h2>";
              echo "<h3>Neuer Eintrag</h3>";
              echo "<div style=position:absolute;><div class=logout><input type=submit name='logout' value='Logout' ></div></div>";                        
              echo "<table>";

                echo "<tr>";
                echo "<td>
                      <input type=text name='bezeichnung' placeholder='Bezeichnung'>
                      </td>";
                echo "<td>
                      <input type=text name='code' placeholder='Code z.B. 100102'>
                      </td>";                      
                echo "<td style=padding-top:35px;>
                      <input style=margin-top:-30px; type=submit name='eintragen' value='Eintragen' >
                      </td>";

                $result = mysqli_query($con,"SELECT * FROM control");

                while ($row = mysqli_fetch_object($result))
                {
                echo "<tr>";
                echo "<td>$row->name</td>";
                echo "<td>$row->code</td>";
                echo "<td><Button class=loeschen onclick=deletebutton('$row->cid','$row->name') >L&ouml;schen</Button></td>";            
                echo "</tr>";                
                }    

              echo "</table>";
              echo "</form>";
							echo "</div>";
              mysqli_free_result($result);
              }
              else
              {
							if (isset($_POST['eintragen'])) 
              {
              
                $bezeichnung=$_POST["bezeichnung"];
                $code=$_POST["code"];

                $codelen=strlen($code);

                $codevorhanden = mysqli_query($con,"SELECT code FROM control WHERE code='$code'");

                if ($bezeichnung == "") 
                {
                  echo "<div id=navigationbar>";
                  echo "<ul id=list-nav>";
                  echo "<li id=navlogin><a>CuBoard</a></li>";
                  echo "</ul>";
                  echo "</div>";
                  echo "<div class=box align=center>";
                  echo "Es wurde keine Bezeichnung angegeben. <br><a href=\"csettings.php\">Zur&uuml;ck</a>"; 
                  echo "</div>";
                }                
                elseif ($codelen != 6) 
                {
                  echo "<div id=navigationbar>";
                  echo "<ul id=list-nav>";
                  echo "<li id=navlogin><a>CuBoard</a></li>";
                  echo "</ul>";
                  echo "</div>";
                  echo "<div class=box align=center>";
                  echo "Fehler in der L&auml;nge des Codes. <br><a href=\"csettings.php\">Zur&uuml;ck</a>"; 
                  echo "</div>";
                }
                elseif (mysqli_num_rows($codevorhanden) == 1) 
                {
                  echo "<div id=navigationbar>";
                  echo "<ul id=list-nav>";
                  echo "<li id=navlogin><a>CuBoard</a></li>";
                  echo "</ul>";
                  echo "</div>";
                  echo "<div class=box align=center>";
                  echo "Der eingegebene Code <b>$code</b> ist bereits vorhanden. <br><a href=\"csettings.php\">Zur&uuml;ck</a>"; 
                  echo "</div>";
                }
                else
                {

                $eintrag = "INSERT INTO control (name, code) VALUES ('$bezeichnung', '$code')"; 
                $eintragen = mysqli_query($con, $eintrag); 

                if($eintragen == true) 
                    { 
                        echo "<div id=navigationbar>";
                        echo "<ul id=list-nav>";
                        echo "<li id=navlogin><a>CuBoard</a></li>";
                        echo "</ul>";
                        echo "</div>";
                        echo "<div class=box align=center>";
                        echo "<b>$bezeichnung</b> mit dem Code <b>$code</b> wurde eingetragen. <br><a href=\"csettings.php\">Zur&uuml;ck</a>"; 
                        echo "</div>";
                                                  
                    } 
                else 
                    { 
                        echo "<div id=navigationbar>";
                        echo "<ul id=list-nav>";
                        echo "<li id=navlogin><a>CuBoard</a></li>";
                        echo "</ul>";
                        echo "</div>";
                        echo "<div class=box align=center>";
                        echo "Fehler beim Eintragen von <b>$bezeichnung</b>. <br><a href=\"csettings.php\">Zur&uuml;ck</a>";  
                        echo "</div>";
                                                
                    } 
                }
              }

              elseif (isset($_POST['logout']))
              {
                $_SESSION = array();
                header("LOCATION: login.php");
              }

              elseif (isset($_POST['loeschen'])) 
              {
                $delid = $_POST['delid'];
                $name = $_POST['name'];
                  
                  echo "<div id=navigationbar>";
                  echo "<ul id=list-nav>";
                  echo "<li id=navlogin><a>CuBoard</a></li>";
                  echo "</ul>";
                  echo "</div>";
                  echo "<div class=box align=center>";
                  echo "Soll <b>$name</b> wirklich gel&ouml;scht werden? <br><br>";
                  echo "<form action='$_SERVER[PHP_SELF]' method=POST name='delete'>"; 
                  echo "<input style=float:left type=submit value='Ja' name='ja'>";
                  echo "<input type=submit value='Nein'><br>";
                  echo "<input type=hidden value='$delid' name='delidja'>";
                  echo "</form>";  
                  echo "</div>";                

              }
              elseif (isset($_POST['ja'])) 
              {
                $delidja = $_POST['delidja'];
                mysqli_query($con,"DELETE FROM control WHERE cid=$delidja");
                //mysqli_query($con,"ALTER TABLE control AUTO_INCREMENT =1");             
                header("LOCATION: csettings.php");
              }
              else
              {
                header("LOCATION: csettings.php");
              }
            }
              
		          
							
							mysqli_close($con);

	?>







</body>

</html>