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
 	<!--Bootstrap-->
 	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">    <!--CSS-->
 	<link rel="stylesheet" href="../../css/landing.css">

 	<!-- Font Awesome JS -->
 	<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
 	<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
 </head>

 <body>
 	<div class="wrapper">
 		<!-- Navbar -->
 		<nav class="navbar navbar-expand-lg">
 			<div class="container-fluid">
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
 			<div class="container-fluid header">
 				<h1 class="text-uppercase text-center">
 					Buganishogi
 				</h1>
 				<p class="text-center">Thrift Shop Terpercaya</p>
 			</div>
 		</div>
 		<div class="katalog">
 			<a href="katalog.php" class="text-center"><h2 class="hr-lines">Katalog</h2></a>
 			<div class="row">
 				<?php
 				$tb_brg = mysqli_query($conn,"SELECT * FROM tb_barang,tb_kategori LIMIT 3");
 				while ($dt_brg = $tb_brg->fetch_assoc()) : ?>
 					<div class="card col-sm-3 mx-3">
 						<form method="post" action="cart1.php">
 							<input type="hidden" name="id_produk" value="<?= $dt_brg['id_barang']; ?>"></input>
 							<div class="text-center"><img class="card-img-center"
 								src="../../assets/file/<?= $dt_brg['gambar']?>"
 								class="card-img-top" alt="..."
 								width="150px">
 								<div class="card-body">
 									<h3 class="card-title"><?= $dt_brg['nama_barang'] ?></h3>
 									<span class="card-text">Kategori : <?= $dt_brg['nama_kategori'] ?></span>
 									<div class="">
 										<article><?= "Rp. ".number_format($dt_brg['harga_jual'],2,',','.') ?></article>
 									</div>
 								</div>
 							</div>

 							<div class="card-footer">
 								<div class="input-group mb-3">
 									<input type="number" class="form-control" name="pembelian" value="1" min="1" max="<?= $dt_brg['stok']; ?>">
 									<br>
 									<div class="input-group-append">
 										<button type="submit" name="submit" class="btn btn-sm" id="addToCart-1">
 											<i class="fas fa-shopping-cart"></i>Add To Cart
 										</button>
 									</div>
 								</div>
 							</div>

 						</form>
 					</div>
 				<?php endwhile; ?>
 			</div>
 		</div>
 		<div class="Map mb-3">
 			<div class="text-center"><h2 class="hr-lines">Alamat Kami</h2></div>
 			<div class="card shadow m-5 p-2">
 				<div class="location">
 					<div class="location-info">
 						<div class="address">
 							<ul style="list-style: none;">
 								<li class="address-title"><h6>Alamat</h6></li>
 								<li>Jl.Durian No.37,Kec.Taman, Kota Madiun</li>
 							</ul>
 						</div>
 					</div>
 					<hr class="clearfix w-100 d-md-none">
 					<div class="location-map">
 						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d247.15311420862258!2d111.5261210782397!3d-7.634677461979133!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e79be8b2adbb4c5%3A0x76e6e22c66e1ef1e!2sJl.%20Durian%20No.37%2C%20Kejuron%2C%20Kec.%20Taman%2C%20Kota%20Madiun%2C%20Jawa%20Timur%2063132!5e0!3m2!1sen!2sid!4v1653183743280!5m2!1sen!2sid" width="600" height="350" style="border:0;"></iframe>
 					</div>
 				</div>
 			</div>
 		</div>
 		<!-- Footer -->
 		<footer class="footer text-center">
 			<div class="container">
 				<div class="row">
 					<!-- Footer Location-->
 					<div class="col-lg-4 mb-5 mb-lg-0">
 						<h4 class="my-4">Location</h4>
 						<p class="lead mb-0">
 							Jl.Durian No.37,Kec.Taman, Kota Madiun
 						</p>
 					</div>
 					<!-- Footer Social Media-->
 					<div class="col-lg-4 mb-5 mb-lg-0">
 						<h4 class="my-4">Hubungi Kami</h4>
 						<a class="btn btn-outline-light" href="#!"><object data="../../assets/logo/whatsapp-brands.svg" width="25" height="25"></object></a>
 						<a class="btn btn-outline-light" href="#!"><object data="../../assets/logo/instagram-brands.svg" width="25" height="25"></object></a>
						 <a class="btn btn-outline-light" href="#!"><object data="../../assets/logo/phone-solid.svg" width="25" height="25"></object></a>
 					</div>
 					<div class="col-lg-4">
 						<h4 class="my-4">Buganishogi Thrift Shop</h4>
 					</div>
					<hr class="mt-4" width="100%">
					<span class="mb-3">Copyright © 2022</span>
 				</div>
 			</div>
 		</footer>
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

 </html>