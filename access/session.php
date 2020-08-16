<?php
    

   if(isset($_SESSION['logged_user'])){

    $db = new SQLite3('uploads/mksrobotics.db');
    if(!$db){
            echo '<p>DB Error</p>';
    }

    $user_session = $db->querySingle("SELECT * FROM user WHERE username = '".$_SESSION['logged_user']."'", true);

   }
?>