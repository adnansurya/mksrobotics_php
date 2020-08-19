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
        
        <title><?php echo $webname; ?> - Profil</title>        
    </head>
    <body>
        <?php include('partials/topbar.php'); ?>
        <div id="layoutSidenav">
            <?php include('partials/sidebar.php'); ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Edit Profil</h1>                        
                        <div class="card mb-4">
                            <div class="card-body">
                                <form action="access/password_edit.php" method="post">
                               
                                <div class="row">
                                    <div class="col-md-6 offset-md-3">
                                        <div class="form-group">
                                            <label class="small mb-1" for="usernameTxt">Username</label>
                                            <input class="form-control py-4" id="usernameTxt" type="text" name="username" value="<?php echo $user_session['username'];?>" required/>
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="passTxt">Password Lama</label>
                                            <input class="form-control py-4" id="passTxt" type="password" name="old_pass" required/>
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="passTxt">Password</label>
                                            <input class="form-control py-4" id="passTxt" type="password" name="pass" required/>
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="passTxt">Ulangi Password</label>
                                            <input class="form-control py-4" id="passTxt" type="password" name="pass2" required/>
                                        </div>  
                                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">                                                
                                            <button class="btn btn-primary btn-block"  type="submit">Simpan</button>
                                        </div>                                      
                                    </div>
                                </div>                                           
                                </form>
                            </div>
                        </div>                       
                    </div>
                </main>
                <?php include('partials/footer.php'); ?>
            </div>
        </div>
        <?php include('partials/scripts.php'); ?>
    </body>
</html>       