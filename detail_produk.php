<?php 
session_start();
include('access/session.php'); 
include('partials/global.php'); 

$product_id = isset($_GET["id"]) ? (int)$_GET["id"]: 0;
if($product_id == 0){
    header("location:produk.php");      
    die();
}else{
    $product_details = getProductDetails($product_id);
    $product_info = getProductInfo($product_id);
    $picture_url = getProductPicture($product_id);
    $product_description = getProductDescription($product_id);
}

 ?>

        
        
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('partials/head.php'); ?>
        
        <title><?php echo $webname.' - '.$product_info['product_name']?></title>        
    </head>
    <body>
        <div class="wrapper">
            <?php include('partials/topbar.php'); ?>
           
            <?php include('partials/sidebar.php'); ?>
           
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Detail Produk</h1>
                        </div>                    
                    </div>
                </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content">

                <!-- Default box -->
                <div class="card card-solid">
                    <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                        <h3 class="d-inline-block d-sm-none"><?php echo $product_info['product_name']; ?></h3>
                        <div class="col-12">
                            <img src="<?php echo $picture_url; ?>" class="product-image" alt="Product Image">
                        </div>                        
                        </div>
                        <div class="col-12 col-sm-6">
                            <h3 class="my-3 d-none d-sm-block"><?php echo $product_info['product_name']; ?></h3>                        
                            <a href="produk.php?kat=<?php echo $product_info['product_category_name']; ?>&per=10">
                            <button class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#detailModal"><i class="fas fa-tag mr-2"></i><?php echo $product_info['product_category_name']; ?></button>
                            </a>
                            
                        <hr>                                                
                        <div class="bg-success py-2 px-3 mt-4 col-12">
                            <h1 class="mb-0">
                            Rp <?php echo priceFormat($product_info['product_sale_price']); ?> 
                            </h1>            
                        </div>
                        <div class="col-12 mt-4">
                            <nav class="w-100">
                            <div class="nav nav-tabs" id="product-tab" role="tablist">
                                <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Deskripsi</a>
                              
                            </div>
                            </nav>
                            <div class="tab-content p-3" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"> <?php echo $product_description; ?></div>                            
                            </div>
                        </div>

                       
                        </div>
                    </div>
                    
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <?php include('partials/footer.php'); ?>
        
           
        </div>
        <?php include('partials/scripts.php'); ?>
    </body>
</html>
