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

        <title>Data User</title>

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
                <div class="sidebar-header">
                    <h3>Buganishogi Thrift Shop</h3>
                </div>

                <ul class="list-unstyled components">
                    <li>
                        <a href="beranda_admin.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="#"><i class='fas fa-box'></i> Daftar Barang</a>
                    </li>
                    <li>
                        <a href="#"><i class='fas fa-money-check-alt'></i> Daftar Transaksi</a>
                    </li>
                    <li>
                        <a href="#"><i class='fas fa-truck'></i> Daftar Supplier</a>
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
                <div class="col-md-10 pt-5">
                    <h2><i class='fas fa-user'></i> Data Obat</h2>
                </div>
                <a href="input_obat.php">
                       <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#tambahuser"><i class="fa fa-male"></i> Tambah User</a>
                </a>
                <table class="table table-sm table-striped table-bordered">
                    <tr>
                        <th>NO</th>
                        <th>Nama User</th>
                        <th>Username</th>
                        <th>No HP</th>
                        <th>Jabatan</th>
                        <th colspan="2">Opsi</th>
                    </tr>
                    <?php
                    $tb_user = mysqli_query($conn, "SELECT * FROM tb_user,tb_tipe_user WHERE tb_user.tipe_user = tb_tipe_user.tipe_user");
                    $no=1;
                    while ($dt_user = $tb_user->fetch_assoc()) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $dt_user['nama']; ?></td>
                            <td><?= $dt_user['username'] ?></td>
                            <td><?= $dt_user['no_hp']; ?></td>
                            <td><?= $dt_user['jabatan'] ?></td>
                            <td>
                                <a href="edit_obat.php?id=<?php echo $dt_user['id']?>"><i class="fas fa-edit"></i></span></a>
                            </td>
                            <td>
                                <a href="hapus_obat.php?id=<?php echo $dt_user['id']?>" onclick="return confirm('anda yakin akan menghapus data?')"><i class="fas fa-trash"></i></span></a>
                            </td>
                        </tr>
                    <?php endwhile ?>
                </table>
            <div>
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