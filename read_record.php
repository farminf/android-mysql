<?php
//for reading a record from DB

// array for JSON response
$response = array();

// include db connect class
require_once __DIR__ . '/db_connect.php';

// connecting to db
$db = new DB_CONNECT();

// check for post data
if (isset($_GET["pid"])) {
	$pid = $_GET['pid'];

	// get a record from places table
	$result = mysql_query("SELECT * FROM places WHERE pid = $pid");

	if (!empty($result)) {
		// check for empty result
		if (mysql_num_rows($result) > 0) {

			$result = mysql_fetch_array($result);

			$places = array();
			$places["pid"] = $result["pid"];
			$places["lat"] = $result["lat"];
			$places["lon"] = $result["lon"];
			$places["description"] = $result["description"];
			$places["created_at"] = $result["created_at"];
			$places["updated_at"] = $result["updated_at"];
			// success
			$response["success"] = 1;

			// user node
			$response["places"] = array();

			array_push($response["places"], $places);

			// echoing JSON response
			echo json_encode($response);
		} else {
			// no record found
			$response["success"] = 0;
			$response["message"] = "No record found";

			// echo no users JSON
			echo json_encode($response);
		}
	} else {
		// no record found
		$response["success"] = 0;
		$response["message"] = "No record found";

		// echo no users JSON
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