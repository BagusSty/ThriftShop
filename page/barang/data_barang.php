 <?php
 session_start();
 include '../../config.php';
 if(!isset ($_SESSION['nama']) ){
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
  <!-- JQuery-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

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
    <?php
    if(($_SESSION['tipe_user'])=="2" ){
      include '../../users/karyawan/sidebar_karyawan.php';
    } elseif(($_SESSION['tipe_user'])=="1" )  {
     include '../../users/admin/sidebar_admin.php';
   }
   ?>
   <!-- Page Content  -->
   <div id="content">
    <?php include_once('../../assets/navbar/navbar.php'); ?>

    <div class="content">
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
              <form method="post" enctype="multipart/form-data">
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
                    <label for="file" class="form-label">Masukkan Gambar</label>
                    <input type="file" name="gambar" class="form-control" accept="image/png, image/jpeg" required>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" value="Simpan" name="tambah" class="btn btn-primary">Simpan</button>
                </div>
              </form>
              <?php
              if (isset($_POST['tambah'])) {
                $ekstensi_diperbolehkan = array('png','jpg');
                $nama = $_POST['nama'];
                $kategori = $_POST['kategori'];
                $filename = $_FILES['gambar']['name'];
                  //mengatur ekstensi foto
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $file_tmp = $_FILES['gambar']['tmp_name'];
                if(in_array($ext, $ekstensi_diperbolehkan) === true) {
                  move_uploaded_file($file_tmp, '../../assets/file/'.$filename);
                    //Insert data ke database
                  $qry = "INSERT INTO tb_barang(nama_barang,id_kategori,gambar) VALUES ('$nama','$kategori','$filename')";
                  $input = mysqli_query($conn,$qry);
                  if ($input== true) {
                    header("Location: data_barang.php");
                    echo '<script>alert("Data Tersimpan")</script>';
                  } else {
                    echo '<script>alert("Data Gagal Tersimpan")</script>';
                    die ("Gagal menginput data: ".mysqli_errno($conn)." - ".mysqli_error($conn));
                  }
                }
              }
              ?>
            </div>
          </div>
        </div>
      </div>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Kategori</th>
            <th>Stok</th>
            <th>harga Pokok</th>
            <th>Harga Jual</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <?php
        $tb_barang = mysqli_query($conn,"SELECT * FROM tb_barang,tb_kategori WHERE tb_barang.id_kategori=tb_kategori.id_kategori");
        $no = 1;
        while ($barang = $tb_barang->fetch_assoc()) : ?>
          <tbody>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $barang['nama_barang'] ?></td>
              <td><?= $barang['nama_kategori'] ?></td>
              <td><?= $barang['stok'] ?></td>
              <td><?= "Rp. ".number_format($barang['harga_pokok'],2,',','.') ?></td>
              <td><?= "Rp. ".number_format($barang['harga_jual'],2,',','.') ?></td>
              <td>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editUser<?php echo $barang['id_barang'];?>">
                  <i class="fas fa-edit"></i> Edit
                </button>
                <!-- Modal Edit -->
                <div class="modal fade" id="editUser<?php echo $barang['id_barang'];?>" tabindex="-1" aria-labelledby="editUserLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="editUserLabel">Edit Barang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form action="update_barang.php" method="post" enctype="multipart/form-data">
                          <input type="hidden" name="id_barang" value="<?= $barang['id_barang'] ?>">
                          <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" name="nama_barang" value="<?= $barang['nama_barang'] ?>" class="form-control">
                          </div>
                          <div class="mb-3">
                            <label for="option" class="form-label">Pilih Kategori</label>
                            <select name="nama_kategori" class="form-control">
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
                          </div>
                          <div class="mb-3">
                            <label for="file" class="form-label">Masukkan Gambar</label>
                            <input type="file" name="gambar" class="form-control" accept="image/png, image/jpeg" required>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" value="Simpan" name="edit" class="btn btn-primary">Simpan</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#delete<?php echo $barang['id_barang'];?>">
                  <i class="fas fa-trash"></i> Hapus
                </button>
                <!-- Modal Delete -->
                <div class="modal fade" id="delete<?php echo $barang['id_barang'];?>" tabindex="-1" aria-labelledby="editUserLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="editUserLabel">Hapus Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form action="hapus_barang.php" method="post">
                          <input type="hidden" name="id_barang" value="<?= $barang['id_barang'];?>">
                          <div class="modal-footer">
                            <button type="submit" data-bs-dismiss="modal" class="btn-danger">Tidak</button>
                            <button type="submit" value="delete" name="delete" class="btn-primary">Hapus</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        <?php endwhile; ?>
      </table>
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