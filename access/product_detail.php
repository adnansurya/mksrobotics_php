<?php   
  session_start();
  
  $db = new SQLite3('../uploads/mksrobotics.db');
  if(!$db){
          echo '<p>DB Error</p>';
  }

  if((isset($_POST['id']) && isset($_POST['description']) && isset($_POST['url_image'])) &&($_SESSION['logged_role'] == 'SU' || $_SESSION['logged_role'] == 'AD' || $_SESSION['logged_role'] == 'ED')){
      
      
        
        

      $check_desc = $db->querySingle("SELECT COUNT(*) as count FROM product_details WHERE product_id ='".$_POST['id']."'");
      if($check_desc==1){
          $sql = $db->exec("UPDATE product_details 
          SET image_url='".$_POST['url_image']."', description='".$_POST['description']."' 
          WHERE product_id=".$_POST['id']);
      }else{
          $sql = $db->exec("INSERT INTO product_details (image_url, description, product_id) 
          VALUES ('".$_POST['url_image']."','".$_POST['description']."',".$_POST['id'].")");
      }
      
      if($sql){
          header("location:../data_produk.php");      
          die();
      }else{
          echo 'Operasi database gagal';
      }
    
      
      
    
  }elseif(isset($_GET['req_id']) &&($_SESSION['logged_role'] == 'SU' || $_SESSION['logged_role'] == 'AD'|| $_SESSION['logged_role'] == 'ED')){
    $resObj = new \stdClass();
    $check_desc = $db->querySingle("SELECT COUNT(*) as count FROM product_details WHERE product_id ='".$_GET['req_id']."'");
    if($check_desc==1){
        $desc = $db->querySingle("SELECT * FROM product_details WHERE product_id=".$_GET['req_id'], true);
        $resObj -> result = "success";
        $resObj -> data = $desc;
    }else{
        $resObj -> result = "unknown";
    }
    echo json_encode($resObj);
  }elseif(isset($_GET['get_id'])){
    $resObj = new \stdClass();    

    $dbOri = new SQLite3('../uploads/product.db');
    $check_product = $dbOri->querySingle("SELECT COUNT(*) as count FROM table_product WHERE product_id ='".$_GET['get_id']."'");          
    if($check_product==1){
      $resObj -> result = "success";

      $detail = $dbOri->querySingle("SELECT * FROM table_product WHERE product_id=".$_GET['get_id'], true);   
      unset($detail["product_base_price"]);            
      $resObj -> detail = $detail;    
      $check_desc = $db->querySingle("SELECT COUNT(*) as count FROM product_details WHERE product_id ='".$_GET['get_id']."'");
      if($check_desc==1){
          $desc = $db->querySingle("SELECT * FROM product_details WHERE product_id=".$_GET['get_id'], true);             
          $resObj -> desc = $desc;
      }
      echo json_encode($resObj);
    }else{
      echo 'Produk tidak ditemukan';
    }
    
  }else{
    header("location:../login.php");      
    die();
  }
?>