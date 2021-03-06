<?php
mysqli_report (MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include '../../config.php';
if(!isset ($_SESSION['nama']) && !isset($_SESSION['tiper_user'])=="1" ){
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!--CSS Style-->
    <style>
        .card {
            background:linear-gradient(
                166deg,
                rgba(238, 174, 202, 1) 0%,
                rgba(148, 187, 233, 1) 100%
                );
        }
        .display-4 {
            color: black;
        }
    </style>

    <!--Data Tables-->3
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
        <?php include_once('sidebar_admin.php'); ?>

        <!-- Page Content  -->
        <div id="content">
            <?php include_once('../../assets/navbar/navbar.php'); ?>
            <div class="content">
              <div class="mt-5">
                <!--PHP Tanggal-->
                <?php
                $tanggal = mktime(date('m'), date("d"), date('Y'));
                date_default_timezone_set("Asia/Jakarta");
                $hari = date ("D");
                switch($hari){
                    case 'Sun':
                    $hari_ini = "Minggu";
                    break;

                    case 'Mon':
                    $hari_ini = "Senin";
                    break;

                    case 'Tue':
                    $hari_ini = "Selasa";
                    break;

                    case 'Wed':
                    $hari_ini = "Rabu";
                    break;

                    case 'Thu':
                    $hari_ini = "Kamis";
                    break;

                    case 'Fri':
                    $hari_ini = "Jumat";
                    break;

                    case 'Sat':
                    $hari_ini = "Sabtu";
                    break;

                    default:
                    $hari_ini = "Tidak di ketahui";
                    break;
                }
                $jam = date ("H:i:s");
                $a = date ("H");
                if (($a>=6) && ($a<=11)) {
                    echo " <h4>Selamat Pagi, ". $_SESSION['nama']."</h4>";
                    echo "<h4>".$hari_ini.",".date("d-m-Y", $tanggal )."</h4>";
                }else if(($a>=11) && ($a<=15)){
                    echo " <h4>Selamat Pagi, ". $_SESSION['nama']."</h4>";
                    echo "<h4>".$hari_ini.",".date("d-m-Y", $tanggal )."</h4>";
                }elseif(($a>15) && ($a<=18)){
                    echo " <h4>Selamat Siang, ". $_SESSION['nama']."</h4>";
                    echo "<h4>".$hari_ini.",".date("d-m-Y", $tanggal )."</h4>";
                }else{
                    echo " <h4>Selamat Malam, ". $_SESSION['nama']."</h4>";
                    echo "<h4>".$hari_ini.", ".date("d-m-Y", $tanggal )."</h4>";
                }
                ?>
                <hr>
                <div class="row">
                    <div class="card m-4" style="width: 16rem;">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-tshirt"></i>
                            </div>
                            <h5 class="card-title">Data Barang</h5>
                            <?php
                            $tb_barang = mysqli_query($conn, "SELECT * FROM tb_barang");
                            echo "<p class='display-4'>".mysqli_num_rows($tb_barang)."</p>";
                            ?>
                            <a href="../../page/barang/data_barang.php"><p style="color: black;" class="card-text">Lihat Detail <i class="fas fa-angle-double-right ml-2"></i></p></a>
                        </div>
                    </div>
                    <div class="card m-4" style="width: 16rem;">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-columns"></i>
                            </div>
                            <h5 class="card-title">Data Kategori</h5>
                            <?php
                            $tb_kategori = mysqli_query($conn, "SELECT * FROM tb_kategori");
                            echo "<p class='display-4'>".mysqli_num_rows($tb_kategori)."</p>";
                            ?>
                            <a href="../../page/kategori/data_kategori.php"><p style="color: black;" class="card-text">Lihat Detail <i class="fas fa-angle-double-right ml-2"></i></p></a>
                        </div>
                    </div>
                    <div class="card m-4" style="width: 16rem;">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class='fas fa-user'></i>
                            </div>
                            <h5 class="card-title">Data User</h5>
                            <?php
                            $tb_user = mysqli_query($conn, "SELECT * FROM tb_user");
                            echo "<p class='display-4'>".mysqli_num_rows($tb_user)."</p>";
                            ?>
                            <a href="../../page/user/data_user.php"><p  style="color: black;" class="card-text">Lihat Detail <i class="fas fa-angle-double-right ml-2"></i></p></a>
                        </div>
                    </div>
                    <div class="card m-4" style="width: 16rem;">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class='fas fa-truck'></i>
                            </div>
                            <h5 class="card-title">Data Supplier</h5>
                            <?php
                            $tb_supplier = mysqli_query($conn, "SELECT * FROM tb_supplier");
                            echo "<p class='display-4'>".mysqli_num_rows($tb_supplier)."</p>";
                            ?>
                            <a href="../../page/supplier/data_supplier.php"><p  style="color: black;" class="card-text">Lihat Detail <i class="fas fa-angle-double-right ml-2"></i></p></a>
                        </div>
                    </div>
                    <div class="card m-4" style="width: 16rem;">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class='fas fa-box'></i>
                            </div>
                            <h5 class="card-title">Data Barang Masuk</h5>
                            <?php
                            $tb_barang_masuk = mysqli_query($conn, "SELECT * FROM tb_barang_masuk");
                            echo "<p class='display-4'>".mysqli_num_rows($tb_barang_masuk)."</p>";
                            ?>
                            <a href="../../page/barangmasuk/data_barang_masuk.php"><p  style="color: black;" class="card-text">Lihat Detail <i class="fas fa-angle-double-right ml-2"></i></p></a>
                        </div>
                    </div>
                    <div class="card m-4" style="width: 16rem;">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class='fas fa-file'></i>
                            </div>
                            <h5 class="card-title">Invoice</h5>
                            <?php
                            $invoice = mysqli_query($conn, "SELECT * FROM tb_transaksi");
                            echo "<p class='display-4'>".mysqli_num_rows($invoice)."</p>";
                            ?>
                            <a href="../../page/invoice/invoice.php"><p  style="color: black;" class="card-text">Lihat Detail <i class="fas fa-angle-double-right ml-2"></i></p></a>
                        </div>
                    </div>
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