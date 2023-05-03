<?php 
    require 'config.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $response = array();
        $id_user = $_POST['id_user'];
        $id_product = $_POST['id_product'];
        
        $cekCart= mysqli_query($connection,"SELECT * FROM cart WHERE id_user ='$id_user' AND id_product = '$id_product'");

        $resultCekcart = mysqli_fetch_array($cekCart);
        if($resultCekcart)
        {
            $response['value'] = 2;
            $response['message'] = "Xin lỗi, sản phẩm này đã có trong giỏ hàng của bạn";
            echo json_encode($response);
        }else{
            $cekProduct = mysqli_query($connection,"SELECT * FROM product WHERE id_product = '$id_product'");
            $fetchProduct = mysqli_fetch_array($cekProduct);
            $fetchPrice = $fetchProduct['price'];
             
            $insertToCart = "INSERT INTO cart VALUE('', '$id_user','$id_product',1,'$fetchPrice',NOW())";

            if(mysqli_query($connection , $insertToCart))
            {  
                $response['value'] = 1;
                $response['message'] = "Thêm vào giỏ thành công";
                echo json_encode($response);
            }
            else{
                $response['value'] = 0;
                $response['message'] = "Thêm vào giỏ thất bại";
                echo json_encode($response);
            }
        }
    }