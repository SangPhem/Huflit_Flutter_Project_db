<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "med_app_db";

// Create a new connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute the SQL query to fetch doctor data
$sql = "SELECT * FROM doctor";
$result = $conn->query($sql);

// Check if there are any results
if ($result->num_rows > 0) {
    $doctors = array();

    // Fetch each row of data and add it to the doctors array
    while ($row = $result->fetch_assoc()) {
        $doctor = array(
            'idDoctor' => $row['doctor_id'],
            'hoten' => $row['hoten'],
            'chuyennganh' => $row['chuyennganh'],
            'ngaysinh' => $row['ngaysinh'],
            'tuoinghe' => $row['tuoinghe'],
            'benhvien' => $row['benhvien'],
            'sdt' => $row['sdt'],
            'avatar' => $row['avatar']
        );

        $doctors[] = $doctor;
    }

    // Encode the doctors array as JSON
    $response = json_encode($doctors);
} else {
    // No doctors found
    $response = "No doctors found.";
}

// Close the database connection
$conn->close();

// Send the JSON response back
header('Content-Type: application/json');
echo $response;

?>
