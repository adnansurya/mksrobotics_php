<?php 
    $webname = 'MKSROBOTICS';
    $server = $_SERVER['SERVER_NAME'];
    $pagenow = basename($_SERVER['PHP_SELF']);

    function getTime($stamp){
        $date = new \DateTime('now', new DateTimeZone('Asia/Makassar'));
        $date->setTimestamp($stamp);
        return $date->format('d/m/Y H:i:s');        
    }
?>