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
 		if(!isset($_SESSION['tiper_user'])=="1" ){
 			include_once('../../users/admin/sidebar_admin.php');
 		} elseif (!isset($_SESSION['tiper_user'])=="2" ) {
 			include_once('../../users/manager/sidebar_manager.php');
 		}
 		?>
 		<!-- Page Content  -->
 		<div id="content">
 			<?php
 			if(!isset($_SESSION['tiper_user'])=="1" ){
 				include_once('../../users/admin/navbar_admin.php');
 			} elseif (!isset($_SESSION['tiper_user'])=="2" ) {
 				include_once('../../users/manager/navbar_manager.php');
 			}
 			?>

 			<div class="col-md-10 pt-5">
 				<h2><i class='fas fa-truck'></i> Data Supplier</h2>
 			</div>

 			<!-- Modal Input -->
 			<button type="button" class="btn my-3" data-bs-toggle="modal" data-bs-target="#addUser"><i class='fas fa-truck'></i> Tambah Supplier</button>
 			<div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
 				<div class="modal-dialog">
 					<div class="modal-content">
 						<div class="modal-header">
 							<h5 class="modal-title" id="addModal">Input Supplier Baru</h5>
 							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
 						</div>
 						<div class="modal-body">
 							<form method="post">
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
 							<?php
 							if (isset($_POST['simpan'])) {
 								$nama = $_POST['nama'];
 								$nohp = $_POST['no_hp'];
 								$alamat = $_POST['alamat'];
 								$qry = "INSERT INTO tb_supplier(nama_supplier,no_hp_supplier,alamat_supplier) VALUES ('$nama','$nohp','$alamat')";
 								$input = mysqli_query($conn,$qry);
 								if ($input== true) {
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
 			<table class="table table-sm">
 				<thead>
 					<tr>
 						<th>No</th>
 						<th>Nama Supplier</th>
 						<th>No HP</th>
 						<th>Alamat</th>
 						<th>Opsi</th>
 					</tr>
 				</thead>

 				<?php
 				$tb_supplier = mysqli_query($conn,"SELECT * FROM tb_supplier");
 				$no = 1;
 				while ($dt_supplier = $tb_supplier->fetch_assoc()) {
 					$supplier[] = $dt_supplier;
 				}
 				foreach ($supplier as $supp) : ?>
 					<tbody>
 						<tr>
 							<td><?= $no++; ?></td>
 							<td><?= $supp['nama_supplier']; ?></td>
 							<td><?= $supp['no_hp_supplier'] ?></td>
 							<td><?= $supp['alamat_supplier']; ?></td>
 							<td>
 								<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editUser<?php echo $supp['id_supplier'];?>">
 									<i class="fas fa-edit"></i> Edit
 								</button>
 								<!-- Modal Edit -->
 								<div class="modal fade" id="editUser<?php echo $supp['id_supplier'];?>" tabindex="-1" aria-labelledby="editUserLabel" aria-hidden="true">
 									<div class="modal-dialog">
 										<div class="modal-content">
 											<div class="modal-header">
 												<h5 class="modal-title" id="editUserLabel">Edit Supplier</h5>
 												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
 											</div>
 											<div class="modal-body">
 												<form method="post">
 													<input type="hidden" name="id_supplier" value="<?= $supp['id_supplier'];?>">
 													<div class="mb-3">
 														<label for="nama" class="form-label">Nama</label>
 														<input type="text" id="nama" value="<?= $supp['nama_supplier'];?>" name="nama" class="form-control" required>
 													</div>
 													<div class="mb-3">
 														<label for="tel" class="form-label">No HP</label>
 														<input type="tel" id="no_hp" value="<?= $supp['no_hp_supplier'];?>" class="form-control" name="no_hp" placeholder="08xxxxxxxxxx" pattern="08[0-9]{10}" maxlength="15" required/>
 													</div>
 													<div class="mb-3">
 														<label for="alamat" class="form-label">Alamat</label>
 														<input type="text" id="alamat" value="<?= $supp['alamat_supplier'];?>" name="alamat" class="form-control" required>
 													</div>
 													<div class="modal-footer">
 														<button type="submit" value="update" name="update" class="btn btn-primary">Update</button>
 													</div>
 												</form>
 												<?php
 												if (isset($_POST['update'])) {
 													$id = $_POST['id_supplier'];
 													$nama = $_POST['nama'];
 													$nohp = $_POST['no_hp'];
 													$alamat = $_POST['alamat'];
 													$qry = "UPDATE tb_supplier SET nama_supplier='$nama', no_hp_supplier='$nohp',  alamat_supplier='$alamat' WHERE id_supplier='$id'";
 													$input = mysqli_query($conn,$qry);
 													if ($input== true) {
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
 								<button class="btn">
 									<a href="?id=<?php echo $supp['id_supplier']?>" onclick="return confirm('anda yakin akan menghapus data?')"><i class="fas fa-trash"></i>Hapus</span></a>
 								</button>
 								<?php
 								if (isset($_GET['id'])) {
 									$id = $_GET['id'];
 									$query = "DELETE FROM tb_supplier WHERE id_supplier='$id' ";
 									$hasil = mysqli_query($conn, $query);
 									if(!$hasil){
 										die ("Gagal menghapus data: ".mysqli_errno($conn)." - ".mysqli_error($conn));
 									}
 								}
 								?>
 							</td>
 						</tr>
 					</tbody>
 				<?php endforeach; ?>
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