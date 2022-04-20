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
 			<?php include_once('../../assets/navbar/navbar.php'); ?>

 			<div class="col-md-10 pt-5">
 				<h2><i class='fas fa-box'></i> Data Barang Masuk</h2>
 			</div>
 			<div class="xs-mb-3">
 				<div class="col-md-3">
 					<select name='laporan' class="form-control form-control-sm" onchange="if (this.selectedIndex==2 || this.selectedIndex==3){
 						document.getElementById('tanggal').style.display = 'none';
 						document.getElementById('bulan').style.display = 'inline';
 					}else {
 						document.getElementById('tanggal').style.display = 'inline';
 						document.getElementById('bulan').style.display = 'none';
 					};">
 					<option value="">--Pilih Laporan--</option>
 					<option value="Tanggal">Tanggal</option>
 					<option value="Bulan">Bulan</option>
 				</select>
 			</div>
 			<div class="m-2">
 				<form style="display: none;" id="tanggal" method="get">
 					<label for="date1">Tampilkan transaksi tanggal </label>
 					<div class="col-md-3">
 						<input type="date" class="form-control form-control-sm" name="tanggal" class="input-tanggal" />
 					</div>
 					<button type="submit" name="submit_tanggal" class="btn btn-primary">Tampilkan</button>
 				</form>
 			</div>
 			<div class="m-2">
 				<form style="display: none;" id="bulan" method="get">
 					<label for="date1">Tampilkan transaksi bulan </label>
 					<div class="col-md-3">
 						<select class="form-control form-control-sm" name="bulan" class="input-bulan">
 							<option value="">-</option>
 							<option value="1">Januari</option>
 							<option value="2">Februari</option>
 							<option value="3">Maret</option>
 							<option value="4">April</option>
 							<option value="5">Mei</option>
 							<option value="6">Juni</option>
 							<option value="7">Juli</option>
 							<option value="8">Agustus</option>
 							<option value="9">September</option>
 							<option value="10">Oktober</option>
 							<option value="11">November</option>
 							<option value="12">Desember</option>
 						</select>
 					</div>
 					<button type="submit" name="submit_bulan" class="btn btn-primary">Tampilkan</button>
 				</form>
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
 			if (isset($_GET['submit_tanggal'])) {
 				$tanggal = $_GET['tanggal'];
 				$tb_barang = mysqli_query($conn,"SELECT * FROM tb_barang_masuk,tb_supplier,tb_barang WHERE tb_barang_masuk.id_barang=tb_barang.id_barang AND tb_barang_masuk.id_supplier = tb_supplier.id_supplier AND tanggal='$tanggal'");
 			} elseif (isset($_GET['submit_bulan'])) {
 				$bulan = $_GET['bulan'];
 				$tb_barang = mysqli_query($conn,"SELECT * FROM tb_barang_masuk,tb_supplier,tb_barang WHERE tb_barang_masuk.id_barang=tb_barang.id_barang AND tb_barang_masuk.id_supplier = tb_supplier.id_supplier AND MONTH(tanggal)='$bulan'");
 			} else {
 				$tb_barang = mysqli_query($conn,"SELECT * FROM tb_barang_masuk,tb_supplier,tb_barang WHERE tb_barang_masuk.id_barang=tb_barang.id_barang AND tb_barang_masuk.id_supplier = tb_supplier.id_supplier");
 			}
 			$no = 1;
 			while ($barang = $tb_barang->fetch_assoc()) :
 				?>
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
 		<?php
 		if (@$tanggal) {
 			echo '<form action="excel_barang_masuk_harian.php" id="export_tgl" method="post">
 			<input type="hidden" value="'.$tanggal.'" name="tanggal" class="input-tanggal"/>
 			<button type="submit" name=submit class="btn btn-primary"><i class="fa fa-print"></i>Export Excel</button>
 			</form>';
 		} elseif (@$bulan) {
 			echo '<form action="excel_barang_masuk_bulanan.php" id="export_tgl" method="post">
 			<input type="hidden" value="'.$bulan.'" name="bulan" class="input-bulan" />
 			<button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-print"></i>Export Excel</button>
 			</form>';
 		} else {
 			echo '<a target="_blank" href="../../page/laporan/excel_laporan_data_barang_masuk.php"  class="btn btn-primary" ><i class="fa fa-print"></i>Export Excel</a>';
 		}
 		?>
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