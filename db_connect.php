<?php 

// Create a new MySQLi database connection
$conn= new mysqli('localhost','root','','tms_db')or die("Could not connect to mysql".mysqli_error($con));

// The 'localhost' parameter specifies the database server location.
// 'root' is typically the username used to connect to the database.
// '' is an empty password, which might be suitable for a local development environment.
// 'tms_db' is the name of the database being connected to.
// If the connection fails, the 'die' function is called with an error message.
