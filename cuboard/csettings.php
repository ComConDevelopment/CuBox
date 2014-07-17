<!DOCTYPE HTML>
<html>

<head>
<link href="css/style.css" rel="stylesheet">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.js"></script>
<script language="javascript" type="text/javascript">

function deletebutton(id,kz){
   var xmlhttp;
		if (window.XMLHttpRequest)
  		{// code for IE7+, Firefox, Chrome, Opera, Safari
  			xmlhttp=new XMLHttpRequest();
  		}
		else
  		{// code for IE6, IE5
  			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  		}
      if (confirm(unescape('Soll wirklich gel%F6scht werden?'))) 
        {
  			xmlhttp.onreadystatechange=function()
 			  {
  				if (xmlhttp.readyState==4 && xmlhttp.status==200)
		    	{			
	    			var id = document.getElementById('id');
            var kz = document.getElementById('kz');
    			}
  			}
        
    		xmlhttp.open("POST", "buttondelete.php?id=" + id + "&kz=" + kz, false);
    		xmlhttp.send();
        }
        else
        {
          location.reload();
        }
		}

function changeroom(id,rid){
   var xmlhttp;
    if (window.XMLHttpRequest)
      {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
      }
    else
      {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
      if (confirm(unescape('Soll der Raum ge%E4ndert werden?'))) 
        {
        xmlhttp.onreadystatechange=function()
        {
          if (xmlhttp.readyState==4 && xmlhttp.status==200)
          {     
            var id = document.getElementById('id');
            var rid = document.getElementById('rid');
          }
        }

        xmlhttp.open("POST", "changeroom.php?id=" + id + "&rid=" + rid, false);
        xmlhttp.send();
        }
        else
        {
          location.reload();
        }
    }

$(document).ready(function()
    {
      function slideout() {
        setTimeout(function() {
          $("#debugMess").slideUp("slow", function () {
      });
    }, 2500);}
 
    $("#debugMess").hide();
 
    $(function() {
        $("#customersList").sortable({ placeholder: "customersListHighlight", opacity: 0.5, cursor: 'move', update: function() {
          var order = $(this).sortable("serialize") + '&action=updateCustomerPos';
          $.post("posupdate.php", order, function(theResponse) {
            $("#debugMess").html(theResponse);
            $("#debugMess").slideDown('slow');
            slideout();
          });                                
        }                 
      });
      $( "#customersList" ).disableSelection();
    });
  }); 



    </script>

</head>


<?php
include("include/nosession.php");
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

  require("include/mysqlcon.php");
  $showDebugMessage = true;

              if ($_SERVER['REQUEST_METHOD'] != "POST")
              {

              $resultroom = mysqli_query($con,"SELECT * FROM room ORDER BY pos");

              echo "<div class=box>";
              echo "<form action='$_SERVER[PHP_SELF]' method=POST >";
              echo "<div style=position:absolute;><div class=logout><input type=submit name='logout' value='Logout' ></div></div>";  
  						echo "<h2>Objekt hinzuf&uuml;gen</h2>";
              echo "<h3>Neuer Eintrag</h3>";                                     
              echo "<table>";
                echo "<colgroup width=110></colgroup>";
                echo "<tr>";
                echo "<td>
                      <input type=text style=width:140px; name='bezeichnung' placeholder='Bezeichnung'>
                      </td>";
                echo "<td>
                      <input type=text style=width:120px; name='code' placeholder='Code z.B. 100102'>
                      </td>";     
                echo "<td>
                      <select style=width:120px; name='room'>";
                      while ($row = mysqli_fetch_object($resultroom))
                      {
                        echo "<option value=$row->rid>$row->room</option>";
                      }
                echo "</select>
                      </td>";                    
                echo "<td style=padding-top:35px;>
                      <input style=margin-top:-30px; type=submit name='objeintragen' value='Eintragen'>
                      </td>";
                echo "</table>";

                
                if($showDebugMessage) echo "<div id=debugMess></div>";
                echo "<ul id=customersList>";

                mysqli_free_result($resultroom);
                $resultroom = mysqli_query($con,"SELECT * FROM room ORDER BY pos");
                $objectquery = "SELECT * FROM control LEFT JOIN room ON control.rid=room.rid ORDER BY control.pos";
                $result = mysqli_query($con, $objectquery);

                while ($row = mysqli_fetch_object($result))
                {
                $idzw=$row->cid;
                echo "<li id=recArray_$idzw>";
                echo "<table id=settingstable>";
                echo "<colgroup width=110></colgroup>";
                echo "<tr>";
                echo "<td style=width:145px;>$row->name</td>";
                echo "<td style=width:130px;>$row->code</td>";
                echo "<td style=width:130px;>$row->room</td>";
                //echo "<td>";
                //echo "<select style=width:120px; name='room' onchange=changeroom('$idzw','this.options[this.selectedIndex].value')>"; 
                //while ($rrow = mysqli_fetch_object($resultroom))
                //     {                                             
                //        echo "<option value=$rrow->rid>$rrow->room</option>";                                    
                //      }  
                //echo "</select>";                
                //echo "</td>";  
                echo "<td><Button class=loeschen onclick=deletebutton('$idzw','0') >L&ouml;schen</Button></td>";    
                echo "</tr>";        
                echo "</table>";
                echo "</li>";                
                }    

                echo "</ul>";

              echo "</form>";
							echo "</div>";

              mysqli_free_result($resultroom);
              

              echo "<div class=box>";
              echo "<form action='$_SERVER[PHP_SELF]' method=POST >"; 
              echo "<h2>Raum hinzuf&uuml;gen</h2>";
              echo "<h3>Neuer Eintrag</h3>";                               
              echo "<table>";
              echo "<colgroup width=110></colgroup>";
              echo "<tr>";   
              echo "<td>";
              echo "<input type=text style=width:420px; name='newroom' placeholder='Raum'>";
              echo "</td>";                    
              echo "<td style=padding-top:35px;>";
              echo "<input style=margin-top:-30px; type=submit name='roomeintragen' value='Eintragen'>";
              echo "</td>";
              echo "</table>";

              $resultroom = mysqli_query($con,"SELECT * FROM room ORDER BY pos");
                while ($row = mysqli_fetch_object($resultroom))
                {
                  echo "<table>";
                  echo "<colgroup width=110></colgroup>";
                  echo "<tr>";
                  echo "<td>$row->room</td>";
                  echo "<td><Button class=loeschen onclick=deletebutton('$row->rid','1') >L&ouml;schen</Button></td>";    
                  echo "</tr>";        
                  echo "</table>";
                }

              echo "</form>";
              echo "</div>";

              }
              else
              {
							if (isset($_POST['objeintragen'])) 
              {
              
                $bezeichnung=$_POST["bezeichnung"];
                $code=$_POST["code"];
                $room=$_POST["room"];

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
                  echo "Es wurde keine <b>Bezeichnung</b> angegeben. <br><a href=\"csettings.php\">Zur&uuml;ck</a>"; 
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
                  echo "Fehler in der L&auml;nge des <b>Codes</b>. <br><a href=\"csettings.php\">Zur&uuml;ck</a>"; 
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

                elseif ($room == "") 
                {
                  echo "<div id=navigationbar>";
                  echo "<ul id=list-nav>";
                  echo "<li id=navlogin><a>CuBoard</a></li>";
                  echo "</ul>";
                  echo "</div>";
                  echo "<div class=box align=center>";
                  echo "Bitte f&uuml;gen Sie zuerst einen <b>Raum</b> hinzu. <br><a href=\"csettings.php\">Zur&uuml;ck</a>"; 
                  echo "</div>";
                }
                else
                {

                $eintrag = "INSERT INTO control (name, code, rid) VALUES ('$bezeichnung', '$code', '$room')"; 
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

              elseif (isset($_POST['roomeintragen'])) 
              {
                $newroom=$_POST["newroom"];
                $roomvorhanden = mysqli_query($con,"SELECT room FROM room WHERE room='$newroom'"); 
                if ($newroom == "") 
                {
                  echo "<div id=navigationbar>";
                  echo "<ul id=list-nav>";
                  echo "<li id=navlogin><a>CuBoard</a></li>";
                  echo "</ul>";
                  echo "</div>";
                  echo "<div class=box align=center>";
                  echo "Es wurde kein <b>Raum</b> angegeben. <br><a href=\"csettings.php\">Zur&uuml;ck</a>"; 
                  echo "</div>";
                }
                elseif (mysqli_num_rows($roomvorhanden) == 1) 
                {
                  echo "<div id=navigationbar>";
                  echo "<ul id=list-nav>";
                  echo "<li id=navlogin><a>CuBoard</a></li>";
                  echo "</ul>";
                  echo "</div>";
                  echo "<div class=box align=center>";
                  echo "Der Raum <b>$newroom</b> ist bereits vorhanden. <br><a href=\"csettings.php\">Zur&uuml;ck</a>"; 
                  echo "</div>";
                }
                else
                {
                $eintrag = "INSERT INTO room (room) VALUES ('$newroom')"; 
                $eintragen = mysqli_query($con, $eintrag); 

                if($eintragen == true) 
                    { 
                        echo "<div id=navigationbar>";
                        echo "<ul id=list-nav>";
                        echo "<li id=navlogin><a>CuBoard</a></li>";
                        echo "</ul>";
                        echo "</div>";
                        echo "<div class=box align=center>";
                        echo "<b>$newroom</b> wurde eingetragen. <br><a href=\"csettings.php\">Zur&uuml;ck</a>"; 
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
                        echo "Fehler beim Eintragen von <b>$newroom</b>. <br><a href=\"csettings.php\">Zur&uuml;ck</a>";  
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