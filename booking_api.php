<?php
require "config.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $response = array();
    $userId = $_POST['user_id'];
    $doctorId = $_POST['doctor_id'];
    $bookedDate = $_POST['booked_date'];
    $bookedTime = $_POST['booked_time'];

    $query = "INSERT INTO booked_schedule (id_user, doctor_id, booked_date, booked_time) VALUES ('$userId', '$doctorId', '$bookedDate', '$bookedTime')";
    if (mysqli_query($connection, $query)) {
        $response['status'] = 'success';
        $response['message'] = 'Đặt lịch thành công.';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Đặt lịch thất bại.';
    }

    echo json_encode($response);
}
?>
