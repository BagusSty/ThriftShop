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
 				<h2><i class='fas fa-box'></i> Data Barang Masuk</h2>
 			</div>

 			<!-- Modal Input -->
 			<button type="button" class="btn my-3" data-bs-toggle="modal" data-bs-target="#addUser"><i class="fa fa-box"></i> Tambah Barang</button>
 			<div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
 				<div class="modal-dialog">
 					<div class="modal-content">
 						<div class="modal-header">
 							<h5 class="modal-title" id="addModal">Input Barang Masuk</h5>
 							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
 						</div>
 						<div class="modal-body">
 							<form class="form-group" name="autoSumForm" method="post">
 								<div class="mb-3">
 									<label for="id" class="form-label">Nama Barang</label>
 									<select name="id_barang" id="id_barang" class="form-control">
 										<option value="">--Pilih Barang--</option>
 										<?php
 										$sql=mysqli_query($conn, "SELECT * FROM tb_barang order by id_barang");
 										while ($data=mysqli_fetch_array($sql)) {
 											?>
 											<option name="id" value="<?=$data['id_barang']?>"><?=$data['id_barang']." | ".$data['nama_barang']?></option>
 											<?php
 										}
 										?>
 									</select>
 								</div>
 								<div class="mb-3">
 									<label for="tgl" class="form-label">Tanggal</label>
 									<input type="date" name="tgl" class="form-control">
 								</div>
 								<div class="mb-3">
 									<label for="supp" class="form-label">Supplier</label>
 									<select name="supplier" id="supplier" class="form-control">
 										<option value="">--Pilih Supplier--</option>
 										<?php
 										$sql=mysqli_query($conn, "SELECT * FROM tb_supplier");
 										while ($data=mysqli_fetch_array($sql)) {
 											?>
 											<option name="id" value="<?=$data['id_supplier']?>">"<?=$data['nama_supplier']?>"</option>
 											<?php
 										}
 										?>
 									</select>
 								</div>
 								<div class="mb-3">
 									<label for="harga" class="form-label">Harga Pokok</label>
 									<input type="number" id="harga" name="harga" onFocus="startCalc();" class="form-control">
 								</div>
 								<div class="mb-3">
 									<label class="form-label" for="jumlah_brg">Jumlah barang</label>
 									<input type="number" name="jumlah_brg" onFocus="startCalc();" onBlur="stopCalc();" class="form-control">
 								</div>
 								<div class="mb-3">
 									<label for="jumlah_hrg" class="form-label">Jumlah Total Harga</label>
 									<input type="text" name="jumlah_hrg" class="form-control" onchange="tryNumberFormat(this.form.thirdBox);" disabled>
 								</div>
 								<div class="modal-footer">
 									<button type="submit" value="Simpan" name="tambah" class="btn btn-primary">Simpan</button>
 								</div>
 							</form>
 							<?php
 							include '../../config.php';
 							if (isset($_POST['tambah'])) {
 								$id = $_POST['id_barang'];
 								$supplier = $_POST['supplier'];
 								$tgl = $_POST['tgl'];
 								$harga = $_POST['harga'];
 								$jml_brg = $_POST['jumlah_brg'];
 								$jml_hrg = $harga*$jml_brg;

									//menghitung harga jual
 								$hrg_jual = ($harga*10/100)+$harga;
									//meupdate stok dan harga barang
 								$sql=mysqli_query($conn, "SELECT * FROM tb_barang where id='$id'");
 								$data=mysqli_fetch_array($sql);
 								$stok = $data['stok'];
 								$tmbh_stok = $stok+$jml_brg;
 								$qry = "INSERT INTO tb_barang_masuk(id_barang,tanggal,id_supplier,jumlah_barang,jumlah_harga_pokok) VALUES ('$id','$tgl','$supplier','$jml_brg','$jml_hrg')";
 								$input = mysqli_query($conn,$qry);
 								if ($input == true) {
 									$upd = "UPDATE tb_barang SET stok='$tmbh_stok',harga_pokok='$harga', harga_jual='$hrg_jual' WHERE id_barang='$id'";
 									$update = mysqli_query($conn,$upd);
 								} else {
 									echo '<script>alert("Data Gagal Tersimpan")</script>';
 									var_dump($qry);
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
 						<th>NO</th>
 						<th>Nama Barang</th>
 						<th>Tanggal</th>
 						<th>Nama Supplier</th>
 						<th>Harga Pokok</th>
 						<th>Jumlah</th>
 						<th>Total Harga</th>
 					</tr>
 				</thead>

 				<?php
 				$tb_barang = mysqli_query($conn,"SELECT * FROM tb_barang_masuk,tb_supplier,tb_barang WHERE tb_barang_masuk.id_barang=tb_barang.id_barang AND tb_barang_masuk.id_supplier = tb_supplier.id_supplier");
 				$no = 1;
 				while ($barang = $tb_barang->fetch_assoc()):?>
 					<tbody>
 						<tr>
 							<td><?= $no++; ?></td>
 							<td><?= $barang['nama_barang']; ?></td>
 							<td><?= $barang['tanggal'] ?></td>
 							<td><?= $barang['nama_supplier']; ?></td>
 							<td><?= "Rp. ".number_format($barang['harga_pokok'],2,',','.') ?></td>
 							<td><?= $barang['jumlah_barang'] ?></td>
 							<td><?= "Rp. ".number_format($barang['jumlah_harga_pokok'],2,',','.') ?></td>
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
 <script>
 	function startCalc(){
 		interval = setInterval("calc()",1);}
 		function calc(){
 			y = document.autoSumForm.harga.value;
 			z = document.autoSumForm.jumlah_brg.value;

 			document.autoSumForm.jumlah_hrg.value = ( y * z );}
 			function stopCalc(){
 				clearInterval(interval);}
 			</script>

 		</body>
 		</html>