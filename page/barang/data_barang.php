
<div class="col-md-10 pt-5">
    <h2><i class='fas fa-box'></i> Data Barang</h2>
</div>

<!-- Modal Input -->
<button type="button" class="btn my-3" data-bs-toggle="modal" data-bs-target="#addUser"><i class='fas fa-box'></i> Tambah Barang</button>
<div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModal">Input Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="option" class="form-label">Pilih Kategori</label>
                        <select name="kategori" class="form-control" required>
                            <option value="">--Pilih Kategori--</option>
                            <?php
                            $sql=mysqli_query($conn, "SELECT * FROM tb_kategori");
                            while ($data=mysqli_fetch_array($sql)) {
                                ?>
                                <option value="<?=$data['id_kategori']?>"><?=$data['nama_kategori']?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <div class="mb-3">
                            <label for="option" class="form-label">Pilih Supplier</label>
                            <select name="supplier" class="form-control" required>
                                <option value="">--Pilih Supplier--</option>
                                <?php
                                $sql=mysqli_query($conn, "SELECT * FROM tb_supplier");
                                while ($data=mysqli_fetch_array($sql)) {
                                    ?>
                                    <option value="<?=$data['id_supplier']?>"><?=$data['nama_supplier']?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="stok" class="form-label">Stok</label>
                            <input type="number" name="stok" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="harga_pokok" class="form-label">Harga Pokok</label>
                            <input type="number" name="harga_pokok" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="harga_jual" class="form-label">Harga Jual</label>
                            <input type="number" name="harga_jual" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" value="Simpan" name="tambah" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
                <?php if (isset($_POST['tambah'])) {
                    $nama = $_POST['nama'];
                    $kategori = $_POST['kategori'];
                    $stok = $_POST['stok'];
                    $hrg_pokok = $_POST['harga_pokok'];
                    $hrg_jual = $_POST['harga_jual'];
                    $qry = "INSERT INTO tb_barang(nama_barang,id_kategori,stok,harga_pokok,harga_jual) VALUES ('$nama','$kategori','$stok','$hrg_pokok','$hrg_jual' )";
                    $input = mysqli_query($conn,$qry);
                    if ($input== true) {
                        echo '<script>alert("Data Tersimpan")</script>';
                        header('location:?page=databarang');
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
<table class="table table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Kategori</th>
            <th>Stok</th>
            <th>harga Pokok</th>
            <th>Harga Jual</th>
            <th>Opsi</th>
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
                <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editUser<?php echo $data['id_barang'];?>">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    <!-- Modal Edit -->
                    <div class="modal fade" id="editUser<?php echo $data['id_barang'];?>" tabindex="-1" aria-labelledby="editUserLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editUserLabel">Edit Barang</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post">
                                        <input type="hidden" name="id_barang" value="<?= $data['id_barang'] ?>">
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama</label>
                                            <input type="text" name="nama" value="<?= $data['nama_barang'] ?>" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="option" class="form-label">Pilih Kategori</label>
                                            <select name="jabatan" class="form-control">
                                                <option value="">--Pilih Kategori--</option>
                                                <?php
                                                $sql=mysqli_query($conn, "SELECT * FROM tb_kategori");
                                                while ($data=mysqli_fetch_array($sql)) {
                                                    ?>
                                                    <option value="<?=$data['id_kategori']?>"><?=$data['nama_kategori']?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" value="Simpan" name="edit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    if (isset($_POST['edit'])) {
                        $id = $_POST['id_barang'];
                        $stok = $_POST['stok'];
                        $hrg_pokok = $_POST['harga_pokok'];
                        $hrg_jual = $_POST['harga_jual'];
                        $qry = "UPDATE tb_barang SET stok='$stok', harga_pokok='$hrg_pokok',  harga_jual='$hrg_jual' WHERE id_barang='$id'";
                        $input = mysqli_query($conn,$qry);
                        if ($input== true) {
                            echo '<script>alert("Data Tersimpan")</script>';
                        } else {
                            echo '<script>alert("Data Gagal Tersimpan")</script>';
                            die ("Gagal menginput data: ".mysqli_errno($conn)." - ".mysqli_error($conn));
                        }
                    }
                    ?>
                    <button class="btn">
                        <a href="?page=databarang&id=<?php echo $data['id_barang']?>" onclick="return confirm('anda yakin akan menghapus data?')"><i class="fas fa-trash"></i>Hapus</span></a>
                    </button>
                    <?php
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $query = "DELETE FROM tb_barang WHERE id_barang='$id' ";
                        $hasil = mysqli_query($conn, $query);
                        if(!$hasil){
                            echo '<script>alert("Data Terhapus")</script>';
                            die ("Gagal menghapus data: ".mysqli_errno($conn)." - ".mysqli_error($conn));
                        }
                    }
                    ?>
                </td>
            </tr>
        </tbody>
    </table>
<?php endforeach; ?>

