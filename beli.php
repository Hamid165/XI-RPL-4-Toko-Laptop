<?php 
// mendapatkan id produk dari url
session_start();
$id_produk = $_GET['id'];

//jika ada produk di keranjang maka produk itu jumlahnya di +1
//selain belum ada di keranjang maka produk itu dibeli 1
if (isset($_SESSION['keranjang'][$id_produk]))
{
    $_SESSION['keranjang'][$id_produk]+=1;
}
else
{
    $_SESSION['keranjang'][$id_produk] =1;
}
//echo"<pre>";
//print_r($_SESSION);
//echo"</pre>";

//ke halaman keranjang

echo"<script>alert('produk telah masuk keranjang');</script>";
echo "<script>location='keranjang.php';</script>";
?>