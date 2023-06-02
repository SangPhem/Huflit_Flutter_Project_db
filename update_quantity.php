<?php 

require "config.php";

if($_SERVER["REQUEST_METHOD"]=='POST'){
    $response = array();
    $cartID = $_POST['cartID'];
    $type = $_POST['type'];

    $check_cart = mysqli_query($connection, "SELECT * FROM cart WHERE id_cart = '$cartID'");
    $result = mysqli_fetch_array($check_cart);

    $qty = $result['quantity'];

    if($result){
        if($type == "add"){
            $update_add = mysqli_query($connection,"UPDATE cart set quantity = quantity + 1 WHERE id_cart = '$cartID'"); 
            if ($update_add) {
                $response['value'] = 1;
                $response['message'] = "Tăng";
                echo json_encode($response);
            } else {
                $response['value'] = 0;
                $response['message'] = "Failed to add the quantity";
                echo json_encode($response);
            }
            
        } else {
             if ($qty == 1) {
                $query_delete = mysqli_query($connection,"DELETE FROM cart WHERE id_cart = '$cartID'");
                if ($query_delete) {
                    $response['value'] = 1;
                    $response['message'] = "";
                    echo json_encode($response);
                } else {
                    $response['value'] = 0;
                    $response['message'] = "Failed to reduce the quantity";
                    echo json_encode($response);
                } 
             } else {
                $update_reduce = mysqli_query($connection,"UPDATE cart set quantity = quantity - 1 WHERE id_cart = '$cartID'"); 
                if ($update_reduce) {
                    $response['value'] = 1;
                    $response['message'] = "Giảm";
                    echo json_encode($response);
                } else {
                    $response['value'] = 0;
                    $response['message'] = "Failed to reduce the quantity";
                    echo json_encode($response);
                }
             }    
        }
    } else {
        $response['value'] = 0;
        $response['message'] = "Failed to add the quantity";
        echo json_encode($response);
    }
}

?>
