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

 			<div class="content">
 				<div class="col-md-10 pt-5">
 					<h2><i class='fas fa-box'></i>Laporan Data Barang</h2>
 				</div>
 				<br />
 				<table class="table table-striped">
 					<thead>
 						<tr>
 							<th>No</th>
 							<th>Nama Barang</th>
 							<th>Kategori</th>
 							<th>Stok</th>
 							<th>harga Pokok</th>
 							<th>Harga Jual</th>
 						</tr>
 					</thead>
 					<?php
 					$tb_barang = mysqli_query($conn,"SELECT * FROM tb_barang,tb_kategori WHERE tb_barang.id_kategori=tb_kategori.id_kategori");
 					$no = 1;
 					while ($barang = $tb_barang->fetch_assoc()) : ?>
 						<tbody>
 							<tr>
 								<td><?= $no++; ?></td>
 								<td><?= $barang['nama_barang']; ?></td>
 								<td><?= $barang['nama_kategori'] ?></td>
 								<td><?= $barang['stok'] ?></td>
 								<td><?= "Rp. ".number_format($barang['harga_pokok'],2,',','.') ?></td>
 								<td><?= "Rp. ".number_format($barang['harga_jual'],2,',','.') ?></td>
 							</tr>
 						</tbody>
 					<?php endwhile; ?>
 				</table>
 				<a target="_blank" href="../../page/laporan/excel_laporan_barang.php"  class="btn btn-primary" ><i class="fa fa-print"></i>Export Excel</a>
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


