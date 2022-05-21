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
 					<div class="mt-5">
 						<div class="col-md-10 pt-2">
 							<h2><i class='fas fa-tshirt'></i> Katalog</h2>
 						</div>
 						<div class="m-2">
 							<form id="kategori" method="get">
 								<div class="mb-3">
 									<select name="id_kategori" id="id_kategori" class="form-control" style="width:25%;">
 										<option value="">--Pilih Kategori--</option>
                                        <option name="semua" value="semua">Semua</option>
 										<?php
 										$sql=mysqli_query($conn, "SELECT * FROM tb_kategori order by id_kategori");
 										while ($data=mysqli_fetch_array($sql)) {
 											?>
 											<option name="id" value="<?=$data['id_kategori']?>"><?=$data['nama_kategori']?></option>
 											<?php
 										}
 										?>
 									</select>
 								</div>
 								<button type="submit" name="submit_kategori" class="btn btn-primary">Submit</button>
 							</form>
 						</div>
 						<div class="row">
 							<?php
                            $id = @$_GET['id_kategori'];
                            $all = @$_GET['id_kategori'] == 'semua';
 							if (isset($_GET['submit_kategori']) && $id != 'semua') {
 								$tb_brg = mysqli_query($conn,"SELECT * FROM tb_barang,tb_kategori WHERE tb_barang.id_kategori=tb_kategori.id_kategori AND tb_kategori.id_kategori='$id'");
 							}  else if($all) {
 								$tb_brg = mysqli_query($conn,"SELECT * FROM tb_barang,tb_kategori WHERE tb_barang.id_kategori=tb_kategori.id_kategori");
 							} else {
                                 $tb_brg = mysqli_query($conn,"SELECT * FROM tb_barang,tb_kategori WHERE tb_barang.id_kategori=tb_kategori.id_kategori");
                             }
 							$no = 1;
 							while ($dt_brg = $tb_brg->fetch_assoc()) : ?>
 								<div class="card col-sm-3 mx-2">
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

 </html>