
<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="index.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <a class="nav-link" href="produk.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-store-alt"></i></div>
                    Produk
                </a>
                
                <?php 
                     
                    if($role_session == "customer"){
                        echo '<div class="sb-sidenav-menu-heading">Customer</div>
                        <a class="nav-link" href="lapor.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-plus"></i></div>
                            Lapor Gangguan
                        </a>
                        <a class="nav-link" href="histori.php">
                            <div class="sb-nav-link-icon"><i class="far fa-file-alt"></i></div>
                            Histori
                        </a>';
                    }else if($role_session == "admin"){
                        echo '<div class="sb-sidenav-menu-heading">Admin</div>
                        <a class="nav-link" href="proses.php">
                            <div class="sb-nav-link-icon"><i class="far fa-clock"></i></div>
                            Proses Gangguan
                        </a>                       
                        <a class="nav-link" href="perangkat.php">
                            <div class="sb-nav-link-icon"><i class="far fa-hdd"></i></div>
                            Daftar Perangkat
                        </a>
                        <a class="nav-link" href="laporan.php">
                        <div class="sb-nav-link-icon"><i class="far fa-file-alt"></i></div>
                            Data Laporan
                        </a>';
                    }else if($role_session == "teknisi"){
                        echo '<div class="sb-sidenav-menu-heading">Teknisi</div>
                        <a class="nav-link" href="proses.php">
                            <div class="sb-nav-link-icon"><i class="far fa-file"></i></div>
                            Proses Gangguan
                        </a>
                        <a class="nav-link" href="laporan.php">
                            <div class="sb-nav-link-icon"><i class="far fa-file-alt"></i></div>
                            Data Laporan
                        </a>';
                    }else if($role_session == "superuser"){
                        echo '<div class="sb-sidenav-menu-heading">User</div>
                        <a class="nav-link" href="user.php">
                            <div class="sb-nav-link-icon"><i class="far fa-file"></i></div>
                            User
                        </a>';
                    }
                ?>            
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Log in sebagai:</div>
            <?php echo strtoupper($role_session); ?>
        </div>
    </nav>
</div>