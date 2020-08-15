<!DOCTYPE html>
<?php 
session_start();  
include('partials/global.php'); 
include('access/session.php');

$halaman = isset($_GET["per"]) ? (int)$_GET["per"] : 10;
$kategori = isset($_GET["kat"]) ? $_GET["kat"] : "SEMUA KATEGORI";
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
                            <div class="col-md-4">
                            <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Kategori</label>
                                    </div>
                                    <select class="custom-select" onChange="window.location.href=this.value">
                                        <option value="?kat=SEMUA KATEGORI&per=<?php echo $halaman; ?>" <?php if($kategori=="SEMUA KATEGORI"){ echo 'selected';}?>>SEMUA KATEGORI</option>
                                        <?php   
                                        $dbCategory = new SQLite3('uploads/category.db');
                                        if(!$dbProduct){
                                            echo '<p>Error</p>';
                                        }
                                        $categories = $dbCategory->query("select * from table_category ORDER BY category_name");
                                        while($row = $categories->fetchArray(SQLITE3_ASSOC) ) {       
                                            echo '<option value="?kat='.$row['category_name'].'&per='.$halaman.'"'; if($kategori==$row['category_name']){ echo 'selected';}
                                            echo '>'.$row['category_name'].'</option>';
                                        }
                                        ?>
                                       -->
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 offset-md-4">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Tampilkan</label>
                                    </div>
                                    <select class="custom-select" onChange="window.location.href=this.value">
                                        <option value="?per=10" <?php if($halaman==10){ echo 'selected';}?>>10 Item per Halaman</option>
                                        <option value="?per=20" <?php if($halaman==20){ echo 'selected';}?>>20 Item per Halaman</option>
                                        <option value="?per=40" <?php if($halaman==40){ echo 'selected';}?>>40 Item per Halaman</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        
                        <?php


                        $dbProduct = new SQLite3('uploads/product.db');
                        if(!$dbProduct){
                            echo '<p>Error</p>';
                        }
                       
                        $page = isset($_GET["hal"]) ? (int)$_GET["hal"] : 1;
                        $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
                        // $result = $dbProduct->query("SELECT * FROM table_product ORDER BY product_name");
                        $total = $dbProduct->querySingle("SELECT COUNT(*) as count FROM table_product");                        
                          
                        $sql_syntax = "select * from table_product ORDER BY product_name ASC LIMIT ".$mulai.", ".$halaman;
                        if($kategori != 'SEMUA KATEGORI'){
                            $total = $dbProduct->querySingle("SELECT COUNT(*) as count FROM table_product where product_category_name = '".$kategori."'");
                            $sql_syntax = "select * from table_product where product_category_name = '".$kategori. "' ORDER BY product_name ASC LIMIT ".$mulai.", ".$halaman;
                        }     
                        $pages = ceil($total/$halaman);     
                        $queries = $dbProduct->query($sql_syntax);
                        $no =$mulai+1;
                        
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
                                        <li class="page-item <?php if ($page==1){echo "disabled";}?>"><a class="page-link" href="?hal=<?php echo ($page-1)."&per=".$halaman."&kat=".$kategori; ?>"">Sebelumnya</a></li>
                                        <?php for ($i=1; $i<=$pages ; $i++){ ?>
                                            
                                            <li class="page-item <?php if ($page==$i){echo "active";}?>"><a class="page-link" href="?hal=<?php echo $i."&per=".$halaman."&kat=".$kategori; ?>"><?php echo $i; ?></a></li>
                                            
                                        <?php } ?>                            
                                        <li class="page-item <?php if ($page==$pages){echo "disabled";}?>"><a class="page-link" href="?hal=<?php echo ($page+1)."&per=".$halaman."&kat=".$kategori; ?>"">Selanjutnya</a></li> 
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
