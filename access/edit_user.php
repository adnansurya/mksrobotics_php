<?php
session_start();  

if(($_SESSION['logged_role'] == 'SU')){

    $db = new SQLite3('../uploads/mksrobotics.db');
    if(!$db){
            echo '<p>DB Error</p>';
    }else{

        header('Content-Type: application/json');
        $input = filter_input_array(INPUT_POST);


        if ($input['action'] === 'edit') {    
            $sql = $db->exec("UPDATE user SET name='" . $input['name'] . "', address='" . $input['address'] . "', email='" . $input['email'] . "', 
            telegram_id='" . $input['telegram_id'] . "', nickname='" . $input['nickname'] . "', hp='" . $input['hp'] . "', 
            role='" . $input['role'] . "', rolename='" . $input['rolename'] . "', username='" . $input['username'] . "'
            WHERE user_id=" . $input['user_id']);
        } else if ($input['action'] === 'delete') {
            $sql = $db->exec("DELETE from user WHERE user_id='" . $input['user_id'] . "'");
                    
        } 
    }
    $db->close();
    header('Location: ../data_user.php');    
    die(); 

}else{
    echo 'Akses ditolak';
}

?>