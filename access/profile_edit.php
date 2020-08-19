<?php
session_start();  

if(isset($_SESSION['logged_user'])){

    if(isset($_POST['name']) && isset($_POST['email'])){

        

            $db = new SQLite3('../uploads/mksrobotics.db');
            if(!$db){
                    echo '<p>DB Error</p>';
            }else{

                $sql = $db->exec("UPDATE user SET name='" . $_POST['name'] . "', address='" . $_POST['address'] . "', email='" . $_POST['email'] . "', 
                telegram_id='" . $_POST['telegram_id'] . "', nickname='" . $_POST['nickname'] . "', hp='" . $_POST['hp'] . "'
                WHERE username='" . $_SESSION['logged_user']."'");
            }
            $db->close();    
          
    }else{
        echo 'Data Tidak Lengkap';
    }

    

}

header('Location: ../profil.php');    
die(); 

?>