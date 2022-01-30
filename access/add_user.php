<?php
session_start();  

if(($_SESSION['logged_role'] == 'SU')){

    if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['nickname']) && isset($_POST['role'])
     && isset($_POST['rolename']) && isset($_POST['username']) && isset($_POST['pass'])){

        $db = new SQLite3('../uploads/mksrobotics.db');
        if(!$db){
                echo '<p>DB Error</p>';
        }else{

            $sql = $db->exec("INSERT INTO user (username, pass, name, address, email, telegram_id, nickname, role, rolename, hp) 
              VALUES ('".$_POST['username']."','".password_hash($_POST['pass'], PASSWORD_DEFAULT)."','".$_POST['name']."','".$_POST['address']."',
              '".$_POST['email']."','".$_POST['telegram_id']."','".$_POST['nickname']."','".$_POST['role']."',
              '".$_POST['rolename']."','".$_POST['hp']."')");
        }
        $db->close();   
        header('Location: ../data_user.php');     
        die() ;
              
     }else{
        echo 'Data tidak lengkap';
     }

    

}


?>