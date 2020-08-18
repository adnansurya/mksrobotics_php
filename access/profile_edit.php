<?php
session_start();  

if(isset($_SESSION['logged_user'])){

    if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['username'])  && isset($_POST['pass']) && isset($_POST['pass2'])){

        if($_POST['pass'] == $_POST['pass2']){

            $db = new SQLite3('../uploads/mksrobotics.db');
            if(!$db){
                    echo '<p>DB Error</p>';
            }else{

                $sql = $db->exec("UPDATE user SET name='" . $_POST['name'] . "', address='" . $_POST['address'] . "', email='" . $_POST['email'] . "', 
                telegram_id='" . $_POST['telegram_id'] . "', nickname='" . $_POST['nickname'] . "', username='" . $_POST['username'] . "', hp='" . $_POST['hp'] . "', 
                pass='" . $_POST['pass'] . "'
                WHERE username='" . $_SESSION['logged_user']."'");
            }
            $db->close();    
        }else{
            echo "Password Tidak Sama";
        }     
    }else{
        echo 'Data Tidak Lengkap';
    }

    

}

header('Location: ../profil.php');    
die(); 

?>