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
        <h2><i class="fas fa-columns"></i> Data Kategori</h2>
      </div>

      <!-- Modal Input -->
      <button type="button" class="btn my-3" data-bs-toggle="modal" data-bs-target="#addKategori"><i class="fas fa-columns"></i> Tambah Kategori</button>
      <div class="modal fade" id="addKategori" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addModal">Input Kategori Baru</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post">
                <div class="mb-3">
                  <label for="kategori" class="form-label">Nama Kategori</label>
                  <input type="text" name="kategori" class="form-control" required>
                </div>
                <div class="modal-footer">
                  <button type="submit" value="Simpan" name="tambah" class="btn btn-primary">Simpan</button>
                </div>
              </form>
              <?php
              if (isset($_POST['tambah'])) {
                $kategori = $_POST['kategori'];
                $qry = "INSERT INTO tb_kategori(nama_kategori) VALUES ('$kategori')";
                $input = mysqli_query($conn,$qry);
                if ($input== true) {
                  header("Location: data_kategori.php");
                  echo '<script>alert("Data Tersimpan")</script>';
                } else {
                  echo '<script>alert("Data Gagal Tersimpan")</script>';
                  die ("Gagal menginput data: ".mysqli_errno($conn)." - ".mysqli_error($conn));
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
            <th>NO</th>
            <th>Nama Kategori</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <?php
        $tb_kategori = mysqli_query($conn,"SELECT * FROM tb_kategori");
        $no = 1;
        while ($dt_kategori = $tb_kategori->fetch_assoc()) : ?>
          <tbody>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $dt_kategori['nama_kategori']; ?></td>
              <td>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editKategori<?php echo $dt_kategori['id_kategori'];?>">
                  <i class="fas fa-edit"></i> Edit
                </button>
                <!-- Modal Edit -->
                <div class="modal fade" id="editKategori<?php echo $dt_kategori['id_kategori'];?>" tabindex="-1" aria-labelledby="editUserLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="editUserLabel">Edit Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form action="update_kategori.php" method="post">
                          <input type="hidden" name="id_kategori" value="<?= $dt_kategori['id_kategori'];?>">
                          <div class="mb-3">
                            <label for="kategori" class="form-label">Nama Kategori</label>
                            <input type="text" value="<?= $dt_kategori['nama_kategori'];?>" name="kategori" class="form-control" required>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" value="Simpan" name="update" class="btn btn-primary">Update</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#delete<?php echo $dt_kategori['id_kategori'];?>">
                  <i class="fas fa-trash"></i> Hapus
                </button>
                <!-- Modal Delete -->
                <div class="modal fade" id="delete<?php echo $dt_kategori['id_kategori'];?>" tabindex="-1" aria-labelledby="editUserLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="editUserLabel">Hapus Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form action="hapus_kategori.php" method="post">
                          <input type="hidden" name="id_kategori" value="<?= $dt_kategori['id_kategori'];?>">
                          <div class="modal-footer">
                            <button type="submit" data-bs-dismiss="modal" class="btn-danger">Tidak</button>
                            <button type="submit" value="delete" name="delete" class="btn-primary">Hapus</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
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