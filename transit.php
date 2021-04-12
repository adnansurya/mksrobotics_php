<?php 
session_start();
include('access/session.php'); 
include('partials/global.php'); 
if(!($user_session['role'] == 'AD' || $user_session['role'] == 'SU')){
    header("location:login.php");      
    die();
 }

 ?>       
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('partials/head.php'); ?>
        
        <title><?php echo $webname; ?> - Transit</title>  

        <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">           
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
                        <h1>Transit</h1>   
                    </div>          
                    </div>
                </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content">
                <div class="container-fluid">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <button class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#transitModal">  <i class="fas fa-plus mr-2"></i>Tambah Baru</button>
                    </div>
                    <div class="card-body">
                        
                        <div class="table-responsive mt-3">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>                                              
                                        <th>Transit ID</th>                                                
                                        <th>Nama Produk</th>
                                        <th>Jumlah</th>                                                                                                                                     
                                    </tr>
                                </thead>                                        
                                <tbody>
                                <?php
                                $dbProduct = new SQLite3('uploads/mksrobotics.db');
                                $queries = $dbProduct->query("SELECT * from transit");
                                while($row = $queries->fetchArray(SQLITE3_ASSOC) ) {    
                                    echo '<tr>
                                            <td>'.$row['transit_id'].'</td>
                                            <td>'.$row['nama_barang'].'</td>
                                            <td>'.$row['jumlah'].'</td>                                                                                                       
                                        </tr>';
                                }  
                                
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->                   
                </div>
                <!-- /.card -->
                </div>
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            
            <div class="modal fade" id="transitModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Produk Transit Baru</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">                                    
                            <form action="access/add_transit.php" method="post">                                        
                                <div class="form-group">
                                    <label class="small mb-1" for="namaTxt">Nama Produk</label>
                                    <input class="form-control py-4" id="namaTxt" type="text" name="nama"/>
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1" for="jumlahTxt">Jumlah</label>
                                    <input class="form-control py-4" id="jumlahTxt" type="number" name="jumlah"/>
                                </div>                                            
                                <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">                                                
                                    <button class="btn btn-primary"  type="submit">Simpan</button>
                                </div>
                            </form>                                    
                        </div>
                    
                    </div>
                </div>
            </div>  

            <?php include('partials/footer.php'); ?>
        
           
        </div>
        <?php include('partials/scripts.php'); ?>
        <script src="plugins/tabledit/jquery.tabledit.min.js"></script>
        <script>
             $('#dataTable').Tabledit({
            url: 'access/edit_transit.php',
            hideIdentifier : true,
            columns: {
                identifier: [0, 'transit_id'],
                restoreButton: false,
                editable: [[1, 'nama'], [2, 'jumlah']]
            },buttons: {
                delete: {
                    class: 'btn btn-sm btn-danger',
                    html: 'Hapus',
                    action: 'delete'
                },
                confirm: {
                    class: 'btn btn-sm btn-default',
                    html: 'Yakin?'
                },
                edit: {
                    class: 'btn btn-sm btn-info',
                    html: 'Edit',
                    action: 'edit'
                }
            },
        });
        </script>
    </body>
</html>
