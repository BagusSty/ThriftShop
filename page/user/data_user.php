<div class="col-md-10 pt-5">
    <h2><i class='fas fa-user'></i> Data User</h2>
</div>

<!-- Modal Input -->
<button type="button" class="btn my-3" data-bs-toggle="modal" data-bs-target="#addUser"><i class="fa fa-male"></i> Tambah User</button>
<div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModal">Input User Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="tel" class="form-label">No HP</label>
                        <input type="tel" class="form-control" name="no_hp" placeholder="08xxxxxxxxxx" pattern="08[0-9]{10}" maxlength="15" required/>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="option" class="form-label">Pilih Jabatan</label>
                        <select name="jabatan" class="form-control" required>
                            <option value="">--Pilih Jabatan--</option>
                            <option value="Pemilik">Pemilik</option>
                            <option value="Manager">Manager</option>
                            <option value="Kasir">Kasir</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" value="Simpan" name="tambah" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
                <?php
                if (isset($_POST['tambah'])) {
                    $nama = $_POST['nama'];
                    $username = $_POST['username'];
                    $password = md5($_POST['password']);
                    $nohp = $_POST['no_hp'];
                    if ($_POST['jabatan']=='Pemilik') {
                        $qry = "INSERT INTO tb_user(nama,username,no_hp,password,tipe_user) VALUES ('$nama','$username','$nohp','$password','1')";
                        $input = mysqli_query($conn,$qry);
                        if ($input== true) {
                            echo '<script>alert("Data Tersimpan")</script>';
                        } else {
                            echo '<script>alert("Data Gagal Tersimpan")</script>';
                            die ("Gagal menginput data: ".mysqli_errno($conn)." - ".mysqli_error($conn));
                        }
                    }
                    else if ($_POST['jabatan']=='Manager') {
                        $qry = "INSERT INTO tb_user(nama,username,no_hp,password,tipe_user) VALUES ('$nama','$username','$nohp','$password','2')";
                        $input = mysqli_query($conn,$qry);
                        if ($input== true) {
                            echo '<script>alert("Data Tersimpan")</script>';
                        } else {
                            echo '<script>alert("Data Gagal Tersimpan")</script>';
                            die ("Gagal menginput data: ".mysqli_errno($conn)." - ".mysqli_error($conn));
                        }
                    }
                    else if ($_POST['jabatan']=='Kasir') {
                        $qry = "INSERT INTO tb_user(nama,username,no_hp,password,tipe_user) VALUES ('$nama','$username','$nohp','$password','3')";
                        $input = mysqli_query($conn,$qry);
                        if ($input== true) {
                            echo '<script>alert("Data Tersimpan")</script>';
                        } else {
                            echo '<script>alert("Data Gagal Tersimpan")</script>';
                            die ("Gagal menginput data: ".mysqli_errno($conn)." - ".mysqli_error($conn));
                        }
                    }
                    else {
                        echo '<script>alert("Data Gagal Tersimpan")</script>';
                        die ("Gagal menginput data: ".mysqli_errno($conn)." - ".mysqli_error($conn));
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
<form class="row float-sm-end " action="?page=dataadmin?>" method="post">
    <div class="form-group col-lg my-2">
        <input class="form-control px-3" type="text" name="cari" placeholder="Pencarian" >
    </div>
    <div class="col-lg my-2">
        <button class=" btn btn-sm p-2" type="submit" name="submit"><i class="fas fa-search"></i></button>
    </div>
</form>
<table class="table table-sm">
    <tr>
        <th>NO</th>
        <th>Nama User</th>
        <th>Username</th>
        <th>No HP</th>
        <th>Jabatan</th>
        <th>Opsi</th>
    </tr>
    <?php
    if(isset($_POST['cari'])) {
        $cari=$_POST['cari'];
        $tb_user= mysqli_query($conn,"SELECT * FROM tb_user,tb_tipe_user
            WHERE tb_user.tipe_user = tb_tipe_user.tipe_user AND nama like '%$cari%'") or die($conn->error);
    } else {
        $tb_user = mysqli_query($conn,"SELECT * FROM tb_user,tb_tipe_user WHERE tb_user.tipe_user = tb_tipe_user.tipe_user");
    }
    $no = 1;
    while ($dt_user = $tb_user->fetch_assoc()) {
        $data[] = $dt_user;
    }
    if (empty($data)) : ?>
        <tr>
            <td colspan="">Tidak ada data</td>
        </tr>
        <?php else :?>
            <?php foreach ($data as $user) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $user['nama']; ?></td>
                    <td><?= $user['username'] ?></td>
                    <td><?= $user['no_hp']; ?></td>
                    <td><?= $user['jabatan'] ?></td>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editUser<?php echo $user['id_user'];?>">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <!-- Modal Edit -->
                        <div class="modal fade" id="editUser<?php echo $user['id_user'];?>" tabindex="-1" aria-labelledby="editUserLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editUserLabel">Edit User</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post">
                                            <input type="hidden" name="id_user" value="<?= $user['id_user'];?>">
                                            <div class="mb-3">
                                                <label for="nama" class="form-label">Nama</label>
                                                <input type="text" id="nama" value="<?= $user['nama'];?>" name="nama" class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="tel" class="form-label">No HP</label>
                                                <input type="tel" id="no_hp" value="<?= $user['no_hp'];?>" class="form-control" name="no_hp" placeholder="08xxxxxxxxxx" pattern="08[0-9]{10}" maxlength="15" required/>
                                            </div>
                                            <div class="mb-3">
                                                <label for="username" class="form-label">Username</label>
                                                <input type="text" id="username" value="<?= $user['username'];?>" name="username" class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="password">Password</label>
                                                <input type="password" id="password" value="" name="password" class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="option" class="form-label">Pilih Jabatan</label>
                                                <select name="jabatan" value="<?= $user['jabatan'];?>" id="jabatan" class="form-control" required>
                                                    <option value="">--Pilih Jabatan--</option>
                                                    <option value="Pemilik">Pemilik</option>
                                                    <option value="Manager">Manager</option>
                                                    <option value="Kasir">Kasir</option>
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" value="Simpan" name="update" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                        <?php
                                        if (isset($_POST['update'])) {
                                            $id = $_POST['id_user'];
                                            $nama = $_POST['nama'];
                                            $username = $_POST['username'];
                                            $password = md5($_POST['password']);
                                            $nohp = $_POST['no_hp'];
                                            if ($_POST['jabatan']=='Pemilik') {
                                                $tipe_user = '1';
                                                $qry = "UPDATE tb_user SET nama='$nama', username='$username', no_hp='$nohp',  password='$password', tipe_user='$tipe_user' WHERE id_user='$id'";
                                                $input = mysqli_query($conn,$qry);
                                                if ($input== true) {
                                                    header('location:data_user.php');
                                                } else {
                                                    echo '<script>alert("Data Gagal Tersimpan")</script>';
                                                    die ("Gagal menginput data: ".mysqli_errno($conn)." - ".mysqli_error($conn));
                                                }
                                            }
                                            else if ($_POST['jabatan']=='Manager') {
                                                $tipe_user = '2';
                                                $qry = "UPDATE tb_user SET nama='$nama', username='$username', no_hp='$nohp',  password='$password', tipe_user='$tipe_user' WHERE id_user='$id'";
                                                $input = mysqli_query($conn,$qry);
                                                if ($input== true) {
                                                    header('location:data_user.php');
                                                } else {
                                                    echo '<script>alert("Data Gagal Tersimpan")</script>';
                                                    die ("Gagal menginput data: ".mysqli_errno($conn)." - ".mysqli_error($conn));
                                                }
                                            }
                                            else if ($_POST['jabatan']=='Kasir') {
                                                $tipe_user = '3';
                                                $qry = "UPDATE tb_user SET nama='$nama', username='$username', no_hp='$nohp',  password='$password', tipe_user='$tipe_user' WHERE id_user='$id'";
                                                $input = mysqli_query($conn,$qry);
                                                if ($input== true) {
                                                    header('location:data_user.php');
                                                } else {
                                                    echo '<script>alert("Data Gagal Tersimpan")</script>';
                                                    die ("Gagal menginput data: ".mysqli_errno($conn)." - ".mysqli_error($conn));
                                                }
                                            }
                                            else {
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
                            <a href="?page=datauser&id=<?php echo $user['id_user']?>" onclick="return confirm('anda yakin akan menghapus data?')"><i class="fas fa-trash"></i>Hapus</span></a>
                        </button>
                        <?php
                        if (isset($_GET['id'])) {
                            $id = $_GET['id'];
                            $query = "DELETE FROM tb_user WHERE id_user='$id' ";
                            $hasil = mysqli_query($conn, $query);
                            if(!$hasil){
                                echo '<script>alert("Data Terhapus")</script>';
                                die ("Gagal menghapus data: ".mysqli_errno($conn)." - ".mysqli_error($conn));
                            }
                        }
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif ?>
    </table>