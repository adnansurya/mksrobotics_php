<?php

echo 'test';

$ver = SQLite3::version();

echo $ver['versionString'] . "\n";
echo $ver['versionNumber'] . "\n";

var_dump($ver);


// class MyDB extends SQLite3 {
//     function __construct() {
//         $this->open('product.db');
//     }
// }

// $db = new MyDB();
// if(!$db) {
//     echo $db->lastErrorMsg();
// }

//    $sql =<<<EOF
//       SELECT * from table_product;
// EOF;
$dbName = 'product.php';
// include('access/db_open.php');
$dbProduct = new SQLite3('product.db');
// $result = 

$ret = $dbProduct->query('SELECT * from table_product');
while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
    echo "ID = ". $row['product_id'] . "\n";
    echo "NAME = ". $row['product_name'] ."\n";
    
}
echo "Operation done successfully\n";
$db->close();
?>