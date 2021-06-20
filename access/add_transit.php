<?php 

session_start();  

include_once '../bot/command.php';
include_once 'secret.php';
include_once '../partials/global.php';

if(($_SESSION['logged_role'] == 'SU') || ($_SESSION['logged_role'] == 'AD') ){

    if(isset($_POST['nama']) && isset($_POST['jumlah'])){

        $db = new SQLite3('../uploads/mksrobotics.db');        
        if(!$db){
                echo '<p>DB Error</p>';
        }else{

            $user_session = $db->querySingle("SELECT * FROM user WHERE username = '".$_SESSION['logged_user']."'", true);
            $check_transit = $db->querySingle("SELECT COUNT(*) as count FROM transit WHERE nama_barang ='".$_POST['nama']."'");

            if($check_transit>=1){
                echo 'Barang sudah terdaftar di transit';
            }else{
                $sql = $db->exec("INSERT INTO transit (nama_barang, jumlah) VALUES ('".$_POST['nama']."','".$_POST['jumlah']."')");
                if($sql){
                    $pesan = '<b>'.$_POST['nama'].' - '.$_POST['jumlah']. ' pcs</b> ditambahkan ke transit oleh <i>'.$user_session['nickname'].'</i>';
                }else{
                    $pesan = 'Kesalahan penambahan item transit';
                }
              
                sendMessage($adminGroupId, $pesan, $tokenAPI);

            }
        }
        $db->close();           
        redirectJs('../transit.php');
    }
}else{
    echo 'Akses tidak terotorisasi';
}
?>