<?php
session_start();  

if(($_SESSION['logged_role'] == 'SU' || $_SESSION['logged_role'] == 'AD')){

    $db = new SQLite3('../uploads/mksrobotics.db');
    if(!$db){
            echo '<p>DB Error</p>';
    }else{

        header('Content-Type: application/json');
        $input = filter_input_array(INPUT_POST);


        if ($input['action'] === 'edit') {    
            $sql = $db->exec("UPDATE transit SET nama_barang='" . $input['nama'] . "', jumlah='" . $input['jumlah'] . "'
            WHERE transit_id=" . $input['transit_id']);
        } else if ($input['action'] === 'delete') {
            $sql = $db->exec( "DELETE from transit WHERE transit_id=" . $input['transit_id']);
                    
        } 
    }
    $db->close();
    header('Location: ../transit.php');    
    die(); 

}else{
    echo 'Akses ditolak';
}



?>