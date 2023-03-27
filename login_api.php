<?php
require "config.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    # code...
    $response = array();
    $email = $_POST['email'];
    $password = md5($_POST['matkhau']);

    $query_cek_user = mysqli_query($connection, "SELECT * FROM user WHERE email = '$email'");
    $cek_user_result = mysqli_fetch_array($query_cek_user);

    if ($cek_user_result) {
        # code...
        $query_login = mysqli_query($connection, "SELECT * FROM user WHERE email = '$email' && password = '$password'");
        if ($query_login) {
            # code...
            $response['value'] = 1;
            $response['message'] = "Đăng nhập thành công.";
            $response['user_id'] = $cek_user_result['id_user'];
            $response['hoten'] = $cek_user_result['name'];
            $response['email'] = $cek_user_result['email'];
            $response['sodt'] = $cek_user_result['phone'];
            $response['diachi'] = $cek_user_result['address'];
            $response['created_at'] = $cek_user_result['created_at'];
            $response['message'] = "Đăng nhập thành công.";
            echo json_encode($response);
        } else {
            # code...
            $response['value'] = 2;
            $response['message'] = "Oops, Đăng nhập thất bại";
            echo json_encode($response);
        }
    } else {
        # code...
        $response['value'] = 2;
        $response['message'] = "Tài khoản không tồn tại\nXem lại email và mật khẩu !";
        echo json_encode($response);
    }
}

?>