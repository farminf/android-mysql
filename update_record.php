<?php
//update a record in DB

// array for JSON response
$response = array();

// check for required fields
if (isset($_POST['pid']) && isset($_POST['lat']) && isset($_POST['lon']) ) {

	$pid = $_POST['pid'];
	$lat = $_POST['lat'];
	$lon = $_POST['lon'];
	$description = $_POST['description'];

	// include db connect class
	require_once __DIR__ . '/db_connect.php';

	// connecting to db
	$db = new DB_CONNECT();

	// mysql update row with matched pid
	$result = mysql_query("UPDATE places SET lat = '$lat', lon = '$lon', description = '$description' WHERE pid = $pid");

	// check if row inserted or not
	if ($result) {
		// successfully updated
		$response["success"] = 1;
		$response["message"] = "record successfully updated.";

		// echoing JSON response
		echo json_encode($response);
	} else {

	}
} else {
	// required field is missing
	$response["success"] = 0;
	$response["message"] = "Required field(s) is missing";

	// echoing JSON response
	echo json_encode($response);
}
?>