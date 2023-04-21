<?php 

require "config.php";

if($_SERVER["REQUEST_METHOD"]=='POST'){
    $respone = array();
    $cartID = $_POST['cartID'];
    $tipe = $_POST['tipe'];

    $cek_cart = mysqli_query($connection, "SELECT * FROM cart WHERE id_cart = '$cartID'");
    $reseult = mysqli_fetch_array($cek_cart);

    $qty = $reseult['qty'];

    if($reseult){
        if($tipe = "tambah"){
            $update_tambah = mysqli_query($connection,"UPDATE cart set quantity = quantity + 1 WHERE id_cart = '$cartID"); 
            if ($update_tambah) {
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
            
        }else{
             if ($qty = "1") {
                # code...
                $query_delete = mysqli_query($connection,"UPDATE FROM cart WHERE id_cart = '$cartID");
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
                $update_kurang = mysqli_query($connection,"UPDATE cart set quantity = quantity - 1 WHERE id_cart = '$cartID"); 
                if ($update_kurang) {
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
             }
                
        }
    }else{
        $respone['value'] = 0;
        $respone['message'] = "Failed to add the quantity";
        echo json_encode($respone);
    }
}

?>