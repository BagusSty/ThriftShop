<?php
include '../../config.php';
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Data_Penjualan.xls");
?>

<h2>Laporan Data Penjualan</h2>
<table border="1" class="table table-striped">
  <thead>
    <tr>
      <th>No</th>
      <th>Kode Transaksi</th>
      <th>Nama Pembeli</th>
      <th>No HP</th>
      <th>Alamat</th>
      <th>Pembayaran</th>
      <th>Total Barang</th>
      <th>Total Bayar</th>
      <th>Waktu Pembayaran</th>
    </tr>
  </thead>
  <?php
  $tb_jual = mysqli_query($conn,"SELECT * FROM tb_transaksi,tb_user WHERE tb_user.id_user=tb_transaksi.id_user AND status='Sudah Dibayar'");
  $no = 1;
  while ($dt_jual = $tb_jual->fetch_assoc()) : ?>
    <tbody>
      <tr>
        <td><?= $no++; ?></td>
        <td><?= $dt_jual['kode']; ?></td>
        <td><?= $dt_jual['nama'] ?></td>
        <td><?= $dt_jual['no_hp'] ?></td>
        <td><?= $dt_jual['alamat'] ?></td>
        <td><?= $dt_jual['pembayaran'] ?></td>
        <td><?= $dt_jual['total_barang'] ?></td>
        <td><?= "Rp. ".number_format($dt_jual['total_bayar'],2,',','.') ?></td>
        <td><?= $dt_jual['waktu_bayar']?></td>
      </tr>
    </tbody>
  <?php endwhile; ?>
</table>