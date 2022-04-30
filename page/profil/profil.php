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
    if(isset($_SESSION['tipe_user'])=="1" ){
      include '../../users/admin/sidebar_admin.php';
    } elseif (isset($_SESSION['tipe_user'])=="2" ) {
      include_once('../../users/manager/sidebar_manager.php');
    } elseif (isset ($_SESSION['tipe_user'])=="3") {
      include '../../users/user/sidebar_user.php';
    }
    ?>
    <!-- Page Content  -->
    <div id="content">
      <?php include_once('../../assets/navbar/navbar.php'); ?>

      <div class="col-md-10 pt-5">
        <h2><i class='fas fa-user'></i> Profil</h2>
      </div>
      <?php
      $nama = $_SESSION['nama'];
      $user = mysqli_query($conn, "SELECT * FROM tb_user WHERE nama = '$nama'");
      $dt_user = $user->fetch_assoc();
      ?>
      <div class="card" style="width: 25rem;">
        <div class="text-center"><img class="card-img-center"
          src="../../assets/img/pp.png"
          class="card-img-top" alt="..."
          width="150px">
          <div class="card-body">
            <span class="card-text">Nama : <?= $_SESSION['nama'] ?></span>
            <br>
            <span class="card-text">Username : <?= $dt_user['username'] ?></span>
            <br>
            <span class="card-text">No HP : <?= $dt_user['no_hp'] ?></span>
          </div>
        </div>

        <div class="card-footer">
          <div class="row justify-content-center">
            <button type="button" name="submit" class="btn" data-bs-toggle="modal" data-bs-target="#edit<?php echo $dt_user['id_user'];?>">
              Edit
            </button>
          </div>
          <!-- Modal Edit -->
          <div class="modal fade" id="edit<?php echo $dt_user['id_user'];?>" tabindex="-1" aria-labelledby="editProfil" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="editProfil">Edit Profil</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="update_profil.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id_user" value="<?= $dt_user['id_user'] ?>">
                    <div class="mb-3">
                      <label for="nama" class="form-label">Nama</label>
                      <input type="text" name="nama" value="<?= $dt_user['nama'] ?>" class="form-control">
                    </div>
					<div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" value="<?= $dt_user['username'] ?>" class="form-control" required>
                  </div>
                    <div class="mb-3">
                    <label for="tel" class="form-label">No HP</label>
                    <input type="tel" class="form-control" value="<?= $dt_user['no_hp'] ?>" name="no_hp" placeholder="08xxxxxxxxxx" pattern="08[0-9]{10}" maxlength="15" required/>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="password">Password Baru</label>
                    <input type="password" name="password" class="form-control" required>
                  </div>
                    <div class="modal-footer">
                      <button type="submit" name="edit" class="btn btn-primary">Simpan</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
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