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
 		<?php include_once('sidebar_user.php'); ?>
 		<!-- Page Content  -->
 		<div id="content">
 			<?php include_once('../../assets/navbar/navbar.php'); ?>

 			<div class="content">
 				<div class="mt-5">
 					<!--PHP Tanggal-->
 					<?php
 					$tanggal = mktime(date('m'), date("d"), date('Y'));
 					date_default_timezone_set("Asia/Jakarta");
 					$hari = date ("D");
 					switch($hari){
 						case 'Sun':
 						$hari_ini = "Minggu";
 						break;

 						case 'Mon':
 						$hari_ini = "Senin";
 						break;

 						case 'Tue':
 						$hari_ini = "Selasa";
 						break;

 						case 'Wed':
 						$hari_ini = "Rabu";
 						break;

 						case 'Thu':
 						$hari_ini = "Kamis";
 						break;

 						case 'Fri':
 						$hari_ini = "Jumat";
 						break;

 						case 'Sat':
 						$hari_ini = "Sabtu";
 						break;

 						default:
 						$hari_ini = "Tidak di ketahui";
 						break;
 					}
 					$jam = date ("H:i:s");
 					$a = date ("H");
 					if (($a>=6) && ($a<=11)) {
 						echo " <h4>Selamat Pagi, ". $_SESSION['nama']."</h4>";
 						echo "<h4>".$hari_ini.",".date("d-m-Y", $tanggal )."</h4>";
 					}else if(($a>=11) && ($a<=15)){
 						echo " <h4>Selamat Siang, ". $_SESSION['nama']."</h4>";
 						echo "<h4>".$hari_ini.",".date("d-m-Y", $tanggal )."</h4>";
 					}elseif(($a>15) && ($a<=18)){
 						echo " <h4>Selamat Sore, ". $_SESSION['nama']."</h4>";
 						echo "<h4>".$hari_ini.",".date("d-m-Y", $tanggal )."</h4>";
 					}else{
 						echo " <h4>Selamat Malam, ". $_SESSION['nama']."</h4>";
 						echo "<h4>".$hari_ini.", ".date("d-m-Y", $tanggal )."</h4>";
 					}
 					?>
 					<hr>
 					<?php if (isset($_SESSION['pesan'])) {
 						echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
 						' . $_SESSION['pesan'] . '
 						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
 						<span aria-hidden="true">×</span>
 						</button>
 						</div>';

 						unset($_SESSION['pesan']);
 					}?>
 					<div class="row">
 						<?php
 						$tb_brg = mysqli_query($conn,"SELECT * FROM tb_barang,tb_kategori WHERE tb_barang.id_kategori=tb_kategori.id_kategori");
 						$no = 1;
 						while ($dt_brg = $tb_brg->fetch_assoc()) : ?>
 							<div class="col-sm-3 p-2">
 								<form method="post" action="cart1.php">
 									<input type="hidden" name="id_produk" value="<?= $dt_brg['id_barang']; ?>"></input>
 									<div class="card">
 										<div class="text-center"><img class="card-img-center"
 											src="../../assets/file/<?= $dt_brg['gambar']?>"
 											class="card-img-top" alt="..."
 											width="150px">
 											<div class="card-body">
 												<h3 class="card-title"><a href="" class="text-dark "><?= $dt_brg['nama_barang'] ?></a></h3>
 												<span class="card-text">Kategori : <?= $dt_brg['nama_kategori'] ?></span>
 												<div class="mb-2">
 													<article><?= "Rp. ".number_format($dt_brg['harga_jual'],2,',','.') ?></article>
 												</div>
 											</div>
 										</div>

 										<div class="card-footer">
 											<div class="input-group mb-3">
 												<input type="number" class="form-control" name="pembelian" value="1" min="1" max="<?= $dt_brg['stok']; ?>">
 												<div class="input-group-append">
 													<button type="submit" name="submit" class="btn btn-sm" id="addToCart-1">
 													<i class="fas fa-shopping-cart"></i>Add To Cart
 												</button>
 												</div>
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