<?php
session_start();  

if(isset($_SESSION['logged_user'])){

    if(isset($_POST['old_pass']) && isset($_POST['username'])  && isset($_POST['pass']) && isset($_POST['pass2'])){

        if($_POST['pass'] == $_POST['pass2']){

            $db = new SQLite3('../uploads/mksrobotics.db');
            if(!$db){
                    echo '<p>DB Error</p>';
            }else{

                $check_pass = $db->querySingle("SELECT COUNT(*) as count FROM user WHERE  username = '".$_POST['username']."' AND pass ='".$_POST['old_pass']."'");  

                if($check_pass==1){
                    $sql = $db->exec("UPDATE user SET username='" . $_POST['username'] . "', pass='" . $_POST['pass'] . "'
                    WHERE username='" . $_SESSION['logged_user']."'");

                    header('Location: ../logout.php');    
                    die(); 
                }else{
                    echo 'Password Lama Tidak Cocok';
                }

                
            }
            $db->close();    
        }else{
            echo "Password Tidak Sama";
        }     
    }else{
        echo 'Data Tidak Lengkap';
    }

    

}


?>