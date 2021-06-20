<?php 
session_start();
include('access/session.php'); 
include('partials/global.php'); 

 ?>

        
        
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('partials/head.php'); ?>
        
        <title><?php echo $webname; ?> - Daftar</title>        
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
                        <h1>Daftar</h1>
                    </div>          
                    </div>
                </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <!-- Default box -->
                        <div class="card">
                    
                            <div class="card-body">
                                <form class="form-horizontal" action="access/registration.php" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label"for="nameTxt">Nama</label>
                                            <div class="col-sm-9">
                                            <input class="form-control" type="text" name="name" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label"for="addressTxt">Alamat</label>
                                            <div class="col-sm-9">
                                            <input class="form-control"  type="text" name="address"/>
                                            </div>
                                        </div>                                        
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="emailTxt">Email</label>
                                            <div class="col-sm-9">
                                            <input class="form-control"  type="email" name="email" required/>
                                            </div>
                                        </div>  
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="hpTxt">No. HP</label>
                                            <div class="col-sm-9">
                                            <input class="form-control" type="text" name="hp" required/>
                                            </div>
                                        </div> 
                                    </div>
                                   
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="jobTxt">Pekerjaan</label>
                                            <div class="col-sm-9">
                                            <input class="form-control" type="text" name="job" required/>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="companyTxt">Instansi</label>
                                            <div class="col-sm-9">
                                            <input class="form-control" type="text" name="company" required/>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-12">
                                        <hr> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="passwordTxt">Password</label>
                                            <div class="col-sm-9">
                                            <input class="form-control" type="text" name="password" required/>
                                            </div>
                                        </div>   
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="passwordTxt">Ulang Password</label>
                                            <div class="col-sm-9">
                                            <input class="form-control" type="text" name="password" required/>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <div class="offset-sm-3 col-sm-9">
                                            <button type="submit" class="btn btn-success">Simpan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
   
                                </form>
                            </div>
                            <!-- /.card-body -->                   
                        </div>
                        <!-- /.card -->
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
