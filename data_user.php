<?php 
session_start();
include('access/session.php'); 
include('partials/global.php'); 

if(!$user_session['role'] == 'SU'){
    header("location:login.php");      
    die();
 }

 ?>      
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('partials/head.php'); ?>
        
        <title><?php echo $webname; ?> - Data User</title>        
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
                        <h1>Data User</h1> 
                    </div>          
                    </div>
                </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content">

                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <button class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#detailModal"><i class="fas fa-plus mr-2"></i>Tambah User</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive mt-3">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>                                              
                                        <th>ID</th>                                                
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Email</th>
                                        <th>HP</th>
                                        <th>Telegram</th>
                                        <th>Nickname</th>
                                        <th>Role</th>
                                        <th>Rolename</th>    
                                        <th>Username</th>                                                                                            
                                    </tr>
                                </thead>                                        
                                <tbody>
                                <?php
                                $dbProduct = new SQLite3('uploads/mksrobotics.db');
                                $queries = $dbProduct->query("SELECT * from user");
                                while($row = $queries->fetchArray(SQLITE3_ASSOC) ) {    
                                    echo '<tr>
                                            <td>'.$row['user_id'].'</td>
                                            <td>'.$row['name'].'</td>
                                            <td>'.$row['address'].'</td>
                                            <td>'.$row['email'].'</td>
                                            <td>'.$row['hp'].'</td>
                                            <td>'.$row['telegram_id'].'</td>                                                    
                                            <td>'.$row['nickname'].'</td> 
                                            <td>'.$row['role'].'</td>   
                                            <td>'.$row['rolename'].'</td>
                                            <td>'.$row['username'].'</td>                                                    
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

                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <!-- Modal -->
            <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">User Baru</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">                                   
                            <form action="access/add_user.php" method="post">
                                    
                                <div class="form-group">
                                    <label class="small mb-1" for="nameTxt">Nama</label>
                                    <input class="form-control py-4" type="text" name="name" required/>
                                </div> 
                                <div class="form-group">
                                    <label class="small mb-1" for="addressTxt">Alamat</label>
                                    <input class="form-control py-4" type="text" name="address"/>
                                </div> 
                                <div class="form-group">
                                    <label class="small mb-1" for="emailTxt">Email</label>
                                    <input class="form-control py-4" type="email" name="email" required/>
                                </div>     
                                <div class="form-group">
                                    <label class="small mb-1" for="hpTxt">No. HP</label>
                                    <input class="form-control py-4" type="text" name="hp"/>
                                </div>  
                                <div class="form-group">
                                    <label class="small mb-1" for="telegramTxt">Telegram ID</label>
                                    <input class="form-control py-4" type="text" name="telegram_id"/>
                                </div> 
                                <div class="form-group">
                                    <label class="small mb-1" for="nicknameTxt">Nickname</label>
                                    <input class="form-control py-4" type="text" name="nickname" required/>
                                </div>    
                                <div class="form-group">
                                    <label class="small mb-1" for="roleTxt">Role</label>
                                    <input class="form-control py-4" id="roleTxt" type="text" name="role" required/>
                                </div>  
                                <div class="form-group">
                                    <label class="small mb-1" for="rolenameTxt">Rolename</label>
                                    <input class="form-control py-4" id="rolenameTxt" type="text" name="rolename" required/>
                                </div>             
                                <div class="form-group">
                                    <label class="small mb-1" for="usernameTxt">Username</label>
                                    <input class="form-control py-4" id="usernameTxt" type="text" name="username" required/>
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1" for="passTxt">Password</label>
                                    <input class="form-control py-4" id="passTxt" type="password" name="pass" required/>
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
            url: 'access/edit_user.php',
            columns: {
                identifier: [0, 'user_id'],
                restoreButton: false,
                editable: [[1, 'name'], [2, 'address'], [3, 'email'], [4, 'hp'], [5, 'telegram_id'], [6, 'nickname'], 
                [7, 'role'], [8, 'rolename'], [9, 'username']]
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
