<div class="col-md-10 pt-5">
	<h2><i class='fas fa-box'></i> Data Barang</h2>
</div>
<table class="table table-striped">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Barang</th>
			<th>Kategori</th>
			<th>Stok</th>
			<th>harga Jual</th>
			<th>Jumlah</th>
			<th>Opsi</th>
		</tr>
	</thead>
	 <?php
    $tb_barang = mysqli_query($conn,"SELECT * FROM tb_barang,tb_kategori");
    $no = 1;
    while ($barang = $tb_barang->fetch_assoc()) : ?>
        <tbody>
			<form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $barang['nama_barang']; ?></td>
                <td><?= $barang['nama_kategori'] ?></td>
                <td><?= $barang['stok'] ?></td>
                <td><?= $barang['harga_jual'] ?></td>
				<td width="106">
					<input type="hidden" name="id_barang" value="<?= $barang['id_barang']; ?>">
					<input class="form-control form-control-sm" type="number" name="pembelian" value="1" min="1" max="<?= $barang['stok']; ?>">
				</td>
				<td>
					<input type="submit" class="btn btn-primary" name="submit">
				</td>
            </tr>
			</form>
        </tbody>
    <?php endwhile; ?>
	</table>
<?php require_once 'cart.php'; ?>
