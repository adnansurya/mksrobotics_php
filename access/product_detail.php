<?php   
  session_start();  

  if(($_SESSION['logged_role'] == 'SU' || $_SESSION['logged_role'] == 'AD')){
      $db = new SQLite3('../uploads/mksrobotics.db');
      if(!$db){
              echo '<p>DB Error</p>';
      }else{
        if(isset($_POST['id']) && isset($_POST['description']) && isset($_POST['url_image'])){
        

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
        }elseif(isset($_GET['req_id'])){
          $resObj = new \stdClass();
          $check_desc = $db->querySingle("SELECT COUNT(*) as count FROM product_details WHERE product_id ='".$_GET['req_id']."'");
          if($check_desc==1){
              $detail = $db->querySingle("SELECT * FROM product_details WHERE product_id=".$_GET['req_id'], true);
              $resObj -> result = "success";
              $resObj -> data = $detail;
          }else{
              $resObj -> result = "unknown";
          }
          echo json_encode($resObj);
        }
        else{
          echo 'Data tidak Lengkap';
        }
      }
      
    
  }else{
    header("location:../login.php");      
    die();
  }
?>