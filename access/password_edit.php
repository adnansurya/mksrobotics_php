<?php
session_start();  

if(isset($_SESSION['logged_user'])){

    if(isset($_POST['old_pass']) && isset($_POST['username'])  && isset($_POST['pass']) && isset($_POST['pass2'])){

        if($_POST['pass'] == $_POST['pass2']){

            $db = new SQLite3('../uploads/mksrobotics.db');
            if(!$db){
                    echo '<p>DB Error</p>';
            }else{
                
                $check_user = $db->querySingle("SELECT * FROM user WHERE  username = '".$_POST['username']."'", true);  
                if($check_user){
                    if(password_verify($_POST['old_pass'],$check_user['pass'])){
                        $hashed_pass =  password_hash($_POST['pass'], PASSWORD_DEFAULT);
                        $sql = $db->exec("UPDATE user SET username='" . $_POST['username'] . "', pass='" .$hashed_pass . "'
                        WHERE username='" . $_SESSION['logged_user']."'");
    
                        header('Location: ../logout.php');    
                        die(); 
                    }else{
                        echo 'Password Lama Tidak Cocok';
                    }
        
                }else{
                    echo 'User tidak ditemukan';
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