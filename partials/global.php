<?php 
    $webname = 'MKSROBOTICS';
    $server = $_SERVER['SERVER_NAME'];
    $pagenow = basename($_SERVER['PHP_SELF']);
    
    
    
    
    $datenow = new \DateTime('now', new DateTimeZone('Asia/Makassar'));
    $datenow = $datenow->format('d/m/Y');
    $datenow = explode('/', $datenow);
    $dateNowObj = new stdClass;
    $dateNowObj -> day = $datenow[0];
    $dateNowObj -> month = $datenow[1];
    $dateNowObj -> year = $datenow[2];
    // $dateNow = json_encode($dateObj);
    

    function getTime($stamp){
        $date = new \DateTime('now', new DateTimeZone('Asia/Makassar'));
        $date->setTimestamp($stamp);
        return $date->format('d/m/Y H:i:s');        
    }
  
    
    function getProductId($itemUxId){
        $dbProduct = new SQLite3('uploads/product.db');
        if(!$dbProduct){
            echo '<p>DB Product Error</p>';
        }
        $itemID = $dbProduct->querySingle("SELECT product_id FROM table_product WHERE product_uxid = '".$itemUxId ."'");
        return $itemID;
     }

    function getProductDetails($itemId){
        $dbDetails = new SQLite3('uploads/mksrobotics.db');
        if(!$dbDetails){
            echo '<p>DB Mks Error</p>';
        }
        $productDetails = $dbDetails->querySingle("SELECT * FROM product_details WHERE product_id = ".$itemId , true);

        return $productDetails;
    }

    function getProductInfo($itemId){
        $dbProduct = new SQLite3('uploads/product.db');
        if(!$dbProduct){
            echo '<p>DB Product Error</p>';
        }
        $productInfo = $dbProduct->querySingle("SELECT * FROM table_product WHERE product_id = ".$itemId, true );

        return $productInfo;
    }

    function getProductPicture($itemId){
        $picture_data = getProductDetails($itemId);

        if(!$picture_data){
            $picture_url = "image/logo.png";
        }else{
            $picture_url = $picture_data['image_url'];
        }
        return $picture_url;
    }

    function getProductDescription($itemId){
        $desc_data = getProductDetails($itemId);

        
        if(!$desc_data){
            $description = "Belum ada deskripsi untuk produk ini.";
        }else{
            $description = $desc_data['description'];
        }
        return $description;
    }

    function priceFormat($inputPrice){

        return number_format($inputPrice, 0, ",", ".");
    
    }

    function getRandomStrings($str_length){
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $input_length = strlen($permitted_chars);
        $random_string = '';
        for($i = 0; $i < $str_length; $i++) {
            $random_character = $permitted_chars[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
    
        return $random_string;
        
    }

    function redirectJs($direktori){
        echo '<script>
            window.location.href = "'.$direktori.'";
        </script>';

    }
?>