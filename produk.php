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
        <?php include('partials/topbar.php'); ?>
        <div id="layoutSidenav">
            <?php include('partials/sidebar.php'); ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <h1>Produk</h1>
                            </div>
                            <div class="col-md-6 text-md-right">
                                <h6 class="pt-4">
                                    <?php                               
                                        echo getTime($last_timestamp);                                          
                                    ?>
                                </h6>
                            </div>
                        </div>
                        
                        <hr>
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
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
                                       
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-5 offset-lg-4 offset-md-2">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Tampilkan</label>
                                    </div>
                                    <select class="custom-select" onChange="window.location.href=this.value">
                                        <option value="?per=10&kat=<?php echo $kategori; ?>" <?php if($halaman==10){ echo 'selected';}?>>10 Item per Halaman</option>
                                        <option value="?per=20&kat=<?php echo $kategori; ?>" <?php if($halaman==20){ echo 'selected';}?>>20 Item per Halaman</option>
                                        <option value="?per=40&kat=<?php echo $kategori; ?>" <?php if($halaman==40){ echo 'selected';}?>>40 Item per Halaman</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                        
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
                                        <button type="button" class="btn btn-sm btn-info"  data-toggle="modal" data-target="#detailModal" 
                                        data-id="'.$row['product_id'].'" data-nama="'.$row['product_name'].'"><i class="fas fa-search"></i> Lihat</button>
                                    </div>
                                    <div class="col-6 text-right"><button type="button" class="btn btn-sm btn-light">Stok : <b>'.$row['product_stock_amount'].'</b></button></div>
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
                           
                        <!-- </div> -->
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">                                
                                <div class="modal-body">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    <small>Nama Produk</small>
                                    <p id="namaTxt"></p>
                                    <small>Kategori</small>
                                    <p id="kategoriTxt"></p>
                                    <small>Harga</small>
                                    <p id="hargaTxt"></p>
                                    <small>Stok Tersedia</small>
                                    <h4 id="stokTxt"><small id="unitTxt"></small></h4>
                                    <img src="" alt="Belum Ada Gambar" class="img-thumbnail" id="productImg">
                                    <small id="descriptionTxt"></small>                                                                                                                
                                </form>
                                    

                                </div>
                           
                            </div>
                        </div>
                    </div>
                </main>
                <?php include('partials/footer.php'); ?>
            </div>
        </div>
        <?php include('partials/scripts.php'); ?>
        <script src="js/responsive-paginate.js"></script>
        <script>
        $(document).ready(function () {
            $(".pagination").rPage();
        });
            $('#detailModal').on('show.bs.modal', function (event) {
                var item = $(event.relatedTarget);
                var idProduct = item.data('id');
                let modal = $(this);

                $.ajax({
                    type: "GET",
                    url: 'access/product_detail.php',
                    data: {"get_id": idProduct },
                    success: function(data){                        
                        let productObj = JSON.parse(data);
                        if(productObj.result != 'unknown' && productObj.desc != undefined){
                            // modal.find('#urlImageTxt').val(productObj.data.image_url);
                            modal.find('#productImg').attr("src", productObj.desc.image_url);
                            modal.find('#descriptionTxt').text(productObj.desc.description);
                        }
                        modal.find('#kategoriTxt').text(productObj.detail.product_category_name);
                        modal.find('#hargaTxt').text('Rp. ' + productObj.detail.product_sale_price);
                        modal.find('#stokTxt').html(productObj.detail.product_stock_amount + ' <small>' + productObj.detail.product_unit + '</small>');                        

                        
                    }
                });

                modal.find('#productId').val(idProduct);
                modal.find('#namaTxt').text(item.data('nama'));
               
                

             });

            $("#detailModal").on("hidden.bs.modal", function () {
                let modal = $(this);
                modal.find('#productId').val('');
                modal.find('#namaTxt').text('');
                modal.find('#productImg').attr("src", '');
                modal.find('#descriptionTxt').text('');
                modal.find('#kategoriTxt').text('');
                modal.find('#hargaTxt').text('');
            });

        </script>
    </body>
</html>
