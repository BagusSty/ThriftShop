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
		$_SESSION['username'] = $_POST['username'];
		$_SESSION['tipe_user']=$cek['tipe_user'];
		header("location:admin/beranda_admin.php");
	}
	else if($cek['tipe_user']=="2") {
		$_POST['username'] = $username;
     	$_POST['password'] = $password;
		 $_SESSION['username'] = $_POST['username'];
		$_SESSION['tipe_user']=$cek['tipe_user'];
		header("location:manager/beranda_manager.php");

	}
	else if($cek['tipe_user']=="3") {
		$_POST['username'] = $username;
    	$_POST['password'] = $password;
		$_SESSION['username'] = $_POST['username'];
		$_SESSION['tipe_user']=$cek['tipe_user'];
		header("location:kasir/manager_kasir.php");
	} else {
		header("location:index.php?pesan=gagal");
	}
}
?>

