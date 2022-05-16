<?php
 session_start();
 include '../../config.php';
 if(!isset ($_SESSION['nama']) ){
  header("Location:../../index.php");
}
if (isset($_POST['tambah'])) {
    include '../../config.php';
              $id = $_POST['id_barang'];
              $supplier = $_POST['supplier'];
              $tgl = $_POST['tgl'];
              $harga = $_POST['harga'];
              $jml_brg = $_POST['jumlah_brg'];
              $jml_hrg = $harga*$jml_brg;

                  //menghitung harga jual
              $hrg_jual = ($harga*10/100)+$harga;
                  //meupdate stok dan harga barang
              $sql=mysqli_query($conn, "SELECT * FROM tb_barang where id_barang='$id'");
              $data=mysqli_fetch_array($sql);
              $stok = $data['stok'];
              $tmbh_stok = $stok+$jml_brg;
              $qry = "INSERT INTO tb_barang_masuk(id_barang,tanggal,id_supplier,jumlah_barang,jumlah_harga_pokok) VALUES ('$id','$tgl','$supplier','$jml_brg','$jml_hrg')";
              $input = mysqli_query($conn,$qry);
              if ($input == true) {
                $upd = "UPDATE tb_barang SET stok='$tmbh_stok',harga_pokok='$harga', harga_jual='$hrg_jual' WHERE id_barang='$id'";
                $update = mysqli_query($conn,$upd);
                var_dump($tmbh_stok);
              } else {
                echo '<script>alert("Data Gagal Tersimpan")</script>';
                var_dump($qry);
                die ("Gagal menginput data: ".mysqli_errno($conn)." - ".mysqli_error($conn));
              }
            }
?>
