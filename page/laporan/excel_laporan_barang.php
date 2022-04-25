<?php
include '../../config.php';
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Data_Barang-(".date('d-m-Y').").xls");
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
	$tb_barang = mysqli_query($conn,"SELECT * FROM tb_barang,tb_kategori WHERE tb_barang.id_kategori=tb_kategori.id_kategori");
	$no = 1;
	while ($barang = $tb_barang->fetch_assoc()) : ?>
		<tbody>
			<tr>
				<td><?= $no++; ?></td>
				<td><?= $barang['nama_barang']; ?></td>
				<td><?= $barang['nama_kategori'] ?></td>
				<td><?= $barang['stok'] ?></td>
				<td><?= $barang['harga_pokok'] ?></td>
				<td><?= $barang['harga_jual'] ?></td>
			</tr>
		</tbody>
	<?php endwhile; ?>
</table>

