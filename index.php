<?php 
session_start();
$properties;
$values;
if(isset($_POST["submit"])) {
	$properties = $_POST;
	unset($properties["submit"]);
	$properties = array("Class" => "0") + $properties;
	$values = array_values($properties);
	$properties = array_keys($properties);
}
if (isset($properties)) {
		$data = array(
			"Inputs" => array(
				"input1" => array(
					"ColumnNames" => $properties,
					"Values" => array($values, $values)
				),
			),
			'GlobalParameters' => null
		);
		$requestData = json_encode($data);
		define("WEB_SERVICE_URL", "https://ussouthcentral.services.azureml.net/workspaces/c3e11386b6984d51b2b184c8c062fa7e/services/8387dd57c0d442ac81109dda9d50531b/execute?api-version=2.0&details=true");
		define("API_KEY", "HKprVrsuhkm82rZlyLRI0JP1tKsC3PlX9F9bGB9QlKUDmoTYflaqos8zY6I4qhAkTSHy/u5IQfNKwrao/s414w==");
		$requestHeader = array(
			"Authorization:Bearer " . API_KEY,
			"Content-Length:" . strlen($requestData),
			"Content-Type:application/json",
			"Accept: application/json"
		);
		
		$ch = curl_init(WEB_SERVICE_URL);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $requestData);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $requestHeader);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		$result = curl_exec($ch);
		if(!$result) {
			trigger_error(curl_error($ch));
		}
		$result = json_decode($result, true);
		
		$class = $result["Results"]["output1"]["value"]["Values"][0][45];
		$probability;
		
		$temp = $class;
		
		if ($temp > 21) {
			$temp += 8;
			$probability = $result["Results"]["output1"]["value"]["Values"][0][$temp];
			$probability *= 100;
		} else {
			$temp += 14;
			$probability = $result["Results"]["output1"]["value"]["Values"][0][$temp];
			$probability *= 100;
		}
		
		$_SESSION["class"] = $class;
		$_SESSION["probability"] = $probability;
		
		echo "<script>console.log(".$_SESSION["class"].");</script>";
		echo "<script>console.log(".$_SESSION["probability"].");</script>";
		
		header("Location: show_result.php");
} else {
	$_SESSION["error_type"] = "error";
	$_SESSION["error_msg"] = "Something went horribly wrong.";
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
<form action="" method="POST">
<div class="form-group">
<input type="text" class="form-control" name="Eccentricity" placeholder="Eccentricity" min="0" max="1" step=any>
</div>
<div class="form-group">
<input type="text" class="form-control" name="Aspect_Ratio" placeholder="Aspect ratio" min="0" max="20" step=any>
</div>
<div class="form-group">
<input type="text" class="form-control" name="Elongation" placeholder="Elongation" min="0" max="1" step=any>
</div>
<div class="form-group">
<input type="text" class="form-control" name="Solidity" placeholder="Solidity" min="0" max="1" step=any>
</div>
<div class="form-group">
<input type="text" class="form-control" name="Stochastic_Convexity" placeholder="Stochastic convexity" min="0" max="1" step=any>
</div>
<div class="form-group">
<input type="text" class="form-control" name="Isoperimetric_Factor" placeholder="Isoperimetric factor" min="0" max="1" step=any>
</div>
<div class="form-group">
<input type="text" class="form-control" name="Maximal_Indentation_Depth" placeholder="Maximal indentation depth" min="0" max="1" step=any>
</div>
<div class="form-group">
<input type="text" class="form-control" name="Lobedness" placeholder="Lobedness" min="0" max="10" step=any>
</div>
<div class="form-group">
<input type="text" class="form-control" name="Average_Intensity" placeholder="Average intensity" min="0" max="1" step=any>
</div>
<div class="form-group">
<input type="text" class="form-control" name="Average_Contrast" placeholder="Average contrast" min="0" max="1" step=any>
</div>
<div class="form-group">
<input type="text" class="form-control" name="Smoothness" placeholder="Smoothness" min="0" max="1" step=any>
</div>
<div class="form-group">
<input type="text" class="form-control" name="Third_moment" placeholder="Third moment" min="0" max="1" step=any>
</div>
<div class="form-group">
<input type="text" class="form-control" name="Uniformity" placeholder="Uniformity" min="0" max="1" step=any>
</div>
<div class="form-group">
<input type="text" class="form-control" name="Entropy" placeholder="Entropy" min="0" max="10" step=any>
</div>
<button type="submit" class="btn btn-default" name="submit" value="submit">Submit</button>
</form>
</div>
</body>
</html>