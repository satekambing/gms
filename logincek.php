<?php
session_start();
require_once("config/koneksi.php");
$koneksi	= new mysqli(SERVER, USER, PASS, DBNAME);


error_reporting(E_ALL);
if(isset($_POST['username']) && isset($_POST['pass'])){
  $user = $_POST['username'];
  $pass = $_POST['pass'];

  if($user == "" OR $pass == ""){
    echo (die("Data Tidak Lengkap"));
  }else{
    $login = $koneksi->prepare("SELECT username,pass FROM user WHERE username=? AND pass=?");
    $pass  = md5($pass); // konfersi ke md5 dahulu

    $login->bind_param("ss",$user,$pass);
    $login->execute();

    $login->store_result();
    $login->bind_result($username,$pass);
    $login->fetch();
    if($login->num_rows > 0){
      // set session dulu kalo login berhasil
      $_SESSION['username'] = $username;
      $_SESSION['pass'] = $pass;
      header('location: index.php');

    }else{
      header('location: login.php?pesan=0');
    }
  }
}else{
  echo "<marquee><h1>Apa ya</h1></marquee>";
  // header('location: login.php?pesan=0');
}
?>
