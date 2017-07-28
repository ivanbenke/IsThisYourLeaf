<?php session_start();
if (isset($_SESSION["class"]) && isset($_SESSION["probability"])) {
	$class = $_SESSION["class"];
	$probability = $_SESSION["probability"];
	session_unset();
} else {
	header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<title>RUAP</title>
</head>
<body>
<div class="container">
	<p><?php echo $probability; ?>% da je <?php echo $class; ?>. klasa.</p>
</div>
</body>
</html>
