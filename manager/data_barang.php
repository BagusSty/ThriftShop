<?php
session_start();
include '../config.php';
if(!isset ($_SESSION['nama'])){
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
                    <a href="beranda_manager.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
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
            <h2><i class='fas fa-box'></i> Data Barang</h2>
        </div>

        <!-- Modal Input -->
        <button type="button" class="btn my-3" data-bs-toggle="modal" data-bs-target="#addUser"><i class='fas fa-box'></i> Tambah Barang</button>
        <div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModal">Input Barang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="input_barang.php" method="post">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" name="nama" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="option" class="form-label">Pilih Kategori</label>
                                <select name="kategori" class="form-control" required>
                                    <option value="">--Pilih Kategori--</option>
                                    <?php
                                    $sql=mysqli_query($conn, "SELECT * FROM tb_kategori");
                                    while ($data=mysqli_fetch_array($sql)) {
                                        ?>
                                        <option value="<?=$data['id_kategori']?>"><?=$data['nama_kategori']?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <div class="mb-3">
                                    <label for="option" class="form-label">Pilih Supplier</label>
                                    <select name="supplier" class="form-control" required>
                                        <option value="">--Pilih Supplier--</option>
                                        <?php
                                        $sql=mysqli_query($conn, "SELECT * FROM tb_supplier");
                                        while ($data=mysqli_fetch_array($sql)) {
                                            ?>
                                            <option value="<?=$data['id_supplier']?>"><?=$data['nama_supplier']?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="stok" class="form-label">Stok</label>
                                    <input type="number" name="stok" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="harga_pokok" class="form-label">Harga Pokok</label>
                                    <input type="number" name="harga_pokok" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="harga_jual" class="form-label">Harga Jual</label>
                                    <input type="number" name="harga_jual" class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" value="Simpan" name="simpan" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <form class="row float-sm-end " action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
            <div class="form-group col-lg my-2">
                <input class="form-control px-3" type="text" name="cari" placeholder="Pencarian" >
            </div>
            <div class="col-lg my-2">
                <button class=" btn btn-sm p-2" type="submit" name="submit"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <table class="table table-sm">
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Supplier</th>
                <th>Stok</th>
                <th>harga Pokok</th>
                <th>Harga Jual</th>
                <th>Opsi</th>
            </tr>
            <?php
            if(isset($_POST['cari'])) {
                $cari=$_POST['cari'];
                $tb_barang= mysqli_query($conn,"SELECT * FROM tb_barang,tb_supplier,tb_kategori
                    WHERE  tb_barang.id_kategori=tb_kategori.id_kategori AND tb_barang.id_supplier=tb_supplier.id_supplier AND nama_barang like '%$cari%' or nama_kategori like '%$cari%' or nama_supplier like '%$cari%' or stok like '%$cari%' or harga_pokok like '%$cari%' or harga_jual like '%$cari%'") or die($conn->error);
            } else {
                $tb_barang = mysqli_query($conn,"SELECT * FROM tb_barang,tb_supplier,tb_kategori
                    WHERE tb_barang.id_kategori=tb_kategori.id_kategori AND tb_barang.id_supplier=tb_supplier.id_supplier");
            }
            $no = 1;
            while ($dt_barang = $tb_barang->fetch_assoc()) {
                $barang[] = $dt_barang;
            }
            if (empty($barang)) : ?>
                <tr>
                    <td colspan="8">Tidak ada data</td>
                </tr>
                <?php else :?>
                    <?php foreach ($barang as $data) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $dt_barang['nama_barang']; ?></td>
                            <td><?= $dt_barang['nama_kategori'] ?></td>
                            <td><?= $dt_barang['nama_supplier']; ?></td>
                            <td><?= $dt_barang['stok'] ?></td>
                            <td><?= $dt_barang['harga_pokok'] ?></td>
                            <td><?= $dt_barang['harga_jual'] ?></td>
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editUser<?php echo $dt_barang['id_barang'];?>">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <!-- Modal Edit -->
                                <div class="modal fade" id="editUser<?php echo $dt_barang['id_barang'];?>" tabindex="-1" aria-labelledby="editUserLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editUserLabel">Edit Barang</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="edit_barang.php" method="post">
                                                    <input type="hidden" name="id_barang" value="<?= $dt_barang['id_barang'] ?>">
                                                    <div class="mb-3">
                                                        <label for="nama" class="form-label">Nama</label>
                                                        <input type="text" name="nama" value="<?= $dt_barang['nama_barang'] ?>" class="form-control" disabled>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="option" class="form-label">Pilih Kategori</label>
                                                        <select name="jabatan" class="form-control" disabled>
                                                            <option value="">--Pilih Kategori--</option>
                                                            <?php
                                                            $sql=mysqli_query($conn, "SELECT * FROM tb_kategori");
                                                            while ($data=mysqli_fetch_array($sql)) {
                                                                ?>
                                                                <option value="<?=$data['id_kategori']?>"><?=$data['nama_kategori']?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                        <div class="mb-3">
                                                            <label for="option" class="form-label">Pilih Supplier</label>
                                                            <select name="jabatan" class="form-control" disabled>
                                                                <option value="">--Pilih Supplier--</option>
                                                                <?php
                                                                $sql=mysqli_query($conn, "SELECT * FROM tb_supplier");
                                                                while ($data=mysqli_fetch_array($sql)) {
                                                                    ?>
                                                                    <option value="<?=$data['id_supplier']?>"><?=$data['nama_supplier']?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="stok" class="form-label">Stok</label>
                                                            <input type="number" name="stok" value="<?= $dt_barang['stok'] ?>" class="form-control" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="harga_pokok" class="form-label">Harga Pokok</label>
                                                            <input type="number" name="harga_pokok" value="<?= $dt_barang['harga_pokok'] ?>" class="form-control" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="harga_jual" class="form-label">Harga Jual</label>
                                                            <input type="number" name="harga_jual" value="<?= $dt_barang['harga_jual'] ?>" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" value="Simpan" name="simpan" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn">
                                    <a href="hapus_barang.php?id=<?php echo $dt_barang['id_barang']?>" onclick="return confirm('anda yakin akan menghapus data?')"><i class="fas fa-trash"></i>Hapus</span></a>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
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