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
        
        <title><?php echo $webname; ?> - Dashboard</title>   
        
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">     
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
                    <div class="col-sm-6">
                        <h1>Dashboard</h1>  
                    </div>          
                    </div>
                </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content">
                <div class="container-fluid">                                                                                         
                        <div class="row">
                            <div class="col-xl-3 col-md-6">                               
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3><?php echo $totalProductVariant; ?></h3>

                                        <p>Varian Produk</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-ios-box"></i>
                                    </div>
                                    <a href="data_produk.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">                               
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3><?php echo $totalTransaction; ?></h3>

                                        <p>Penjualan</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">                               
                                <div class="small-box bg-success">
                                    <div class="inner">
                                        <h3><?php echo $totalProductWorth; ?></h3>

                                        <p>Total Nilai Produk (Rp)</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-calculator"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">                               
                                <div class="small-box bg-danger">
                                    <div class="inner">
                                        <h3><?php echo $totalProductCategory; ?></h3>

                                        <p>Kategori</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion  ion-android-bookmark"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
                                    <div class="card-header"><i class="fas fa-chart-area mr-1"></i>Transaksi (Value vs Profit)</div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
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
        <script src="plugins/chart.js/Chart.min.js"></script>
        <!-- <script src="assets/demo/chart-area-demo.js"></script> -->
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

            $dbCart->close();

            $dbTransaction = new SQLite3('uploads/transaction.db');
            $sqlQuery = "SELECT Sum(transaction_total) as nilai, Sum(transaction_profit) as profit, transaction_day
            FROM table_transaction
            WHERE transaction_month ='".$datenow[1]."' AND transaction_year='".$datenow[2]."' AND transaction_type='SELL' AND transaction_status='OK' 
            GROUP BY transaction_day
            ORDER BY transaction_date";

            $thisMonthSellSummary = $dbTransaction->query($sqlQuery);
            $transactionValue = array();
            $transactionProfit = array();
            $transactionDay = array();

            while($r = $thisMonthSellSummary->fetchArray(SQLITE3_ASSOC)){
                $transactionDay[] = $r['transaction_day'];
                $transactionValue[] = intval($r['nilai']);
                $transactionProfit[] = intval($r['profit']);
            }        
            
        ?>
        <script type="text/javascript">
           
            // console.log(`<?php echo json_encode($sqlQuery); ?>`);
            Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#292b2c';

            // Bar Chart Example
            var ctx = document.getElementById("myBarChart");
            var labelProduct = <?php echo json_encode($productName); ?>;
            var labelSell = <?php echo json_encode($productSell); ?>;
            // console.log(labelSell);
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

            Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#292b2c';

            // Area Chart
            var labelDay = <?php echo json_encode($transactionDay); ?>;
            var labelValue = <?php echo json_encode($transactionValue); ?>;
            var labelProfit = <?php echo json_encode($transactionProfit); ?>;
            // console.log(labelValue);
            var ctx = document.getElementById("myAreaChart");
            var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labelDay,
                datasets: [{
                label: "Value",
                lineTension: 0.3,
                backgroundColor: "rgba(2,117,216,0.2)",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data:labelValue,
                },
                {label: "Profit",
                lineTension: 0.3,
                backgroundColor: "blue",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "blue",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data:labelProfit,
                }],
            },
            options: {
                scales: {
                xAxes: [{
                    time: {
                    unit: 'date'
                    },
                    gridLines: {
                    display: false
                    },
                    
                }],
                yAxes: [{
                    ticks: {
                    min: 0,
                    
                    
                    },
                    gridLines: {
                    color: "rgba(0, 0, 0, .125)",
                    }
                }],
                },
                legend: {
                display: true
                }
            }
            });
           

        </script>
    </body>
</html>
