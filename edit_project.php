<?php
include 'db_connect.php'; // Include the database connection script
// Retrieve project data from the database based on the 'id' parameter from the URL
$qry = $conn->query("SELECT * FROM project_list where id = ".$_GET['id'])->fetch_array();
// Loop through the retrieved data and create variables using variable
foreach($qry as $k => $v){
	$$k = $v;
}
// Include the 'new_project.php' file to display the form for editing the project
include 'new_project.php';
?>