<?php
session_start();
<<<<<<< HEAD

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
=======
$servername = "localhost";
$user = "root";
$pass = "";
$database = "sarcevic";
$conn = new mysqli($servername, $user, $pass, $database);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
if (isset($_SESSION["class"]) && isset($_SESSION["probability"])) {
	$class = $_SESSION["class"];
	$probability = $_SESSION["probability"];
	$sql = "SELECT name, location, link FROM leaf WHERE class='$class'";
	$res = $conn->query($sql);
	$row = $res->fetch_assoc();
	$name = $row["name"];
    $location = $row["location"];
    $link = $row["link"];
>>>>>>> master
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
<<<<<<< HEAD
<title>RUAP</title>
</script>
=======
<title>Result</title>
>>>>>>> master
</head>
<body>
<h1>Is this your leaf?</h1>
<div class="container">
<<<<<<< HEAD
	<p><?php echo $probability; ?>% da je <?php echo $class; ?>. klasa, tj. <?php echo $name; ?>.</p>
</div>
=======
    <p>Probability: <?php echo $probability; ?>%</p>
    <p>Name: <?php echo $name; ?></p>
    <p>Location: <?php echo $location; ?></p>
    <p>Picture:</p>
    <img src="<?php echo $row['link']; ?>" width="200" height="200">
>>>>>>> master
</div>
</body>
</html>