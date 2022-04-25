 <?php
 session_start();
 include '../../config.php';
 if(!isset ($_SESSION['nama']) ){
 	header("Location:../../index.php");
 }
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">

 	<title>Beranda</title>
 	<!-- JQuery-->
 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

 	<!--Data Tables-->
 	<link rel="stylesheet" type="text/css" href="../../assets/DataTables/datatables.min.css"/>

 	<!--Bootstrap-->
 	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">    <!--CSS-->
 	<link rel="stylesheet" href="../../css/style.css">

 	<!-- Font Awesome JS -->
 	<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
 	<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
 </head>
 <body>
 	<div class="wrapper">
 		<!-- Sidebar  -->
 		<?php
 		if(!isset($_SESSION['tiper_user'])=="1" ){
 			include_once('../../users/admin/sidebar_admin.php');
 		} elseif (!isset($_SESSION['tiper_user'])=="2" ) {
 			include_once('../../users/manager/sidebar_manager.php');
 		}
 		?>
 		<!-- Page Content  -->
 		<div id="content">
 			<?php include_once('../../assets/navbar/navbar.php'); ?>

 			<div class="content">
 				<div class="col-md-10 pt-5">
 					<h2><i class="fas fa-columns"></i> Invoice</h2>
 				</div>
 				<table class="table table-striped">
 					<thead>
 						<tr>
 							<th>Kode Transaksi</th>
 							<th>Nama Pemesan</th>
                            <th>Pembayaran</th>
                            <th>Total Barang</th>
                            <th>Total Pembayaran</th>
                            <th>Waktu Pesan</th>
                            <th>Batas Pembayaran</th>
                            <th>Status Pembayaran</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <?php
                    $tb_transaksi = mysqli_query($conn,"SELECT * FROM tb_user,tb_transaksi WHERE tb_user.id_user=tb_transaksi.id_user");
                    while ($data = $tb_transaksi->fetch_assoc()) : ?>
                     <tbody>
                        <tr>
                           <td><?= $data['kode']; ?></td>
                           <td><?= $data['nama']; ?></td>
                           <td><?= $data['pembayaran']; ?></td>
                           <td><?= $data['total_barang']; ?></td>
                           <td><?=  "Rp. ".number_format($data['total_bayar'],2,',','.') ?></td>
                           <td><?= $data['waktu_pesan']; ?></td>
                           <td><?= $data['batas_bayar']; ?></td>
                           <td><?= $data['status']; ?></td>
                           <td>
                              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detail<?php echo $data['no_transaksi'];?>">
                                 Detail
                             </button>
                             <!-- Modal Details -->
                             <div class="modal fade" id="detail<?php echo $data['no_transaksi'];?>" tabindex="-1" aria-labelledby="editUserLabel" aria-hidden="true">
                                 <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <h5 class="modal-title" id="editUserLabel">Detail Order</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                          <table  class="table table-striped">
                                           <tr>
                                            <th>Kode Transaksi</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah Beli</th>
                                            <th>Total Harga</th>
                                        </tr>
                                         <?php
                                       $tb_detail = mysqli_query($conn,"SELECT * FROM tb_barang,tb_transaksi,tb_transaksi_detail WHERE tb_transaksi_detail.no_transaksi = '$data[no_transaksi]' AND tb_barang.id_barang=tb_transaksi_detail.id_barang AND tb_transaksi.no_transaksi=tb_transaksi_detail.no_transaksi");
                                       while ($detail=mysqli_fetch_array($tb_detail)) {
                                          ?>
                                        <tr>
                                            <td><?= $detail['kode']; ?></td>
                                            <td><?= $detail['nama_barang']; ?></td>
                                            <td><?= $detail['pembelian']; ?></td>
                                            <td><?= "Rp. ".number_format($detail['pembelian']*$detail['harga_jual'],2,',','.') ?></td>
                                        </tr>
                                    <?php
                                }
                                ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirm<?php echo $data['no_transaksi'];?>">
                    Konfirmasi
                </button>
             <!-- Modal Konfirmasi -->
             <div class="modal fade" id="confirm<?php echo $data['no_transaksi'];?>" tabindex="-1" aria-labelledby="editUserLabel" aria-hidden="true">
                 <div class="modal-dialog">
                    <div class="modal-content">
                       <div class="modal-header">
                          <h5 class="modal-title" id="editUserLabel">Konfirmasi Pembayaran</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          <form action="confirm.php" method="post">
                              <input type="hidden" name="batas" value="<?= $data['batas_bayar'];?>">
                             <input type="hidden" name="no" value="<?= $data['no_transaksi'];?>">
                             <div class="modal-footer">
                                <button type="submit" data-bs-dismiss="modal" class="btn-danger">Tidak</button>
                                <button type="submit" value="ya" name="ya" class="btn-primary">Ya</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </td>
</tr>
</tbody>
<?php endwhile; ?>
</table>
</div>
</div>
</div>
<!--Data Tables JS-->
<script type="text/javascript" src="../../assets/DataTables/datatables.min.js"></script>
<!-- Popper.JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script type="text/javascript">
 $(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
       $('#sidebar').toggleClass('active');
   });
});
</script>
<script type="text/javascript">
 $(document).ready( function () {
    $('.table').DataTable();
})
</script>
</body>