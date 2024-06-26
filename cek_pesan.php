<?php 
// mengaktifkan session php
session_start();
 
// menghubungkan dengan koneksi
include 'config.php';
 
// menangkap data yang dikirim dari form
$nama = $_POST['nama'];
$hp = $_POST['hp'];
$alamat = $_POST['alamat'];
$jam = $_POST['jam'];
$service = $_POST['service'];
$tanggal = $_POST['tanggal'];
 
// menyeleksi data admin dengan username dan password yang sesuai
$data = mysqli_query($connect,"SELECT * FROM users WHERE username='$username'");
 
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);

if($cek > 0){
	$_SESSION['username'] = $username;
	$_SESSION['status'] = "login";
	header("location:dashboard.php");
}else{
	header("location:login.php?pesan=gagal");
}
?>