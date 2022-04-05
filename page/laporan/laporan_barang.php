
<div class="col-md-10 pt-5">
    <h2><i class='fas fa-box'></i>Laporan Data Barang</h2>
</div>
<br />
<table class="table table-striped">
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
    $tb_barang = mysqli_query($conn,"SELECT * FROM tb_barang,tb_kategori");
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
<a target="_blank" href="../../page/laporan/excel_laporan_barang.php"  class="btn btn-primary" ><i class="fa fa-print"></i>Export Excel</a>

