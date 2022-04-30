<?php
session_start();
include 'config.php';


if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$password = md5($_POST['password']);

	$login = mysqli_query($conn,"SELECT * FROM tb_user WHERE username='$username' AND password='$password'");
	$cek = mysqli_fetch_array($login);
	$_SESSION['tipe_user']=$cek['tipe_user'];
	if($cek['tipe_user']=="1"){
		$_POST['username'] = $username;
    	$_POST['password'] = $password;
		$_SESSION['nama'] = $cek['nama'];
		$_SESSION['tipe_user']="1";
		header("location:users/admin/beranda_admin.php");
	}
	else if($cek['tipe_user']=="2") {
		$_POST['username'] = $username;
     	$_POST['password'] = $password;
		$_SESSION['nama'] = $cek['nama'];
		$_SESSION['tipe_user']="2";
		header("location:users/karyawan/beranda_karyawan.php");

	}
	else if($cek['tipe_user']=="3") {
		$_POST['username'] = $username;
    	$_POST['password'] = $password;
		$_SESSION['nama'] = $cek['nama'];
		$_SESSION['tipe_user']="3";
		header("location:users/user/beranda_user.php");
	} else {
		echo '<script>alert("Gagal Login")</script>';
	}
}
?>

