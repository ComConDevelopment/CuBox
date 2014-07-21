<!DOCTYPE html>
<html>
<head>
<link href="../css/style.css" rel="stylesheet">
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
            echo "<h2>Registrierung</h2>";
            echo "<form action='$_SERVER[PHP_SELF]' method='post'>";
            echo "Username:<br>";
            echo "<input type=text size=24 maxlength=50 name='username'><br><br>";

            echo "Passwort:<br>";
            echo "<input type=password size=24 maxlength=50 name='password'><br><br>";

            echo "Passwort wiederholen:<br>";
            echo "<input type=password size=24 maxlength=50 name='password2'><br><br>";

            echo "<input style=float:left type=submit value='Login' name='Login'>";
            echo "<input type=submit value='Abschicken'><br>";
            echo "</form>";
            echo "</div>";
        }
        else
        {
            if (isset($_POST['Login'])) {
                header("LOCATION: login.php");
            }

            require("../include/mysqlcon.php"); 

            $username = $_POST["username"]; 
            $password = $_POST["password"]; 
            $password2 = $_POST["password2"]; 

            if($password != $password2 OR $username == "" OR $password == "") 
                { 
                    echo "<div id=navigationbar>";
                    echo "<ul id=list-nav>";
                    echo "<li id=navlogin><a>CuBoard</a></li>";
                    echo "</ul>";
                    echo "</div>";
                    echo "<div class=box align=center>";
                    echo "Eingabefehler. <br>Bitte alle Felder korrekt ausf&uuml;llen. <br><a href=\"signup.php\">Zur&uuml;ck</a>";
                    echo "</div>";
                    exit;
                }

            $password = md5($password); 

            $query = "SELECT id FROM login WHERE username LIKE '$username'";
            $result = mysqli_query($con,$query); 
            $menge = mysqli_num_rows($result); 

            if($menge == 0) 
                { 
                $eintrag = "INSERT INTO login (username, password) VALUES ('$username', '$password')"; 
                $eintragen = mysqli_query($con, $eintrag); 

                if($eintragen == true) 
                    { 
                        echo "<div id=navigationbar>";
                        echo "<ul id=list-nav>";
                        echo "<li id=navlogin><a>CuBoard</a></li>";
                        echo "</ul>";
                        echo "</div>";
                        echo "<div class=box align=center>";
                        echo "Benutzername <b>$username</b> wurde erstellt. <br><a href=\"login.php\">Login</a>"; 
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
                        echo "Fehler beim Erstellen des Benutzernames. <br><a href=\"signup.php\">Zur&uuml;ck</a>";  
                        echo "</div>";                         
                    } 


                } 

            else 
                { 
                    echo "<div id=navigationbar>";
                    echo "<ul id=list-nav>";
                    echo "<li id=navlogin><a>CuBoard</a></li>";
                    echo "</ul>";
                    echo "</div>";
                    echo "<div class=box align=center>";
                    echo "Benutzername bereits vorhanden. <br><a href=\"signup.php\">Zur&uuml;ck</a>";  
                    echo "</div>";                     
                } 
        }
 

?>

</body>
</html>