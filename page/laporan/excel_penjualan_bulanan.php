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
  header("Content-Disposition: attachment; filename=Laporan_Data_Penjualan_Bulan_$namabulan.xls");
  ?>

  <h2>Laporan Data Penjualan Bulan <?= $namabulan ?></h2>
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
    $tb_jual = mysqli_query($conn,"SELECT * FROM tb_transaksi,tb_user WHERE tb_user.id_user=tb_transaksi.id_user AND status='Sudah Dibayar' AND MONTH(waktu_bayar)='$bulan'");
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
    <?php endwhile; } ?>
  </table>