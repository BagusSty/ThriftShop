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
                <div class="sidebar-header mt-5">
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
                    <h2><i class='fas fa-truck'></i> Data Supplier</h2>
                </div>

                 <!-- Modal Input -->
                <button type="button" class="btn my-3" data-bs-toggle="modal" data-bs-target="#addUser"><i class='fas fa-truck'></i> Tambah Supplier</button>
                <div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModal">Input Supplier Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="input_supplier.php" method="post">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Supplier</label>
                                <input type="text" name="nama" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="tel" class="form-label">No HP</label>
                                <input type="tel" class="form-control" name="no_hp" placeholder="08xxxxxxxxxx" pattern="08[0-9]{10}" maxlength="15" required/>
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" name="alamat" class="form-control" required>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" value="Simpan" name="simpan" class="btn btn-primary">Tambah</button>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
                </div>

                <table class="table table-sm table-striped table-bordered">
                    <tr>
                        <th>No</th>
                        <th>Nama Supplier</th>
                        <th>No HP</th>
                        <th>Alamat</th>
                        <th>Opsi</th>
                    </tr>
                    <?php
                    $tb_supplier = mysqli_query($conn, "SELECT * FROM tb_supplier");
                    $no = 1;
                    while ($dt_supplier = $tb_supplier->fetch_assoc()) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $dt_supplier['nama_supplier']; ?></td>
                            <td><?= $dt_supplier['no_hp_supplier'] ?></td>
                            <td><?= $dt_supplier['alamat_supplier']; ?></td>
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editUser<?php echo $dt_supplier['id_supplier'];?>">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <!-- Modal Edit -->
                                <div class="modal fade" id="editUser<?php echo $dt_supplier['id_supplier'];?>" tabindex="-1" aria-labelledby="editUserLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editUserLabel">Edit Supplier</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="edit_supplier.php" method="post">
                                            <input type="hidden" name="id_supplier" value="<?= $dt_supplier['id_supplier'];?>">
                                            <div class="mb-3">
                                                <label for="nama" class="form-label">Nama</label>
                                                <input type="text" id="nama" value="<?= $dt_supplier['nama_supplier'];?>" name="nama" class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="tel" class="form-label">No HP</label>
                                                <input type="tel" id="no_hp" value="<?= $dt_supplier['no_hp_supplier'];?>" class="form-control" name="no_hp" placeholder="08xxxxxxxxxx" pattern="08[0-9]{10}" maxlength="15" required/>
                                            </div>
                                            <div class="mb-3">
                                                <label for="alamat" class="form-label">Alamat</label>
                                                <input type="text" id="alamat" value="<?= $dt_supplier['alamat_supplier'];?>" name="alamat" class="form-control" required>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" value="update" name="simpan" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                <button class="btn">
                                    <a href="hapus_user.php?id=<?php echo $dt_supplier['id_supplier']?>" onclick="return confirm('anda yakin akan menghapus data?')"><i class="fas fa-trash"></i>Hapus</span></a>
                                </button>
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