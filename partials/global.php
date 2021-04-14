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

    function getPicture($itemId){
    
    
        $dbDetails = new SQLite3('uploads/mksrobotics.db');
        if(!$dbDetails){
            echo '<p>DB Mks Error</p>';
        }
        $pictureUrl = $dbDetails->querySingle("SELECT image_url FROM product_details WHERE product_id = ".$itemId );
        
        if(!$pictureUrl){
            $pictureUrl="image/logo.png";
        }
        return $pictureUrl;
    }
    
    function getProductId($itemUxId){
        $dbProduct = new SQLite3('uploads/product.db');
        if(!$dbProduct){
            echo '<p>DB Product Error</p>';
        }
        $itemID = $dbProduct->querySingle("SELECT product_id FROM table_product WHERE product_uxid = '".$itemUxId ."'");
        return $itemID;
     }
?>