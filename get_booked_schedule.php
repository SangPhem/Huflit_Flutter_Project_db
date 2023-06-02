<?php
// Kết nối tới cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "med_app_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối tới cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

// Lấy doctor_id từ request
$doctorId = $_POST['doctor_id'];

// Truy vấn dữ liệu từ bảng booked_schedule với điều kiện doctor_id = $doctorId và sắp xếp theo booked_date tăng dần
$sql = "SELECT * FROM booked_schedule WHERE doctor_id = $doctorId ORDER BY booked_date ASC";
$result = $conn->query($sql);

// Mảng chứa dữ liệu lịch hẹn
$bookedSchedules = array();

if ($result->num_rows > 0) {
    // Lặp qua các hàng kết quả
    while ($row = $result->fetch_assoc()) {
        $bookedSchedule = array(
            'booked_id' => $row['booked_id'],
            'id_user' => $row['id_user'],
            'doctor_id' => $row['doctor_id'],
            'booked_date' => $row['booked_date'],
            'booked_time' => date('H:i:s', strtotime($row['booked_time']))
        );
        // Thêm vào mảng bookedSchedules
        $bookedSchedules[] = $bookedSchedule;
    }
}

// Trả về dữ liệu dạng JSON
echo json_encode($bookedSchedules);

// Đóng kết nối
$conn->close();

?>
