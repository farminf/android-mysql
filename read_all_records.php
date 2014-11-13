<?php
//Read all records from DB

// array for JSON response
$response = array();

// include db connect class
require_once __DIR__ . '/db_connect.php';

// connecting to db
$db = new DB_CONNECT();

// get all records from places table
$result = mysql_query("SELECT * FROM places") or die(mysql_error());

// check for empty result
if (mysql_num_rows($result) > 0) {
	// looping through all results
	// records node
	$response["places"] = array();

	while ($row = mysql_fetch_array($result)) {
		// temp user array
		$places = array();
		$places["pid"] = $row["pid"];
		$places["lat"] = $row["lat"];
		$places["lon"] = $row["lon"];
		$places["description"] = $row["description"];
		$places["created_at"] = $row["created_at"];
		$places["updated_at"] = $row["updated_at"];

		// push single record into final response array
		array_push($response["places"], $places);
	}
	// success
	$response["success"] = 1;

	// echoing JSON response
	echo json_encode($response);
} else {
	// no products found
	$response["success"] = 0;
	$response["message"] = "No record found";

	// echo no users JSON
	echo json_encode($response);
}

?>
