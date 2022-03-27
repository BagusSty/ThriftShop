<?php
mysqli_report (MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include '../../config.php';
if(!isset ($_SESSION['nama'])){
    header("Location:../../index.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Beranda</title>

    <!--Data Tables-->
    <link rel="stylesheet" type="text/css" href="../../assets/DataTables/datatables.min.css"/>

    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">    <!--CSS-->
    <link rel="stylesheet" href="../../css/style.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header mt-5">
                <h3>Buganishogi Thrift Shop</h3>
            </div>
            <hr>
            <ul class="list-unstyled components">
                <li>
                    <a href="?page=manager"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                </li>
                <li>
                    <a href="#submenu1" data-bs-toggle="collapse"><i class="fas fa-folder"></i></i> Data Master</a>
                    <ul class="collapse list-unstyled components" id="submenu1" data-bs-parent="#menu">
                        <li>
                            <a href="?page=databarang"><i class='fas fa-tshirt'></i> Data Barang</a>
                        </li>
                        <li>
                            <a href="?page=datasupplier"><i class='fas fa-truck'></i> Data Supplier</a>
                        </li>
                    </ul>
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
                            <a href="#">Laporan Barang</a>
                        </li>
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
               if ($page == "manager") {
                include "manager.php";
            }
            if ($page == "") {
                include "manager.php";
            }
            if ($page == "databarang") {
                include "../../page/barang/data_barang.php";
            }
             if ($page == "datasupplier") {
                include "../../page/supplier/data_supplier.php";
            }
            if ($page == "barangmasuk") {
                include "../../page/barangmasuk/data_barang_masuk.php";
            }
            ?>
        </div>
    </div>
</div>
</div>

<!--Data Tables JS-->
<script type="text/javascript" src="../../assets/DataTables/datatables.min.js"></script>
<!-- Popper.JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });
    });
</script>
<script type="text/javascript">
    $(document).ready( function () {
        $('.table').DataTable();
    })
</script>
</body>

</html>