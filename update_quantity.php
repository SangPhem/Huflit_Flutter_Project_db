<?php 

require "config.php";

if($_SERVER["REQUEST_METHOD"]=='POST'){
    $respone = array();
    $cartID = $_POST['cartID'];
    $type = $_POST['type'];

    $check_cart = mysqli_query($connection, "SELECT * FROM cart WHERE id_cart = '$cartID'");
    $result = mysqli_fetch_array($check_cart);

    $qty = $result['quantity'];

    if($result){
        if($type == "add"){
            $update_add = mysqli_query($connection,"UPDATE cart set quantity = quantity + 1 WHERE id_cart = '$cartID'"); 
            if ($update_add) {
                # code...
                $respone['value'] = 1;
                $respone['message'] = "tang";
                echo json_encode($respone);
            } else {
                # code...
                $respone['value'] = 0;
                $respone['message'] = "Failed to add the quantity";
                echo json_encode($respone);
            }
            
        }else{
             if ($qty == "1") {
                # code...
                $query_delete = mysqli_query($connection,"DELETE FROM cart WHERE id_cart = '$cartID");
                if ($query_delete) {
                    # code...
                    $respone['value'] = 1;
                    $respone['message'] = "";
                    echo json_encode($respone);
                } else {
                    # code...
                    $respone['value'] = 0;
                    $respone['message'] = "Failed to add the quantity";
                    echo json_encode($respone);
                } 
             } else {
                # code...
                $update_reduce = mysqli_query($connection,"UPDATE cart set quantity = quantity - 1 WHERE id_cart = '$cartID'"); 
                if ($update_reduce) {
                    # code...
                    $respone['value'] = 1;
                    $respone['message'] = "giam";
                    echo json_encode($respone);
                } else {
                    # code...
                    $respone['value'] = 0;
                    $respone['message'] = "Failed to add the quantity";
                    echo json_encode($respone);
                }
             }
                
        }
    }else{
        $respone['value'] = 0;
        $respone['message'] = "Failed to add the quantity";
        echo json_encode($respone);
    }
}

?>