 <div class="row text-white">
  <div class="card bg-info m-4" style="width: 18rem;">
    <div class="card-body">
      <div class="card-body-icon text-white">
        <i class='fas fa-box'></i>
      </div>
      <h5 class="card-title">Data Barang</h5>
      <?php
      $tb_barang = mysqli_query($conn, "SELECT * FROM tb_barang");
      echo "<p class='display-4'>".mysqli_num_rows($tb_barang)."</p>";
      ?>
      <a href="?page=databarang"><p class="card-text text-white">Lihat Detail <i class="fas fa-angle-double-right ml-2"></i></p></a>
    </div>
  </div>
  <div class="card bg-danger m-4" style="width: 18rem;">
   <div class="card-body">
    <div class="card-body-icon text-white">
     <i class='fas fa-money-check-alt'></i>
   </div>
   <h5 class="card-title">Data Transaksi</h5>
   <?php
   $tb_transaksi = mysqli_query($conn, "SELECT * FROM tb_transaksi");
   echo "<p class='display-4'>".mysqli_num_rows($tb_transaksi)."</p>";
   ?>
   <a href="#"><p class="card-text text-white">Lihat Detail <i class="fas fa-angle-double-right ml-2"></i></p></a>
 </div>
</div>
</div>