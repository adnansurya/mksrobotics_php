<!DOCTYPE html>
<?php 
session_start();  
include('partials/global.php'); 
include('access/session.php');


?>

        
        
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('partials/head.php'); ?>
        
        <title><?php echo $webname; ?> - Produk</title>        
    </head>
    <body>
        <?php include('partials/topbar.php'); ?>
        <div id="layoutSidenav">
            <?php include('partials/sidebar.php'); ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Produk</h1>
                        <div class="row">
                        
                        <?php

                        $dbProduct = new SQLite3('uploads/product.db');
                        if(!$dbProduct){
                            echo '<p>Error</p>';
                        }
                        $ret = $dbProduct->query('SELECT * from table_product');
                        $prod = 0;
                        while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {                          
                    echo '<div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                            <div class="card h-100">                           
                              <div class="card-body">
                                <h5 class="card-title">
                                  <a href="#">'.$row['product_name'].'</a>
                                </h5>
                                <h6><b>Rp. '.$row['product_sale_price'].'</b></h6>
                                <small>'.$row['product_category_name'].'</small>                               
                              </div>
                              <div class="card-footer">
                                <div class="row">
                                    <div class="col-6">
                                        <button type="button" class="btn btn-sm btn-info"><i class="fas fa-search"></i> Lihat</button>
                                    </div>
                                    <div class="col-6 text-right"><button type="button" class="btn btn-sm btn-light">Stok : <b>'.$row['product_stock_amount'].'</b></button></div>
                                </div>
                               
                              </div>
                            </div>
                          </div>';
                          $prod++;
                            
                        }
                        // echo "Operation done successfully\n";
                        $dbProduct->close(); 
                                       
                       

                        ?>



                        </div>
                        <!-- </div> -->
                    </div>
                </main>
                <?php include('partials/footer.php'); ?>
            </div>
        </div>
        <?php include('partials/scripts.php'); ?>
    </body>
</html>
