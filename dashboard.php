<?php 
session_start();
include('access/session.php'); 
include('partials/global.php'); 

if(!($user_session['role'] == 'SU' || $user_session['role'] == 'AD'|| $user_session['role'] == 'ED') ){
    header("location:login.php");      
    die();
 }
 $dbProduct = new SQLite3('uploads/product.db');
 $totalProductWorth = $dbProduct->querySingle("SELECT SUM (product_value) as count FROM table_product");
 $totalProductVariant = $dbProduct->querySingle("SELECT COUNT(*) as count FROM table_product");   
 $dbProduct->close();
 $dbTransaction = new SQLite3('uploads/transaction.db'); 
 $totalTransaction = $dbTransaction->querySingle("SELECT COUNT(*) as count FROM table_transaction WHERE transaction_type = 'SELL'"); 
 $dbTransaction->close();
 $dbCategory = new SQLite3('uploads/category.db');
 $totalProductCategory = $dbCategory->querySingle("SELECT COUNT(*) as count FROM table_category"); 
 $dbCategory->close();
 ?>

        
        
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('partials/head.php'); ?>
        
        <title><?php echo $webname; ?> - Blank</title>        
    </head>
    <body>
        <?php include('partials/topbar.php'); ?>
        <div id="layoutSidenav">
            <?php include('partials/sidebar.php'); ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4 mb-4">Dashboard</h1>                                                                           
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">
                                        <small>Varian Produk</small>
                                        <h2><?php echo $totalProductVariant; ?></h2>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="data_produk.php">Rincian</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">
                                        <small>Transaksi Pembelian</small>
                                        <h2><?php echo $totalTransaction; ?></h2>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">
                                        <small>Total Nilai Produk</small>
                                        <h2>Rp. <?php echo $totalProductWorth; ?></h2>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">
                                        <small>Kategori</small>
                                        <h2><?php echo $totalProductCategory; ?></h2>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h2 class="mt-4 mb-4">Bulan Ini</h2>        
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="card mb-4">
                                    <div class="card-header"><i class="fas fa-chart-bar mr-1"></i>Top 10 Terlaris</div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-12">
                                <div class="card mb-4">
                                    <div class="card-header"><i class="fas fa-chart-area mr-1"></i>Area Chart Example</div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>                            
                        </div>                                                  
                    </div>
                </main>
                <?php include('partials/footer.php'); ?>
            </div>
        </div>
        <?php include('partials/scripts.php'); ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <!-- <script src="assets/demo/chart-bar-demo.js"></script> -->
        <?php
            $dbCart = new SQLite3('uploads/cart.db');
            $sqlQuery = "SELECT Sum(CASE cart_type  WHEN 'SELL' THEN cart_amount  WHEN 'RSELL' THEN -cart_amount END) as count, cart_product_name
            FROM table_cart
            WHERE cart_month ='".$dateNowObj->month."' AND cart_year='".$dateNowObj->year."' AND (cart_type='SELL' OR cart_type='RSELL') AND cart_status='OK' 
            GROUP BY cart_product_name
            ORDER BY count DESC LIMIT 10";
            $thisMonthProductSell= $dbCart->query($sqlQuery);
            $productName = array();
            $productSell = array();
            while($r = $thisMonthProductSell->fetchArray(SQLITE3_ASSOC) ) {   
                $productName[] = $r['cart_product_name'];
                $productSell[] = intval($r['count']);
            }
            
        ?>
        <script>
           
            console.log(`<?php echo json_encode($sqlQuery); ?>`);
            Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#292b2c';

            // Bar Chart Example
            var ctx = document.getElementById("myBarChart");
            var labelProduct = <?php echo json_encode($productName); ?>;
            var labelSell = <?php echo json_encode($productSell); ?>;
            console.log(labelSell);
            var myLineChart = new Chart(ctx, {
            type: 'horizontalBar',
            data: {
                labels: labelProduct,
                datasets: [{              
                    backgroundColor: "rgba(2,117,216,1)",
                    borderColor: "rgba(2,117,216,1)",
                    data: labelSell,
                }],
            },
            options: {
                scales: {
                xAxes: [{
                    ticks: {
                    min: 0,                                        
                    },
                    gridLines: {
                    display: false
                    }
                }],
                yAxes: [{
                   
                    gridLines: {
                    display: true
                    }
                }],
                },
                legend: {
                display: false
                }
            }
            });
        </script>
    </body>
</html>
