<div class="mt-5">
    <!--PHP Tanggal-->
    <?php
    $tanggal = mktime(date('m'), date("d"), date('Y'));
    date_default_timezone_set("Asia/Jakarta");
    $hari = date ("D");
    switch($hari){
        case 'Sun':
        $hari_ini = "Minggu";
        break;

        case 'Mon':
        $hari_ini = "Senin";
        break;

        case 'Tue':
        $hari_ini = "Selasa";
        break;

        case 'Wed':
        $hari_ini = "Rabu";
        break;

        case 'Thu':
        $hari_ini = "Kamis";
        break;

        case 'Fri':
        $hari_ini = "Jumat";
        break;

        case 'Sat':
        $hari_ini = "Sabtu";
        break;

        default:
        $hari_ini = "Tidak di ketahui";
        break;
    }
    $jam = date ("H:i:s");
    $a = date ("H");
    if (($a>=6) && ($a<=11)) {
        echo " <h4>Selamat Pagi, ". $_SESSION['nama']."</h4>";
        echo "<h4>".$hari_ini.",".date("d-m-Y", $tanggal )."</h4>";
    }else if(($a>=11) && ($a<=15)){
        echo " <h4>Selamat Pagi, ". $_SESSION['nama']."</h4>";
        echo "<h4>".$hari_ini.",".date("d-m-Y", $tanggal )."</h4>";
    }elseif(($a>15) && ($a<=18)){
        echo " <h4>Selamat Siang, ". $_SESSION['nama']."</h4>";
        echo "<h4>".$hari_ini.",".date("d-m-Y", $tanggal )."</h4>";
    }else{
        echo " <h4>Selamat Malam, ". $_SESSION['nama']."</h4>";
        echo "<h4>".$hari_ini.", ".date("d-m-Y", $tanggal )."</h4>";
    }
    ?>
    <hr>
    <div class="row text-white">
        <div class="card bg-primary m-4" style="width: 18rem;">
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
        <div class="card bg-danger m-4" style="width: 18rem;">
            <div class="card-body">
                <div class="card-body-icon text-white">
                    <i class='fas fa-box'></i>
                </div>
                <h5 class="card-title">Data Barang Masuk</h5>
                <?php
                $tb_barang_masuk = mysqli_query($conn, "SELECT * FROM tb_barang_masuk");
                echo "<p class='display-4'>".mysqli_num_rows($tb_barang_masuk)."</p>";
                ?>
                <a href="?page=barangmasuk"><p class="card-text text-white">Lihat Detail <i class="fas fa-angle-double-right ml-2"></i></p></a>
            </div>
        </div>
    </div>