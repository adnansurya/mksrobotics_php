<?php
session_start();  

include_once '../bot/command.php';
include_once 'secret.php';
include_once '../partials/global.php';

if(($_SESSION['logged_role'] == 'SU' || $_SESSION['logged_role'] == 'AD')){

    $db = new SQLite3('../uploads/mksrobotics.db');
    if(!$db){
            echo '<p>DB Error</p>';
    }else{

        header('Content-Type: application/json');
        $input = filter_input_array(INPUT_POST);
        $user_session = $db->querySingle("SELECT * FROM user WHERE username = '".$_SESSION['logged_user']."'", true);

        if ($input['action'] === 'edit') {    
            $sql = $db->exec("UPDATE transit SET nama_barang='" . $input['nama'] . "', jumlah='" . $input['jumlah'] . "'
            WHERE transit_id=" . $input['transit_id']);
        } else if ($input['action'] === 'delete') {
            $item_transit = $db->querySingle("SELECT * FROM transit WHERE transit_id=" . $input['transit_id'], true);  
            $nama = $item_transit['nama_barang'];
            $jumlah = $item_transit['jumlah'];
            $sql = $db->exec( "DELETE from transit WHERE transit_id=" . $input['transit_id']);
            if($sql){
                $pesan = '<b>'.$nama.' - '.$jumlah. ' pcs</b> dihapus dari transit oleh <i>'.$user_session['nickname'].'</i>';
            }else{
                $pesan = 'Kesalahan penghapusan item transit';
            }
          
            sendMessage($adminGroupId, $pesan, $tokenAPI);
                    
        } 
    }
    $db->close();
    redirectJs('../transit.php');
    die(); 

}else{
    echo 'Akses ditolak';
}



?>