<?php
include '../../config.php';
if (isset($_POST['submit'])) {
	$bulan = $_POST['bulan'];
	if ($bulan=='1') {
		$namabulan='Januari';
	} elseif ($bulan==2) {
		$namabulan='Februari';
	}  elseif ($bulan==3) {
		$namabulan='Maret';
	}  elseif ($bulan==4) {
		$namabulan='April';
	}  elseif ($bulan==5) {
		$namabulan='Mei';
	}  elseif ($bulan==6) {
		$namabulan='Juni';
	}  elseif ($bulan==7) {
		$namabulan='Juli';
	} elseif ($bulan==8) {
		$namabulan='Agustus';
	}  elseif ($bulan==9) {
		$namabulan='September';
	}  elseif ($bulan==10) {
		$namabulan='Oktober';
	}  elseif ($bulan==11) {
		$namabulan='November';
	}  elseif ($bulan==12) {
		$namabulan='Desember';
	} else {
		$namabulan='Bulan tidak ada';
	}
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Laporan_Data_Barang_Masuk-Bulan-$namabulan.xls");
	?>

	<h2>Laporan Data Barang Bulan <?= $namabulan ?></h2>
	<table border="1" class="table table-striped">
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
		$tb_barang = mysqli_query($conn,"SELECT * FROM tb_barang_masuk,tb_supplier,tb_barang WHERE tb_barang_masuk.id_barang=tb_barang.id_barang AND tb_barang_masuk.id_supplier = tb_supplier.id_supplier AND MONTH(tanggal)='$bulan'");
		$no = 1;
		while ($barang = $tb_barang->fetch_assoc()) : ?>
			<tbody>
				<tr>
					<td><?= $no++; ?></td>
					<td><?= $barang['nama_barang']; ?></td>
					<td><?= $barang['tanggal'] ?></td>
					<td><?= $barang['nama_supplier']; ?></td>
					<td><?= $barang['harga_pokok'] ?></td>
					<td><?= $barang['jumlah_barang'] ?></td>
					<td><?= $barang['jumlah_harga_pokok'] ?></td>
				</tr>
			</tbody>
		<?php endwhile; ?>
	<?php }?>
</table>