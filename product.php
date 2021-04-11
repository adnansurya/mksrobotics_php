<?php 
session_start();
include('access/session.php'); 
include('partials/global.php'); 

 ?>

        
        
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('partials/head.php'); ?>
        
        <title><?php echo $webname; ?> - Blank</title>        
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
                        <h1>Blank Page</h1>
                    </div>          
                    </div>
                </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content">

                <!-- Default box -->
               <div class="row">
                    <div class="col-12 col-sm-6 col-md-3 d-flex align-items-stretch flex-column">
                        <div class="card bg-light d-flex flex-fill">
                            <div class="card-body p-0">
                                <div class="row">
                                    <div class="col-12 pb-0">
                                        <img src="image/logo.png" alt="user-avatar" class="img-fluid">
                                    </div>
                                </div>
                                <div class="row ml-2 mt-1">
                                    <div class="col-12 ">
                                        <p class="mb-0">Nama Produk</p>
                                    </div>
                                </div>
                                <div class="row ml-2 mb-2">
                                    <div class="col-12">
                                        <p class="mb-0"><b>Rp.999.999</b></p>                                                                      
                                    </div>
                                </div> 
                            </div>
                            <div class="card-footer ml-1">
                                
                                <div class="text-right">
                                    <div class="row">
                                        <div class="col-4-auto">
                                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-box"></i></span><b>1</b> pcs</li>                                        
                                            </ul>
                                        </div>                                                                      
                                    </div>                                
                                </div>
                            </div>
                        </div>
                    </div>
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
