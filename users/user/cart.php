 <?php
 session_start();
 include '../../config.php';
 if(!isset ($_SESSION['nama'])){
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
 			<div class="col-md-10 pt-5">
 				<h2><i class="fas fa-shopping-cart"></i> Keranjang</h2>
 			</div>
 			<?php
 			if (isset($_POST['id'])) {

 				$id = $_POST['id'];

 				$brg = mysqli_query($conn, "SELECT * FROM tb_barang,tb_kategori WHERE tb_barang.id_kategori=tb_kategori.id_kategori AND id_barang = '$id'");
 				$dt_brg = $brg->fetch_assoc();

 				if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

 				$index = -1;
 				$cart = unserialize(serialize($_SESSION['cart']));

    // jika produk sudah ada dalam cart maka pembelian akan diupdate
 				for ($i=0; $i<count($cart); $i++) {
 					if ($cart[$i]['id_barang'] == $id) {
 						$index = $i;
 						break;
 					}
 				}

    // jika produk belum ada dalam cart
 				if ($index == -1) {
 					$_SESSION['cart'][] = [
 						'id_barang' => $id,
 						'nama_barang' => $dt_brg['nama_barang'],
 						'harga' => $dt_brg['harga_jual'],
 					];
 				}
 			}

 			if (!empty($_SESSION['cart'])) {
 				?>
 				<table class="table table-sm">
 					<thead>
 						<th>No</th>
 						<th>Nama Produk</th>
 						<th>Harga</th>
 						<th>Aksi</th>
 					</thead>

 					<?php
 					if(isset($_SESSION['cart'])) {
 						$cart = unserialize(serialize($_SESSION['cart']));
 						$index = 0;
 						$no = 1;
 						$total = 0;
 						$total_bayar = 0;
                //menghitung subtotal dan total
 						for ($i=0; $i<count($cart); $i++) {
 							$total = $_SESSION['cart'][$i]['harga'];
 							$total_bayar += $total;
 							?>
 							<tr>
 								<td><?php echo $no++; ?></td>
 								<td><?php echo $cart[$i]['nama_barang']; ?></td>
 								<td><?php echo "Rp. ".number_format($cart[$i]['harga'],2,',','.') ?></td>
 								<td>
 									<a href="?page=keranjang&index=<?php echo $index; ?>">
 										<button class="btn btn-primary"><i class="fas fa-trash"></i></button>
 									</a>
 								</td>
 							</tr>

 							<?php
 							$index++;
 						}
                // hapus produk dalam cart
 						if(isset($_GET['index'])) {
 							$cart = unserialize(serialize($_SESSION['cart']));
 							unset($cart[$_GET['index']]);
 							$cart = array_values($cart);
 							$_SESSION['cart'] = $cart;
 						}
 					}
 					?>
 					<tbody>
 						<td colspan="2" align="left"><strong>Total Bayar</strong></td>
 						<td><strong><?= "Rp. ".number_format( $total_bayar,2,',','.') ?></strong></td>
 						<?php
 						$nama = $_SESSION['nama'];
 						$user = mysqli_query($conn, "SELECT * FROM tb_user WHERE nama = '$nama'");
 						while ($dt_user = $user->fetch_assoc()) : ?>
 							<td>
 								<button type="button" class="btn my-3" data-bs-toggle="modal" data-bs-target="#addUser<?= $dt_user['id_user'] ?>"><i class="fal fa-cash-register"></i> Checkout</button>
 							</td>
 							<!-- Modal Checkout -->
 							<div class="modal fade" id="addUser<?= $dt_user['id_user'] ?>" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
 								<div class="modal-dialog">
 									<div class="modal-content">
 										<div class="modal-header">
 											<h5 class="modal-title" id="addModal">Pilih Pembayaran</h5>
 											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
 										</div>
 										<div class="modal-body">
 											<form action="transaksi.php" method="post">
												 <input type="hidden" name="id_user" value="<?= $dt_user['id_user'] ?>">
 												<div class="mb-3">
 													<label for="nama" class="form-label">Nama</label>
 													<input type="text" name="nama" value="<?= $dt_user['nama']?>" class="form-control" disabled>
 												</div>
 												<div class="mb-3">
 													<label for="tel" class="form-label">No HP</label>
 													<input type="tel" class="form-control" name="no_hp" value="<?= $dt_user['no_hp']?>" disabled/>
 												</div>
 												<div class="mb-3">
 													<label for="total" class="form-label">Total Bayar</label>
 													<input type="number" name="total" value="<?= $total_bayar?>" class="form-control" disabled>
 												</div>
 												<div class="mb-3">
 													<label for="alamat" class="form-label">Alamat</label>
 													<input type="text" name="alamat" class="form-control" required>
 												</div>
 												<div class="mb-3">
 													<label for="option" class="form-label">Pilih Pilih Pembayaran</label>
 													<select name="pembayaran" class="form-control" required>
 														<option value="">--Pilih Pembayaran--</option>
 														<option value="Mandiri">Mandiri</option>
 														<option value="BCA">BCA</option>
 														<option value="BRIs">BRI</option>
 													</select>
 												</div>
 												<div class="modal-footer">
 													<button type="submit" value="Simpan" name="simpan" class="btn btn-primary">Tambah</button>
 												</div>
 											</form>
 										</div>
 									</div>
 								</div>
 							</div>
 						<?php endwhile ?>
 					</tbody>
 				</table>
 			</div>
 			<hr>
 			<?php
 		}
 		?>
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