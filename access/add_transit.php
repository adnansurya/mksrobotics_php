<?php
session_start();  

if(($_SESSION['logged_role'] == 'SU') || ($_SESSION['logged_role'] == 'AD') ){

    if(isset($_POST['nama']) && isset($_POST['jumlah'])){

        $db = new SQLite3('../uploads/mksrobotics.db');
        if(!$db){
                echo '<p>DB Error</p>';
        }else{

            $check_transit = $db->querySingle("SELECT COUNT(*) as count FROM transit WHERE nama_barang ='".$_POST['nama']."'");

            if($check_transit>=1){
                echo 'Barang sudah terdaftar di transit';
            }else{
                $sql = $db->exec("INSERT INTO transit (nama_barang, jumlah) VALUES ('".$_POST['nama']."','".$_POST['jumlah']."')");
            }
        }
        $db->close(); 
        header('Location: ../transit.php');          
    }
}else{
    echo 'Akses tidak terotorisasi';
}
?>