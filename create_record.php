<?php
//Creating a row in DB

//array for jason response
$response = array();

// check for required fields
if (isset($_POST['lat']) && isset($_POST['lon'])) {

	$lat = $_POST['lat'];
	$lon = $_POST['lon'];
	$description = $_POST['description'];

	// include db connect class
	require_once __DIR__ . '/db_connect.php';

	// connecting to db
	$db = new DB_CONNECT();

	// mysql inserting a new row
	$result = mysql_query("INSERT INTO places(lat, lon, description) VALUES('$lat', '$lon', '$description')");

	// check if row inserted or not
	if ($result) {
		// successfully inserted into database
		$response["success"] = 1;
		$response["message"] = "record successfully created.";

		// echoing JSON response
		echo json_encode($response);
	} else {
		// failed to insert row
		$response["success"] = 0;
		$response["message"] = "Oops! An error occurred.";

		// echoing JSON response
		echo json_encode($response);
	}
} else {
	// required field is missing
	$response["success"] = 0;
	$response["message"] = "Required field(s) is missing";

	// echoing JSON response
	echo json_encode($response);
}
?>