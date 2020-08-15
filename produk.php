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
                        <hr>
                        <div class="row">
                        
                        <?php


                        $dbProduct = new SQLite3('uploads/product.db');
                        if(!$dbProduct){
                            echo '<p>Error</p>';
                        }
                        $halaman = 10;
                        $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
                        $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
                        // $result = $dbProduct->query("SELECT * FROM table_product ORDER BY product_name");
                        $total = $dbProduct->querySingle("SELECT COUNT(*) as count FROM table_product");                        
                        $pages = ceil($total/$halaman);            
                        $queries = $dbProduct->query("select * from table_product ORDER BY product_name ASC LIMIT ".$mulai.", ".$halaman);
                        $no =$mulai+1;

                        // $ret = $dbProduct->query('SELECT * from table_product ORDER BY product_name');
                        $prod = 0;
                        while($row = $queries->fetchArray(SQLITE3_ASSOC) ) {                          
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
                        <div class="row">
                            <div class="col-12">
                                <nav aria-label="Page navigation example">
                                    <div class="mx-auto">
                                    <ul class="pagination">
                                        <li class="page-item"><a class="page-link" href="?halaman=<?php echo $page-1; ?>"">Sebelumnya</a></li>
                                        <?php for ($i=1; $i<=$pages ; $i++){ ?>
                                            
                                            <li class="page-item <?php if ($page==$i){echo "active";}?>"><a class="page-link" href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                            
                                        <?php } ?>
                                        
                                      <!-- <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>--> 
                                        <li class="page-item"><a class="page-link" href="?halaman=<?php echo $page+1; ?>"">Selanjutnya</a></li> 
                                    </ul>
                                    </div>
                                    
                                </nav>
                            </div>
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
