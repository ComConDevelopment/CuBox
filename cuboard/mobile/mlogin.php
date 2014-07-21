<!DOCTYPE html>
<html>
<head>
<link href="../css/mstyle.css" rel="stylesheet">
</head>


<body>
    <?php error_reporting(E_ALL ^  E_NOTICE);

	if ($_SERVER['REQUEST_METHOD'] != "POST")
        {
            echo "<div id=navigationbar>";
            echo "<ul id=list-nav>";
            echo "<li id=navlogin><a>CuBoard</a></li>";
            echo "</ul>";
            echo "</div>";
            echo "<div class=box align=center>";
            echo "<h2>Login</h2>";
            echo "<form action='$_SERVER[PHP_SELF]' method='post'>";
            echo "<h3>Username:</h3><br>";
            echo "<input type=text maxlength=50 name='username'><br><br>";

            echo "<h3>Passwort:</h3><br>";
            echo "<input type=password maxlength=50 name='password'><br><br><br><br>";

            echo "<input type=submit value='Abschicken'><br>";
            echo "</form>";
            echo "</div>";
        }
        else
        {

			session_start(); 

			require("../include/mysqlcon.php");

			$username = $_POST["username"]; 
			$password = md5($_POST["password"]); 

			$query = "SELECT username, password FROM login WHERE username LIKE '$username' LIMIT 1";
			$ergebnis = mysqli_query($con,$query);  
			$row = mysqli_fetch_object($ergebnis); 

            if ($username == "" OR $password == "") 
            {
                echo "<div id=navigationbar>";
                echo "<ul id=list-nav>";
                echo "<li id=navlogin><a>CuBoard</a></li>";
                echo "</ul>";
                echo "</div>";
                echo "<div class=box align=center>";
                echo "Eingabefehler. <br>Bitte Benutzername und Passwort korrekt ausf&uuml;llen. <br><a href=\"mlogin.php\">Zur&uuml;ck</a>";
                echo "</div>";
            }

			elseif ($row->password == $password) 
    		{ 
    			$_SESSION["username"] = $username; 
    			header("LOCATION: mcontrol.php");                
    		} 

			else 
    		{
                echo "<div id=navigationbar>";
                echo "<ul id=list-nav>";
                echo "<li id=navlogin><a>CuBoard</a></li>";
                echo "</ul>";
                echo "</div>";
                echo "<div class=box align=center>";
                echo "Benutzername und/oder Passwort falsch. <br><a href=\"mlogin.php\">Zur&uuml;ck</a>"; 
                echo "</div>";      		        
    		} 
    	}

	?>

</body>
</html>