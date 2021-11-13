<?php
session_start();

//echo "<pre>";
//print_r ($_SESSION['keranjang']);
//echo "</pre>";
include 'koneksi.php';
if (empty($_SESSION["keranjang"]) or !isset($_SESSION["keranjang"])) {
    echo "<script>alert('keranjang kosong tuku disit bro');</script>";
    echo "<script>location='index.php';</script>";
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Keranjang </title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords" content="The Laptop Toko Laptop Termurah Dan Terjangkau" />
    <script>
    addEventListener("load", function() {
        setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
        window.scrollTo(0, 1);
    }
    </script>
    <!-- //Meta tag Keywords -->

    <!-- Custom-Files -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <!-- Bootstrap-Core-CSS -->
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <!-- Style-CSS -->
    <!-- font-awesome-icons -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- //font-awesome-icons -->
    <!-- /Fonts -->
    <link href="//fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900"
        rel="stylesheet">
    <!-- //Fonts -->
    <style>
    html,
    body {
        background-color: #148bff;
    }
    </style>

</head>

<body>

    <!-- mian-content -->
    <div id="home">
        <!-- header -->
        <div class="container-fluid px-lg-5">
            <!-- nav -->
            <nav class="py-4">
                <div id="logo">
                    <h1> <a href="index.php">The Laptop</a></h1>
                </div>

                <label for="drop" class="toggle">Menu</label>
                <input type="checkbox" id="drop" />
                <ul class="menu mt-2">
                    <li><a href="index.php">Home</a></li>
                    <li class="active"><a href="keranjang.php">Keranjang</a></li>
                    <li><a href="checkout.php">Checkout</a></li>
                    <li>
                        <?php if (isset($_SESSION["pelanggan"])) : ?>
                        <a href="logout.php">Logout</a>
                        <!--selain itu (blm login||blm ada sesion pelanggan-->
                        <?php else : ?>
                        <a href="login.php">Login</a>
                        <?php endif ?>
                    </li>
                </ul>
            </nav>
            <!-- //nav -->
        </div>
        <br>
        <section class="konten">
            <div class="container">
                <h1 class="text-center mt-7">Keranjang</h1>
                <br>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subharga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $nomor = 1; ?>
                        <?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah) : ?>
                        <?php
                            $ambil = $koneksi->query("SELECT * FROM produk
                where id_produk='$id_produk'");
                            $pecah = $ambil->fetch_assoc();
                            $subharga = $pecah["harga_produk"] * $jumlah;
                            ?>
                        <tr>
                            <td><?php echo $nomor; ?></td>
                            <td><?php echo $pecah["nama_produk"]; ?></td>
                            <td><?php echo number_format($pecah["harga_produk"]); ?></td>
                            <td class="text-center"><?php echo $jumlah; ?></td>
                            <td>Rp. <?php echo number_format($subharga); ?></td>
                            <td>
                                <a href="hapuskeranjang.php?id=<?php echo $id_produk ?>"
                                    class="btn btn-danger btn-xs">Hapus</a>
                            </td>
                        </tr>
                        <?php $nomor++; ?>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <a href="index.php" class="btn btn-warning">Lanjut Belanja</a>
                <a href="checkout.php" class="btn btn-success">Checkout</a>
            </div>
        </section>
</body>

</html>