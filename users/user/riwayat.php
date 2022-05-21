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
     <!--CSS Style -->
 	<style>
 		.navbar-nav .nav-link {
 			color: black;
 		}
 		@media (max-width: 768px) {
 			.card-body {
 				font-size: smaller;
 			}
 			img {
 				width: 75px;
 			}
 			.card-title {
 				font-size:medium;
 			}
 		}
    </style>
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

 		<!-- Page Content  -->
 		<div id="content">
 			<!-- Navbar -->
 			<nav class="navbar navbar-expand-lg">
 				<div class="container-fluid">
 					<a class="navbar-brand">Buganishogi</a>
 					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
 						<i class="fas fa-align-left"></i>
 					</button>
 					<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
 						<div class="navbar-nav">
 							<a class="nav-link active" aria-current="page" href="beranda_user.php">Dashboard</a>
 							<a class="nav-link" href="katalog.php">Katalog</a>
 							<a href="riwayat.php" class="nav-link">Riwayat Pembelian</a>
 							<a class="nav-link" href="cart1.php">Keranjang</a>
 						</div>
 						<div class="navbar-nav dropdown ms-auto">
 							<a class="nav-link ms-auto dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
 								<i class="fa fa-fw fa-user"></i><span><?php echo $_SESSION['nama']; ?></span>
 							</a>
 							<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
 								<li><a class="nav-link d-flex" href="#">Akun Anda</a></a></li>
 								<li><a onclick="return confirm('Anda yakin ingin logout ?')" href="../../logout.php" class="nav-link">Log Out</a></li>
 							</div>
 						</div>
 					</div>
 				</nav>

 				<div class="content">
 					<div class="col-md-10 pt-5">
 						<h2><i class="fas fa-columns"></i> Invoice</h2>
 					</div>
 					<table class="table table-striped">
 						<thead>
 							<tr>
 								<th>Kode Transaksi</th>
 								<th>Pembayaran</th>
 								<th>Total Barang</th>
 								<th>Total Pembayaran</th>
 								<th>Waktu Pesan</th>
 								<th>Batas Pembayaran</th>
 								<th>Status Pembayaran</th>
 							</tr>
 						</thead>
 						<?php
 						$nama = $_SESSION['nama'];
 						$tb_transaksi = mysqli_query($conn,"SELECT * FROM tb_user,tb_transaksi WHERE tb_user.id_user=tb_transaksi.id_user AND tb_user.nama='$nama'");
 						while ($data = $tb_transaksi->fetch_assoc()) : ?>
 							<tbody>
 								<tr>
 									<td><?= $data['kode']; ?></td>
 									<td><?= $data['pembayaran']; ?></td>
 									<td><?= $data['total_barang']; ?></td>
 									<td><?=  "Rp. ".number_format($data['total_bayar'],2,',','.') ?></td>
 									<td><?= $data['waktu_pesan']; ?></td>
 									<td><?= $data['batas_bayar']; ?></td>
 									<td><?= $data['status']; ?></td>

 								</div>
 							</div>
 						</div>
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