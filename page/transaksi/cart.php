<?php
if (isset($_POST['id_barang'], $_POST['pembelian'])) {

	$id = $_POST['id_barang'];
	$pembelian = $_POST['pembelian'];

	$brg = mysqli_query($conn, "SELECT * FROM tb_barang,tb_kategori WHERE stok>3");
	$dt_brg = $brg->fetch_assoc();

	if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

	$index = -1;
	$cart = unserialize(serialize($_SESSION['cart']));

    // jika produk sudah ada dalam cart maka pembelian akan diupdate
	for ($i=0; $i<count($cart); $i++) {
		if ($cart[$i]['id_barang'] == $id) {
			$index = $i;
			$_SESSION['cart'][$i]['pembelian'] = $pembelian;
			break;
		}
	}

    // jika produk belum ada dalam cart
	if ($index == -1) {
		$_SESSION['cart'][] = [
			'id_barang' => $id,
			'nama_barang' => $dt_brg['nama_barang'],
			'harga' => $dt_brg['harga_jual'],
			'pembelian' => $pembelian
		];
	}
}

if (!empty($_SESSION['cart'])) {
	?>
	<table class="table table-striped">
		<thead>
			<th>No</th>
			<th>Nama Produk</th>
			<th>Pembelian</th>
			<th>Harga</th>
			<th>Total</th>
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
				$total = $_SESSION['cart'][$i]['harga'] * $_SESSION['cart'][$i]['pembelian'];
				$total_bayar += $total;
				?>
				<tr>
					<td align="center"><?php echo $no++; ?></td>
					<td><?php echo $cart[$i]['nama_barang']; ?></td>
					<td align="center"><?php echo $cart[$i]['pembelian']; ?></td>
					<td><?php echo $cart[$i]['harga']; ?></td>
					<td><?php echo $total; ?></td>
					<td align="center">
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
			<td colspan="4" align="left"><strong>Total Bayar</strong></td>
			<td><strong><?= $total_bayar; ?></strong></td>
			<td align="center">
				<a href="#" name="checkout">
					<button class="btn">Checkout</button>
				</a>
			</td>
		</tbody>
	</table>
</div>
<hr>
<?php
}
?>