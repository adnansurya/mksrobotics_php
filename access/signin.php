<?php
session_start();
if(isset($_POST['user']) && isset($_POST['pass'])) {
    // username and password sent from form 
    
     $myuser = $_POST['user'];
     $mypassword = $_POST['pass'];

    //  echo $myuser.$mypassword;

     $db = new SQLite3('../uploads/mksrobotics.db');
     if(!$db){
             echo '<p>DB Error</p>';
     }

     $count = $db->querySingle("SELECT COUNT(*) as count FROM user WHERE email = '".$myuser."' OR username = '".$myuser."'");  
     

   
    // echo $count;
    
    // If result matched $myusername and $mypassword, table row must be 1 row         
    if($count == 1) {
     //   session_register("myname");
     $getUser = $db->querySingle("SELECT * FROM user WHERE email = '".$myuser."' OR username = '".$myuser."'", true);

     if(password_verify($mypassword,$getUser['pass'])){
      // if($mypassword == $getUser['pass']){
      $_SESSION['logged_user'] = $getUser['username'];
      $_SESSION['logged_role'] = $getUser['role']; 
      $db->close();                      
      header("location: ../index.php");
      die();
     }else{
        echo 'Password Invalid';
     }
     
   //   $logged_user = $db->querySingle("SELECT username,role FROM user WHERE (email = '".$myuser."' OR username = '".$myuser."') AND pass ='".$mypassword."'",true);  
     //  $logged_user = $get_user->fetchArray(SQLITE3_ASSOC);
      // $_SESSION['logged_user'] = $logged_user['username'];
      // $_SESSION['logged_role'] = $logged_user['role']; 
      
     

    }else {
       $error = "User Not Found";
       echo $error;

    }
 }else{
     echo 'Data tidak lengkap';
     header("location: ../login.php");
     die();
 }
?>