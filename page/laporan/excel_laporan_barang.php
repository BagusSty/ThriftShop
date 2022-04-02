<?php
include '../../config.php';
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Data_Barang.xls");
?>

<h2>Laporan Data Barang</h2>
<table border="1">
    <tr>
        <th>No</th>
        <th>Nama Barang</th>
        <th>Kategori</th>
        <th>Stok</th>
        <th>harga Pokok</th>
        <th>Harga Jual</th>
    </tr>
    <?php
    $tb_barang = mysqli_query($conn,"SELECT * FROM tb_barang,tb_kategori WHERE tb_barang.id_kategori = tb_kategori.id_kategori");
    $no = 1;
    while ($dt_barang = $tb_barang->fetch_assoc()) {
        $barang[] = $dt_barang;
    }
    foreach ($barang as $data) : ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $data['nama_barang']; ?></td>
            <td><?= $data['nama_kategori'] ?></td>
            <td><?= $data['stok'] ?></td>
            <td><?= $data['harga_pokok'] ?></td>
            <td><?= $data['harga_jual'] ?></td>
        </tr>
    </table>
<?php endforeach; ?>

