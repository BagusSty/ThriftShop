<?php
include '../../config.php';
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Data_Barang_Masuk.xls");
?>

<h2>Laporan Data Barang</h2>
<table border="1" class="table table-striped">
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
	$tb_barang = mysqli_query($conn,"SELECT * FROM tb_barang_masuk,tb_supplier,tb_barang WHERE tb_barang_masuk.id_barang=tb_barang.id_barang AND tb_barang_masuk.id_supplier = tb_supplier.id_supplier");
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
</table>

