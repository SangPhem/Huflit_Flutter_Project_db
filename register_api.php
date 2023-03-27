<?php

require "config.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    # code...
    $response = array();
    $full_name = $_POST['hoten'];
    $email = $_POST['email'];
    $phone = $_POST['sodt'];
    $address = $_POST['diachi'];
    $password = md5($_POST['matkhau']);

    $query_cek_user = mysqli_query($connection, "SELECT * FROM user WHERE email = '$email' || phone = '$phone'");
    $cek_user_result = mysqli_fetch_array($query_cek_user);

    if ($cek_user_result) {
        # code...
        $response['value'] = 0;
        $response['message'] = "Thông tin đã được sử dụng";
        echo json_encode($response);
    } else {
        $query_insert_user = mysqli_query($connection, "INSERT INTO user VALUE('', '$full_name', '$email', '$phone', '$address', '$password', NOW(), 1)");
        if ($query_insert_user) {
            # code...
            $response['value'] = 1;
            $response['message'] = "Đăng ký thành công. Chuyển tới trang đăng nhập";
            echo json_encode($response);
        } else {
            # code...
            $response['value'] = 2;
            $response['message'] = "Đăng ký thất bại";
            echo json_encode($response);
        }
    }
}

?>