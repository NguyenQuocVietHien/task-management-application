<?php
include 'db_connect.php'; // Include the database connection script
// Retrieve user data from the database based on the 'id' parameter from the URL
$qry = $conn->query("SELECT * FROM users where id = ".$_GET['id'])->fetch_array();
// Loop through the retrieved data and create variables using variable
foreach($qry as $k => $v){
	$$k = $v;
}
// Include the 'new_user.php' file to display the form for editing the user
include 'new_user.php';
?>