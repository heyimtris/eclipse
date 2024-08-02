<?php

// connect to database
$conn = new mysqli('localhost', 'root', '', 'eclipse');

// check connection

if ($conn->connect_error) {
    // return http status code 500 for server error
    http_response_code(500);
    die("Connection failed: ". $conn->connect_error);
} else {
    // return http status code 200 for successful connection
    http_response_code(200);
}

// close the database connection

$conn->close();

?>