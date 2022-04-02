
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
    $tb_barang = mysqli_query($conn,"SELECT * FROM tb_barang,tb_kategori WHERE tb_barang.id_kategori = tb_kategori.id_kategori");
    $no = 1;
    while ($dt_barang = $tb_barang->fetch_assoc()) {
        $barang[] = $dt_barang;
    }
    foreach ($barang as $data) : ?>
        <tbody>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $data['nama_barang']; ?></td>
                <td><?= $data['nama_kategori'] ?></td>
                <td><?= $data['stok'] ?></td>
                <td><?= $data['harga_pokok'] ?></td>
                <td><?= $data['harga_jual'] ?></td>
            </tr>
        </tbody>
    </table>
<?php endforeach; ?>
<a target="_blank" href="../../page/laporan/excel_laporan_barang.php"  class="btn btn-primary" ><i class="fa fa-print"></i>Export Excel</a>

