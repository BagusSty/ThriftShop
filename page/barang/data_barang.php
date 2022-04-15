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
 								<form method="post">
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
 											<label for="stok" class="form-label">Stok</label>
 											<input type="number" name="stok" class="form-control" disabled>
 										</div>
 										<div class="mb-3">
 											<label for="harga_pokok" class="form-label">Harga Pokok</label>
 											<input type="number" name="harga_pokok" class="form-control" disabled>
 										</div>
 										<div class="mb-3">
 											<label for="harga_jual" class="form-label">Harga Jual</label>
 											<input type="number" name="harga_jual" class="form-control" disabled>
 										</div>
 									</div>
 									<div class="modal-footer">
 										<button type="submit" value="Simpan" name="tambah" class="btn btn-primary">Simpan</button>
 									</div>
 								</form>
 								<?php if (isset($_POST['tambah'])) {
 									$nama = $_POST['nama'];
 									$kategori = $_POST['kategori'];
 									$stok = $_POST['stok'];
 									$hrg_pokok = $_POST['harga_pokok'];
 									$hrg_jual = $_POST['harga_jual'];
 									$qry = "INSERT INTO tb_barang(nama_barang,id_kategori,stok,harga_pokok,harga_jual) VALUES ('$nama','$kategori','$stok','$hrg_pokok','$hrg_jual' )";
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
 					$tb_barang = mysqli_query($conn,"SELECT * FROM tb_barang,tb_kategori");
 					$no = 1;
 					while ($barang = $tb_barang->fetch_assoc()) : ?>
 						<tbody>
 							<tr>
 								<td><?= $no++; ?></td>
 								<td><?= $barang['nama_barang']; ?></td>
 								<td><?= $barang['nama_kategori'] ?></td>
 								<td><?= $barang['stok'] ?></td>
 								<td><?= $barang['harga_pokok'] ?></td>
 								<td><?= $barang['harga_jual'] ?></td>
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
 													<form method="post">
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
 														<div class="modal-footer">
 															<button type="submit" value="Simpan" name="edit" class="btn btn-primary">Simpan</button>
 														</div>
 													</form>
 												</div>
 											</div>
 										</div>
 									</div>
 									<?php
 									if (isset($_POST['edit'])) {
 										$id = $_POST['id_barang'];
 										$nama = $_POST['nama_barang'];
 										$kategori = $_POST['nama_kategori'];
 										$qry = "UPDATE tb_barang SET nama_barang='$nama', id_kategori='$kategori' WHERE id_barang='$id'";
 										$input = mysqli_query($conn,$qry);
 										if ($input== true) {
 											echo '<script>alert("Data Tersimpan")</script>';
 										} else {
 											echo '<script>alert("Data Gagal Tersimpan")</script>';
 											die ("Gagal menginput data: ".mysqli_errno($conn)." - ".mysqli_error($conn));
 										}
 									}
 									?>
 									<button class="btn">
 										<a href="?id=<?php echo $barang['id_barang']?>" onclick="return confirm('anda yakin akan menghapus data?')"><i class="fas fa-trash"></i>Hapus</span></a>
 									</button>
 									<?php
 									if (isset($_GET['id'])) {
 										$id = $_GET['id'];
 										$query = "DELETE FROM tb_barang WHERE id_barang='$id' ";
 										$hasil = mysqli_query($conn, $query);
 										if(!$hasil){
 											die ("Gagal menghapus data: ".mysqli_errno($conn)." - ".mysqli_error($conn));
 										} else {
 											echo '<script>alert("Data Terhapus")</script>';
 										}
 									}
 									?>
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