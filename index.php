<?php 
session_start();
include('access/session.php'); 
include('partials/global.php'); 

?>
       
        
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('partials/head.php'); ?>
        
        <title><?php echo $webname; ?> - Home</title>        
    </head>
    <style>
        /* Necessary for full page carousel*/
    html,
    body,
    .view {
      height: 100%;
    }

    /* Carousel*/
    .carousel,
    .carousel-item,
    .carousel-item.active {
      height: 100%;
    }
    .carousel-inner {
      height: 100%;
    }
    .carousel-item:nth-child(1) {
      background-image: url("https://images.tokopedia.net/img/BgtCLw/2020/9/20/d949bd9e-54a2-4db0-8559-339f430ddb46.jpg?ect=4g");
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center center;
    }
    .carousel-item:nth-child(2) {
      background-image: url("https://images.tokopedia.net/img/BgtCLw/2020/9/20/f8887dd7-51fd-4a73-a257-cc3812a17789.jpg?ect=4g");
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center center;
    }
    .carousel-item:nth-child(3) {
      background-image: url("https://mdbootstrap.com/img/Photos/Horizontal/Nature/full page/img%20(10).jpg");
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center center;
    }
    </style>
    <body>
        <div class="wrapper">
            <?php include('partials/topbar.php'); ?>
           
            <?php include('partials/sidebar.php'); ?>
           
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                
                <!-- Main content -->
                <section class="content">
                
               
                    <!-- <div class="card mb-4">
                        <div class="card-body">
                            <p class="mb-0">
                                This page is an example of using static navigation. By removing the
                                <code>.sb-nav-fixed</code>
                                class from the
                                <code>body</code>
                                , the top navigation and side navigation will become static on scroll. Scroll down this page to see an example.
                            </p>
                        </div>
                    </div> -->
                    <div class="container-fluid">
                        
                        <div class="row">
                            <div class="col-12">
                                <img src="image/Makassar_Robotics_Banner.png" class="img-fluid" alt="Responsive image"> 
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <h3>Terlaris Bulan Ini</h3>
                            </div>                                    
                        </div>  
                        <hr>              
                        <div class="row mb-3">
                           
                                <?php 
                                    $dbCart = new SQLite3('uploads/cart.db');
                                    $sqlQuery = "SELECT Sum(CASE cart_type  WHEN 'SELL' THEN cart_amount  WHEN 'RSELL' THEN -cart_amount END) as count, cart_product_name, cart_product_uxid
                                    FROM table_cart
                                    WHERE cart_month ='".$dateNowObj->month."' AND cart_year='".$dateNowObj->year."' AND (cart_type='SELL' OR cart_type='RSELL') AND cart_status='OK' AND cart_product_sale_price > 20000
                                    GROUP BY cart_product_name
                                    ORDER BY count DESC LIMIT 3";
                                    $queries = $dbCart->query($sqlQuery);
                                    while($row = $queries->fetchArray(SQLITE3_ASSOC) ) {  
                                        $product_id = getProductId($row['cart_product_uxid']);

                                        echo '<div class="col-4">
                                                <a href="detail_produk.php?id='.$product_id.'">
                                                    <div class="card h-100 bg-light d-flex flex-fill">
                                                        <div class="card-body p-0">
                                                            <div class="row">
                                                                <div class="col-12">                                                                    
                                                                    <img src="'.getProductPicture($product_id).'" class="img-fluid" alt="'.$row['cart_product_name'].'">                                                                     
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>';                                                                          
                                    }
            
                                    $dbCart->close(); 
                                    ?>                                                                                                                                                                                            
                                                          
                        </div>
                        <!-- <div class="row my-4">
                            <div class="col-12 text-center">
                                <h2>Sesuatu</h2>
                            </div>                                    
                        </div>                    -->
                         <div class="row">
                            <div class="col-12">
                                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                        <!-- <li data-target="#carouselExampleIndicators" data-slide-to="2"></li> -->
                                    </ol>
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                        <img class="d-block w-100" src="https://images.tokopedia.net/img/BgtCLw/2020/9/20/d949bd9e-54a2-4db0-8559-339f430ddb46.jpg?ect=4g" alt="First slide">
                                        </div>
                                        <div class="carousel-item">
                                        <img class="d-block w-100" src="https://images.tokopedia.net/img/BgtCLw/2020/9/20/f8887dd7-51fd-4a73-a257-cc3812a17789.jpg?ect=4g" alt="Second slide">
                                        </div>
                                        <!-- <div class="carousel-item">
                                        <img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/full page/img%20(10).jpg" alt="Third slide">
                                        </div> -->
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <h3>Rekomendasi Kami</h3>
                            </div>                                    
                        </div>  
                        <hr>              
                        <div class="row">
                            <div class="col-12">                                
                                <div class="row">
                                    <div class="col-md-3 col-6">
                                        <a href="#">
                                            <div class="card">
                                                <div class="card-body h-100">
                                                
                                                    <img src="image/logo.png" class="img-fluid" alt="Responsive image"> 
                                                    
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <a href="#">
                                            <div class="card">
                                                <div class="card-body h-100">                                                
                                                    <img src="image/logo.png" class="img-fluid" alt="Responsive image">                                                     
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <a href="#">
                                            <div class="card">
                                                <div class="card-body h-100">
                                                
                                                    <img src="image/logo.png" class="img-fluid" alt="Responsive image"> 
                                                    
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <a href="#">
                                            <div class="card">
                                                <div class="card-body h-100">
                                                
                                                    <img src="image/logo.png" class="img-fluid" alt="Responsive image"> 
                                                    
                                                </div>
                                            </div>
                                        </a>
                                    </div>                                         
                                       
                                </div>
                                
                            </div>
                            
                        </div>
                    </div>
                                                                        
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <?php include('partials/footer.php'); ?>
        
           
        </div>
        <?php include('partials/scripts.php'); ?>
    </body>
</html>
