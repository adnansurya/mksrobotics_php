
<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">  
                <div class="sb-sidenav-menu-heading">NAVIGASI</div>              
                <a class="nav-link" href="index.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <a class="nav-link" href="produk.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-store-alt"></i></div>
                    Produk
                </a>
                  <!-- Navbar-->
                <?php 
                    if(isset($_SESSION['logged_user'])){
                ?>

                    <?php 
                        if($user_session['role'] == 'SU' || $user_session['role'] == 'AD'){
                    ?>
                        <div class="sb-sidenav-menu-heading">ADMIN</div>
                        <a class="nav-link" href="data_produk.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-file-alt"></i></div>
                            Data Produk
                        </a>
                        <a class="nav-link" href="transit.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-truck"></i></div>
                            Transit
                        </a>

                    <?php  
                        } 
                    ?>

                    <?php 
                        if($user_session['role'] == 'SU'){
                    ?>
                        <div class="sb-sidenav-menu-heading">SUPER USER</div>
                        <a class="nav-link" href="data_user.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            Data User
                        </a>

                    <?php  
                        } 
                    ?>

                <?php
                        
                    }
                ?>
                
               
            </div>
        </div>
        <?php 
            if(isset($_SESSION['logged_user'])){
        ?>
        <div class="sb-sidenav-footer">
            <div class="small">Log in sebagai:</div>
            <?php echo strtoupper($user_session['rolename']); ?>
        </div>
        <?php 
            }
        ?>
    </nav>
</div>