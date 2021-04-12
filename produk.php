<?php 
session_start();
include('access/session.php'); 
include('partials/global.php'); 


$halaman = isset($_GET["per"]) ? (int)$_GET["per"] : 10;
$kategori = isset($_GET["kat"]) ? $_GET["kat"] : "SEMUA KATEGORI";
$dbProduct = new SQLite3('uploads/product.db');
if(!$dbProduct){
    echo '<p>Error</p>';
}
$last_timestamp = $dbProduct->querySingle("SELECT product_timestamp FROM table_product ORDER BY product_timestamp DESC LIMIT 1");
?>

        
        
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('partials/head.php'); ?>
        
        <title><?php echo $webname; ?> - Produk</title>        
    </head>
    <body>
        <div class="wrapper">
            <?php include('partials/topbar.php'); ?>
           
            <?php include('partials/sidebar.php'); ?>
           
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <h1>Produk</h1>
                        </div> 
                        <div class="col-md-6 text-md-right text-muted mt-2">

                            <small >Update : <?php  echo getTime($last_timestamp);?></small>
                        </div>         
                    </div>
                    <hr>
                
                <div class="row">
                    <div class="col-md-3">
                        <div class="input-group mb-3">                            
                            <select class="custom-select form-control-border border-width-2" onChange="window.location.href=this.value">
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
                                
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="input-group mb-3">                            
                            <select class="custom-select form-control-border border-width-2" onChange="window.location.href=this.value">
                                <option value="?per=10&kat=<?php echo $kategori; ?>" <?php if($halaman==10){ echo 'selected';}?>>10 Item</option>
                                <option value="?per=30&kat=<?php echo $kategori; ?>" <?php if($halaman==30){ echo 'selected';}?>>30 Item</option>
                                <option value="?per=60&kat=<?php echo $kategori; ?>" <?php if($halaman==60){ echo 'selected';}?>>60 Item</option>
                            </select>
                        </div>
                    </div>
                </div>
                </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content"> 
                <div class="container-fluid">             
                        <div class="row">
                            
                            <?php


                        
                        
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
                        echo '<div class="col-lg-2 col-md-4 col-sm-6 col-6 mb-4">
                                <div class="card bg-light d-flex flex-fill h-100">
                                    <div class="card-body p-0">
                                        <div class="row">
                                            <div class="col-12 pb-0">
                                                <img src="image/logo.png" alt="user-avatar" class="img-fluid">
                                            </div>
                                        </div>
                                        <div class="row mx-1 mt-3">
                                            <div class="col-12">
                                                <p class="mb-0 small">'.$row['product_name'].'</p>
                                                
                                            </div>                                            
                                        </div>                                    
                                    </div>
                                    <div class="card-footer px-0">
                                        
                                    
                                            <div class="row">
                                                <div class="col-7" style="padding-top: 3px;">
                                                    <ul class="ml-0 pl-2 mb-0 fa-ul">
                                                        <li class="small"><p class="mb-0"><b>Rp '.$row['product_sale_price'].'</b></p> </li>                                        
                                                    </ul>
                                                </div> 
                                                <div class="col-5"  style="padding-top: 3px;">
                                                    <ul class="mb-0 ml-0 pr-2 fa-ul text-muted float-right">
                                                        <li class="small"><span class="fa-li"><i class="fas fa-sm fa-box"></i></span><b>'.$row['product_stock_amount'].'</b> <small>pcs</small></li>                                        
                                                    </ul>
                                                </div>                                                                      
                                            </div>                                
                                        
                                    </div>
                                </div>
                            </div>';
                            $prod++;
                                
                            }
    
                            $dbProduct->close(); 
                            ?>



                    </div>
                    <nav aria-label="...">
                                   
                        <ul class="pagination pagination-sm justify-content-center">
                            <li class="page-item <?php if ($page==1){echo "disabled";}?>"><a class="page-link" href="?hal=<?php echo ($page-1)."&per=".$halaman."&kat=".$kategori; ?>""><span aria-hidden="true"><<</span></a></li>
                            <?php for ($i=1; $i<=$pages ; $i++){ ?>
                                
                                <li class="page-item <?php if ($page==$i){echo "active";}?>"><a class="page-link" href="?hal=<?php echo $i."&per=".$halaman."&kat=".$kategori; ?>"><?php echo $i; ?></a></li>
                                
                            <?php } ?>                            
                            <li class="page-item <?php if ($page==$pages){echo "disabled";}?>"><a class="page-link" href="?hal=<?php echo ($page+1)."&per=".$halaman."&kat=".$kategori; ?>""><span aria-hidden="true">>></span></a></li> 
                        </ul>
                        
                        
                    </nav>
               
                </div>
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <?php include('partials/footer.php'); ?>
        
           
        </div>
        <?php include('partials/scripts.php'); ?>
        <script src="plugins/responsive-paginate/responsive-paginate.js"></script>
        <script>
        $(document).ready(function () {
            $(".pagination").rPage();
        });
        </script>
    </body>
</html>
