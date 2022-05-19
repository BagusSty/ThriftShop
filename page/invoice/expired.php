 <?php
 session_start();
 include '../../config.php';
 if(!isset ($_SESSION['nama']) ){
  header("Location:../../index.php");
 }
  $expired = "UPDATE tb_transaksi SET status='Kadaluarsa' WHERE batas_bayar > CURRENT_DATE AND status='Belum Dibayar'";
  $expire = mysqli_query($conn, $expired);

  if ($expire== true) {
    header('location:invoice.php');
  } else {
    echo '<script>alert("Data Gagal Tersimpan")</script>';
    die ("Gagal menginput data: ".mysqli_errno($conn)." - ".mysqli_error($conn));
  }
?>