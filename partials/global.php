<?php 
    $webname = 'MKSROBOTICS';
    $server = $_SERVER['SERVER_NAME'];
    $pagenow = basename($_SERVER['PHP_SELF']);
    
    
    
    
    $datenow = new \DateTime('now', new DateTimeZone('Asia/Makassar'));
    $datenow = $datenow->format('d/m/Y');
    $datenow = explode('/', $datenow);
    $dateNowObj = new stdClass;
    $dateNowObj -> day = $datenow[0];
    $dateNowObj -> month = $datenow[1];
    $dateNowObj -> year = $datenow[2];
    // $dateNow = json_encode($dateObj);
    

    function getTime($stamp){
        $date = new \DateTime('now', new DateTimeZone('Asia/Makassar'));
        $date->setTimestamp($stamp);
        return $date->format('d/m/Y H:i:s');        
    }
?>