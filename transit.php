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
        
        	
        <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.css"/> -->
        <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.bootstrap4.css"/>               -->

        <link rel="stylesheet" href="css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="css/responsive.bootstrap4.min.css">

    </head>
    <body>
        <?php include('partials/topbar.php'); ?>
        <div id="layoutSidenav">
            <?php include('partials/sidebar.php'); ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Produk Transit</h1>                        
                        <div class="card mb-4 mt-4">
                            <div class="card-body">
                                <button class="btn btn-success" data-toggle="modal" data-target="#transitModal">Tambah Baru</button>
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
                        </div>                       
                    </div> 
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
                </main>
                <?php include('partials/footer.php'); ?>
            </div>
        </div>
        <?php include('partials/scripts.php'); ?>
        <script src="js/jquery.tabledit.min.js"></script>
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
