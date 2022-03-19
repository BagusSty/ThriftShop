<?php
session_start();
include '../config.php';
if(!isset ($_SESSION['username'])){
    header("Location:../index.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Beranda</title>

    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">    <!--CSS-->
    <link rel="stylesheet" href="../css/style.css">

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

            <ul class="list-unstyled components">
                <li>
                    <a href="#"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                </li>
                <li>
                    <a href="#"><i class='fas fa-box'></i> Daftar Barang</a>
                </li>
                <li>
                    <a href="#"><i class='fas fa-money-check-alt'></i> Daftar Transaksi</a>
                </li>
                <li>
                    <a onclick="return confirm('Anda yakin ingin logout ?')" href="../logout.php"><i class="fas fa-sign-out-alt"></i>Log Out</a>
                </li>
            </ul>
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
                            <i class="fa fa-fw fa-user"></i> <?php echo $_SESSION['username']; ?>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdown-profil">
                            <li><a class="dropdown-item" href="#"><i class="fa fa-fw fa-user"></i> Profil</a></li>
                            <li><a class="dropdown-item" href="../logout.php" onclick="return confirm('Anda yakin ingin logout ?')" ><i class="fas fa-sign-out-alt"></i> Log Out</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
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
                        echo " <h4>Selamat Pagi, ". $_SESSION['username']."</h4>";
                        echo "<h4>".$hari_ini.",".date("d-m-Y", $tanggal )."</h4>";
                    }else if(($a>=11) && ($a<=15)){
                        echo " <h4>Selamat Pagi, ". $_SESSION['username']."</h4>";
                        echo "<h4>".$hari_ini.",".date("d-m-Y", $tanggal )."</h4>";
                    }elseif(($a>15) && ($a<=18)){
                        echo " <h4>Selamat Siang, ". $_SESSION['username']."</h4>";
                        echo "<h4>".$hari_ini.",".date("d-m-Y", $tanggal )."</h4>";
                    }else{
                        echo " <h4>Selamat Malam, ". $_SESSION['username']."</h4>";
                        echo "<h4>".$hari_ini.", ".date("d-m-Y", $tanggal )."</h4>";
                    }
                    ?>
                    <hr>
                    <div class="row text-white">
                        <div class="card bg-info m-4" style="width: 18rem;">
                            <div class="card-body">
                                <div class="card-body-icon text-white">
                                    <i class='fas fa-box'></i>
                                </div>
                                <h5 class="card-title">Data Barang</h5>
                                <?php
                                $tb_barang = mysqli_query($conn, "SELECT * FROM tb_barang");
                                echo "<p class='display-4'>".mysqli_num_rows($tb_barang)."</p>";
                                ?>
                                <a href="#"><p class="card-text text-white">Lihat Detail <i class="fas fa-angle-double-right ml-2"></i></p></a>
                            </div>
                        </div>
                        <div class="card bg-success m-4" style="width: 18rem;">
                            <div class="card-body">
                                <div class="card-body-icon text-white">
                                    <i class='fas fa-user'></i>
                                </div>
                                <h5 class="card-title">Data User</h5>
                                <?php
                                $tb_obat = mysqli_query($conn, "SELECT * FROM tb_user");
                                echo "<p class='display-4'>".mysqli_num_rows($tb_obat)."</p>";
                                ?>
                                <a href="data_user.php"><p class="card-text text-white">Lihat Detail <i class="fas fa-angle-double-right ml-2"></i></p></a>
                            </div>
                        </div>
                        <div class="card bg-danger m-4" style="width: 18rem;">
                            <div class="card-body">
                                <div class="card-body-icon text-white">
                                    <i class='fas fa-money-check-alt'></i>
                                </div>
                                <h5 class="card-title">Data Transaksi</h5>
                                <?php
                                $tb_transaksi = mysqli_query($conn, "SELECT * FROM tb_transaksi");
                                echo "<p class='display-4'>".mysqli_num_rows($tb_transaksi)."</p>";
                                ?>
                                <a href="#"><p class="card-text text-white">Lihat Detail <i class="fas fa-angle-double-right ml-2"></i></p></a>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
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
</body>

</html>