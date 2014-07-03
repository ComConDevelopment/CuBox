<!DOCTYPE html>
<html>
<head>
<link href="css/style.css" rel="stylesheet">
</head>

<body>
    <?php error_reporting(E_ALL ^  E_NOTICE);

            session_destroy(); 

            echo "Erfolgreich ausgeloggt.<br><br>";

            echo "<p><a href='login.php'>Login</a></p><br>";

	?>

</body>
</html>