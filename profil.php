<?php 
session_start();
include('access/session.php'); 
include('partials/global.php'); 
if(!isset($_SESSION['logged_user'])){
    header("location:login.php");      
    die();
}
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
                        <h1>Profil</h1>
                    </div>         
                    </div>
                </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content">

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <img class="profile-user-img img-fluid img-circle"
                                            src="image/logo.png"
                                            alt="User profile picture">
                                    </div>

                                    <h3 class="profile-username text-center"><?php echo $user_session['name'];?> <small>(<?php echo $user_session['nickname'];?>) </small></h3>

                                    <p class="text-muted text-center"><?php echo $user_session['rolename'];?></p>

                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item float-right">
                                            <i class="fas fa-phone mr-1"></i> <a class="small"><?php echo $user_session['hp'];?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <i class="fas fa-envelope mr-1"></i> <a class="small"><?php echo $user_session['email'];?></a>
                                        </li>                                    
                                        <li class="list-group-item">
                                            <i class="fas fa-home mr-1"></i> <a class="small"><?php echo $user_session['address'];?></a>
                                        </li>
                                    </ul>                                  
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header p-2">
                                    <ul class="nav nav-pills">                               
                                        <li class="nav-item"><a class="nav-link active" href="#profil" data-toggle="tab">Edit Profil</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#password" data-toggle="tab">Ubah Password</a></li>
                                    </ul>
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <div class="tab-content">                               
                                        <div class="tab-pane active" id="profil">
                                            <form class="form-horizontal" action="access/profile_edit.php" method="post">
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label"for="nameTxt">Nama</label>
                                                    <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="name" value="<?php echo $user_session['name'];?>" required/>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label"for="addressTxt">Alamat</label>
                                                    <div class="col-sm-10">
                                                    <input class="form-control"  type="text" name="address" value="<?php echo $user_session['address'];?>"/>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label" for="emailTxt">Email</label>
                                                    <div class="col-sm-10">
                                                    <input class="form-control"  type="email" name="email" value="<?php echo $user_session['email'];?>" required/>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label" for="nicknameTxt">Nickname</label>
                                                    <div class="col-sm-10">
                                                    <input class="form-control"  type="text" name="nickname" value="<?php echo $user_session['nickname'];?>" />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label" for="hpTxt">No. HP</label>
                                                    <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="hp" value="<?php echo $user_session['hp'];?>"/>
                                                    </div>
                                                </div>   
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label" for="telegramTxt">Telegram ID</label>
                                                    <div class="col-sm-10">
                                                    <input class="form-control"  type="text" name="telegram_id" value="<?php echo $user_session['telegram_id'];?>"/>
                                                    </div>
                                                </div>                                          
                                                <div class="form-group row">
                                                    <div class="offset-sm-2 col-sm-10">
                                                    <button type="submit" class="btn btn-success">Simpan</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.tab-pane -->
                                        <div class="tab-pane" id="password">
                                            <form class="form-horizontal" action="access/password_edit.php" method="post">
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label" for="usernameTxt">Username</label>
                                                    <div class="col-sm-10">
                                                    <input class="form-control" id="usernameTxt" type="text" name="username" value="<?php echo $user_session['username'];?>" required/>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label" for="passTxt">Password Lama</label>
                                                    <div class="col-sm-10">
                                                    <input class="form-control" id="passTxt" type="password" name="old_pass" required/>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label" for="passTxt">Password</label>
                                                    <div class="col-sm-10">
                                                    <input class="form-control" id="passTxt" type="password" name="pass" required/>
                                                    </div>
                                                </div>                                           
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label" for="pass2Txt">Ulang Password</label>
                                                    <div class="col-sm-10">
                                                    <input class="form-control" id="pass2Txt" type="password" name="pass2" required/>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="offset-sm-2 col-sm-10">
                                                    <button type="submit" class="btn btn-danger">Ubah Password</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.tab-pane -->

                                    </div>
                                    <!-- /.tab-content -->
                                </div><!-- /.card-body -->
                            </div><!-- /.card -->
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
