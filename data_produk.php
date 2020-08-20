<?php
session_start();
include('access/session.php'); 
include('partials/global.php'); 

if(!($user_session['role'] == 'SU' || $user_session['role'] == 'AD')){
    header("location:login.php");      
    die();
 }

 ?>
<html lang="en">
    <head>
        <?php include('partials/head.php'); ?>
        
        <title><?php echo $webname; ?> - Data Produk</title>  
        
        	
        <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.css"/>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.bootstrap4.css"/>               -->

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
                        <h1 class="mt-4">Data Produk</h1>                        
                        <div class="card mb-4 mt-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>                                              
                                                <th>Nama Produk</th>
                                                <th>Kategori</th>
                                                <th>Modal</th>
                                                <th>Jual</th>
                                                <th>Stok</th>
                                                <th>Satuan</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>                                        
                                        <tbody>
                                        <?php
                                        $dbProduct = new SQLite3('uploads/product.db');
                                        $queries = $dbProduct->query("SELECT * from table_product");
                                        while($row = $queries->fetchArray(SQLITE3_ASSOC) ) {    
                                            echo '<tr>
                                                    <td>'.$row['product_name'].'</td>
                                                    <td>'.$row['product_category_name'].'</td>
                                                    <td>'.$row['product_base_price'].'</td>
                                                    <td>'.$row['product_sale_price'].'</td>
                                                    <td>'.$row['product_stock_amount'].'</td>                                                    
                                                    <td>'.$row['product_unit'].'</td>                                                    
                                                    <td> 
                                                        <button type="button" class="btn btn-light btn-sm m-1" data-toggle="modal" data-target="#detailModal" 
                                                        data-id="'.$row['product_id'].'" data-nama="'.$row['product_name'].'"><i class="fas fa-edit"></i></button>
                                                        <button type="button" class="btn btn-light btn-sm m-1" data-toggle="modal" data-target="#transitModal" 
                                                        data-nama="'.$row['product_name'].'"><i class="fas fa-truck"></i></button>
                                                    </td>
                                                </tr>';
                                        }  
                                        
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>                       
                    </div>
                     <!-- Modal -->
                     <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Detail Produk</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <small>Nama Produk</small>
                                    <p id="namaTxt"></p>
                                    <form action="access/product_detail.php" method="post">
                                        <input type="hidden" name="id" id="productId">
                                        <div class="form-group">
                                        <label class="small mb-1" for="urlImageTxt">Link / URL Gambar</label>
                                        <input class="form-control py-4" id="urlImageTxt" type="text" name="url_image"/>
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="descriptionTxt">Deskripsi</label>
                                        <textarea class="form-control" id="descriptionTxt" name="description" rows="3"></textarea>
                                    </div>                                            
                                    <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">                                                
                                        <button class="btn btn-primary"  type="submit">Simpan</button>
                                    </div>
                                </form>
                                    

                                </div>
                           
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="transitModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Produk Transit</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">                                    
                                    <form action="access/add_transit.php" method="post">                                        
                                        <div class="form-group">
                                            <label class="small mb-1" for="nama2Txt">Nama Produk</label>
                                            <input class="form-control py-4" id="nama2Txt" type="text" name="nama"/>
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
        <!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.js"></script> -->
        <script src="js/datatables/jquery.dataTables.min.js"></script>
        <script src="js/datatables-bs4/dataTables.bootstrap4.min.js"></script>
        <script src="js/datatables-responsive/dataTables.responsive.min.js"></script>
        <script>
             $('#dataTable').DataTable({
                 "responsive" : true
             });

             $('#detailModal').on('show.bs.modal', function (event) {
                var item = $(event.relatedTarget);
                var idProduct = item.data('id');
                let modal = $(this);

                $.ajax({
                    type: "GET",
                    url: 'access/product_detail.php',
                    data: {"req_id": idProduct },
                    success: function(data){
                        let productObj = JSON.parse(data);
                        if(productObj.result != 'unknown'){
                            modal.find('#urlImageTxt').val(productObj.data.image_url);
                            modal.find('#descriptionTxt').text(productObj.data.description);
                        }
                        
                    }
                });

                modal.find('#productId').val(idProduct);
                modal.find('#namaTxt').text(item.data('nama'));

             });

            $("#detailModal").on("hidden.bs.modal", function () {
                let modal = $(this);
                modal.find('#productId').val('');
                modal.find('#namaTxt').text('');
                modal.find('#urlImageTxt').text('');
                modal.find('#descriptionTxt').text('');
            });

            $('#transitModal').on('show.bs.modal', function (event) {
                var item = $(event.relatedTarget);                
                let modal = $(this);
                modal.find('#nama2Txt').val(item.data('nama'));

             });

            $("#transitModal").on("hidden.bs.modal", function () {
                let modal = $(this);
              
                modal.find('#nama2Txt').val('');
                modal.find('#jumlah').val('');
              
            });


        </script>
    </body>
</html>
