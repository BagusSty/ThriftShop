<div class="col-md-10 pt-5">
    <h2><i class='fas fa-truck'></i> Data Supplier</h2>
</div>

<!-- Modal Input -->
<button type="button" class="btn my-3" data-bs-toggle="modal" data-bs-target="#addUser"><i class='fas fa-truck'></i> Tambah Supplier</button>
<div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModal">Input Supplier Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Supplier</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="tel" class="form-label">No HP</label>
                        <input type="tel" class="form-control" name="no_hp" placeholder="08xxxxxxxxxx" pattern="08[0-9]{10}" maxlength="15" required/>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" name="alamat" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" value="Simpan" name="simpan" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
                <?php
                if (isset($_POST['simpan'])) {
                    $nama = $_POST['nama'];
                    $nohp = $_POST['no_hp'];
                    $alamat = $_POST['alamat'];
                    $qry = "INSERT INTO tb_supplier(nama_supplier,no_hp_supplier,alamat_supplier) VALUES ('$nama','$nohp','$alamat')";
                    $input = mysqli_query($conn,$qry);
                    if ($input== true) {
                        echo '<script>alert("Data Tersimpan")</script>';
                    } else {
                        echo '<script>alert("Data Gagal Tersimpan")</script>';
                        die ("Gagal menginput data: ".mysqli_errno($conn)." - ".mysqli_error($conn));
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
<table class="table table-sm">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Supplier</th>
            <th>No HP</th>
            <th>Alamat</th>
            <th>Opsi</th>
        </tr>
    </thead>

    <?php
    $tb_supplier = mysqli_query($conn,"SELECT * FROM tb_supplier");
    $no = 1;
    while ($dt_supplier = $tb_supplier->fetch_assoc()) {
        $supplier[] = $dt_supplier;
    }
    foreach ($supplier as $supp) : ?>
        <tbody>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $supp['nama_supplier']; ?></td>
                <td><?= $supp['no_hp_supplier'] ?></td>
                <td><?= $supp['alamat_supplier']; ?></td>
                <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editUser<?php echo $supp['id_supplier'];?>">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    <!-- Modal Edit -->
                    <div class="modal fade" id="editUser<?php echo $supp['id_supplier'];?>" tabindex="-1" aria-labelledby="editUserLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editUserLabel">Edit Supplier</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post">
                                        <input type="hidden" name="id_supplier" value="<?= $supp['id_supplier'];?>">
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama</label>
                                            <input type="text" id="nama" value="<?= $supp['nama_supplier'];?>" name="nama" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="tel" class="form-label">No HP</label>
                                            <input type="tel" id="no_hp" value="<?= $supp['no_hp_supplier'];?>" class="form-control" name="no_hp" placeholder="08xxxxxxxxxx" pattern="08[0-9]{10}" maxlength="15" required/>
                                        </div>
                                        <div class="mb-3">
                                            <label for="alamat" class="form-label">Alamat</label>
                                            <input type="text" id="alamat" value="<?= $supp['alamat_supplier'];?>" name="alamat" class="form-control" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" value="update" name="update" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                    <?php
                                    if (isset($_POST['update'])) {
                                        $id = $_POST['id_supplier'];
                                        $nama = $_POST['nama'];
                                        $nohp = $_POST['no_hp'];
                                        $alamat = $_POST['alamat'];
                                        $qry = "UPDATE tb_supplier SET nama_supplier='$nama', no_hp_supplier='$nohp',  alamat_supplier='$alamat' WHERE id_supplier='$id'";
                                        $input = mysqli_query($conn,$qry);
                                        if ($input== true) {
                                            echo '<script>alert("Data Tersimpan")</script>';
                                        } else {
                                            echo '<script>alert("Data Gagal Tersimpan")</script>';
                                            die ("Gagal menginput data: ".mysqli_errno($conn)." - ".mysqli_error($conn));
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn">
                        <a href="?page=datasupplier&id=<?php echo $supp['id_supplier']?>" onclick="return confirm('anda yakin akan menghapus data?')"><i class="fas fa-trash"></i>Hapus</span></a>
                    </button>
                    <?php
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $query = "DELETE FROM tb_supplier WHERE id_supplier='$id' ";
                        $hasil = mysqli_query($conn, $query);
                        if(!$hasil){
                            die ("Gagal menghapus data: ".mysqli_errno($conn)." - ".mysqli_error($conn));
                        }
                    }
                    ?>
                </td>
            </tr>
        </tbody>
    <?php endforeach; ?>
</table>