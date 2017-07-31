<?php
session_start();

$servername = "localhost";
$user = "admin";
$pass = "admin";
$database = "ruap";

$conn = new mysqli($servername, $user, $pass, $database);

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

if (isset($_SESSION["class"]) && isset($_SESSION["probability"])) {
	$class = $_SESSION["class"];
	$probability = $_SESSION["probability"];
	$sql = "SELECT name FROM leaf WHERE class='$class'";
	$res = $conn->query($sql);
	$row = $res->fetch_assoc();
	$name = $row["name"];
	session_unset();
} else {
	header("Location: index.php");
}
?>
<!DOCTYPE html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<title>RUAP</title>
</script>
</head>
<body>
<div class="container">
	<p><?php echo $probability; ?>% da je <?php echo $class; ?>. klasa, tj. <?php echo $name; ?>.</p>
</div>
</div>
</body>
</html>
