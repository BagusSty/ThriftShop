<?php
mysqli_report (MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include '../../config.php';
if(!isset ($_SESSION['nama'])){
    header("Location:../../index.php");
}
?>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header mt-5">
                <h3>Buganishogi Thrift Shop</h3>
            </div>
            <hr>
            <ul class="list-unstyled components">
                <li>
                    <a href="?page=kasir"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                </li>
                <li>
                    <a href="#submenu2" data-bs-toggle="collapse"><i class='fas fa-money-check-alt'></i> Data Transaksi</a>
                    <ul class="collapse list-unstyled componenets" id=submenu2 data-bs-parent="#menu">
                        <li>
                            <a href="?page=barangmasuk"><i class='fas fa-box'></i> Data Barang Masuk</a>
                        </li>
                        <li>
                            <a href="#"><i class='fas fa-dollar-sign'></i> Data Penjualan</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#submenu3" data-bs-toggle="collapse"><i class="fas fa-clipboard"></i> Laporan</a>
                    <ul class="collapse list-unstyled componenets" id=submenu3 data-bs-parent="#menu">
                        <li>
                            <a href="#">Laporan Barang Masuk</a>
                        </li>
                        <li>
                            <a href="#">Laporan Penjualan</a>
                        </li>
                        <li>
                            <a href="#">Laporan Keuangan</a>
                        </li>
                    </ul>
                </li>
                <hr>
                <li>
                    <a onclick="return confirm('Anda yakin ingin logout ?')" href="../../logout.php"><i class="fas fa-sign-out-alt"></i>Log Out</a>
                </li>
            </ul>
            <span>Copyright © 2022</span>
        </nav>

        <!-- Page Content  -->
        <div id="content">
            <nav class="navbar navbar-expand-sm fixed-out">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn">
                        <i class="fas fa-align-left"></i>
                    </button>
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" id="dropdown-profil" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-fw fa-user"></i> <?php echo $_SESSION['nama']; ?>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdown-profil">
                            <li><a class="dropdown-item" href="#"><i class="fa fa-fw fa-user"></i> Profil</a></li>
                            <li><a class="dropdown-item" href="../../logout.php" onclick="return confirm('Anda yakin ingin logout ?')" ><i class="fas fa-sign-out-alt"></i> Log Out</a></li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="content">
               <?php
               $page = $_GET['page'];
               if ($page == "kasir") {
                include "kasir.php";
            }
            if ($page == "") {
                include "kasir.php";
            }
            if ($page == "barangmasuk") {
                include "../../page/barangmasuk/data_barang_masuk.php";
            }
            ?>
        </div>
    </div>
</div>
</div>
</body>

</html>