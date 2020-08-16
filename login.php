<?php 
    session_start();     
    

    if(isset($_SESSION['logged_user'])){
        header("location:index.php");        
    }
    
    
    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('partials/global.php') ?>
        <?php include('partials/head.php'); ?>
        
        <title><?php echo $webname; ?> - Login</title>         
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form action="access/signin.php" method="post">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email atau Username</label>
                                                <input class="form-control py-4" id="inputEmailAddress" type="text" placeholder="Masukkan Email" name="user"/>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input class="form-control py-4" id="inputPassword" type="password" placeholder="Masukkan Password" name="pass"/>
                                            </div>                                            
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">                                                
                                                <button class="btn btn-primary"  type="submit">Login</button>
                                            </div>
                                        </form>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
       <?php include('partials/scripts.php'); ?>
    </body>
</html>