<div class="col-md-10 pt-5">
	<h2><i class='fas fa-dollar-sign'></i> Data Transaksi</h2>
</div>

<button type="button" class="btn my-3"><a href="?page=keranjang"><i class='fas fa-dollar-sign'></i> Tambah Transaksi</a></button>
<table class="table table-striped">
	<thead>
		<tr>
			<th>NO</th>
			<th>No Transaksi</th>
			<th>Nama Barang</th>
			<th>Jumlah</th>
			<th>Total Barang</th>
			<th>Total Harga</th>
			<th>Waktu</th>
		</tr>
	</thead>
	<?php
	$tb_transaksi = mysqli_query($conn,"SELECT * FROM tb_transaksi,tb_transaksi_detail,tb_barang WHERE tb_barang.id_barang=tb_transaksi_detail.id_barang AND tb_transaksi.no_transaksi=tb_transaksi_detail.no_transaksi");
	$no = 1;
	while ($dt_transaksi = $tb_transaksi->fetch_assoc()) {
		$data[] = $dt_transaksi;
	}
	foreach ($data as $transaksi) : ?>
		<tbody>
			<tr>
				<td><?= $no++; ?></td>
				<td><?= $transaksi['no_transaksi']; ?></td>
				<td><?= $transaksi['nama_barang'] ?></td>
				<td><?= $transaksi['total_barang']; ?></td>
				<td><?= $transaksi['banyak'] ?></td>
				<td><?= $transaksi['total_harga'] ?></td>
				<td><?= $transaksi['waktu'] ?></td>
			</tr>
		</tbody>
	<?php endforeach; ?>
</table>