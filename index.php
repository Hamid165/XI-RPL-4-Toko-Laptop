<?php
session_start();
//koneksi database
include 'koneksi.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>The Laptop </title>
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
    .back {
        background: url(image/ban.png)no-repeat center;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        -ms-background-size: cover;
        background-size: cover;
        position: relative;
        height: 50em;
    }
    </style>
</head>

<body>

    <!-- mian-content -->
    <div class="back" id="home">
        <!-- header -->
        <header class="header">
            <div class="container-fluid px-lg-5">
                <!-- nav -->
                <nav class="py-4">
                    <div id="logo">
                        <h1> <a href="index.php">The Laptop</a></h1>
                    </div>

                    <label for="drop" class="toggle">Menu</label>
                    <input type="checkbox" id="drop" />
                    <ul class="menu mt-2">
                        <li class="active"><a href="index.php">Home</a></li>
                        <li><a href="keranjang.php">Keranjang</a></li>
                        <li><a href="checkout.php">Checkout</a></li>
                        <li>
                            <?php if (isset($_SESSION["pelanggan"])) : ?>
                            <a href="logout.php">Logout</a>
                            <!--selain itu (blm login||blm ada sesion pelanggan-->
                            <?php else : ?>
                            <a href="login.php">Login</a>
                            <?php endif ?>
                        </li>
                        <li><a href="admin/index.php">Admin</a></li>

                    </ul>
                </nav>
                <!-- //nav -->
            </div>
        </header>
        <!-- //header -->
        <!--/banner-->
        <div class="banner-info">

            <h3>Pilih Laptop Terbaik Anda Di Toko Kami:)</h3>
            <p>Toko Laptop Termurah Dan Terpercaya</p>
        </div>
        <!--// banner-inner -->

    </div>
    <!--//main-content-->
    <!--/ab -->
    <section class="about py-md-5 py-5">
        <div class="container-fluid">
            <div class="feature-grids row px-3">
                <div class="col-lg-3 gd-bottom">
                    <div class="bottom-gd row">
                        <div class="icon-gd col-md-3 text-center"><span class="fa fa-truck" aria-hidden="true"></span>
                        </div>
                        <div class="icon-gd-info col-md-9">
                            <h3 class="mt-3">Gratis Ongkir Seluruh Indonesia</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 gd-bottom">
                    <div class="bottom-gd row bottom-gd2">
                        <div class="icon-gd col-md-3 text-center"><span class="fa fa-bullhorn"></span></div>
                        <div class="icon-gd-info col-md-9">
                            <h3 class="mt-4">Garansi Selama 6 Bulan</h3>

                        </div>
                    </div>
                </div>
                <div class="col-lg-3 gd-bottom">
                    <div class="bottom-gd row">
                        <div class="icon-gd col-md-3 text-center"> <span class="fa fa-gift" aria-hidden="true"></span>
                        </div>

                        <div class="icon-gd-info col-md-9">
                            <h3 class="mt-4">Dapatkan Diskon 10%</h3>
                        </div>

                    </div>
                </div>
                <div class="col-lg-3 gd-bottom">
                    <div class="bottom-gd row">
                        <div class="icon-gd col-md-3 text-center"> <span class="fa fa-usd" aria-hidden="true"></span>
                        </div>
                        <div class="icon-gd-info col-md-9">
                            <h3 class="mt-4">Pembayaran 100% Aman</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- //ab -->
    <!--/ab -->
    <section class="about py-5">
        <div class="container">
            <h3 class="tittle text-center">Daftar Produk Kami</h3>
            <div class="row">
                <?php $ambil = $koneksi->query("SELECT * FROM produk"); ?>
                <?php while ($perproduk =  $ambil->fetch_assoc()) { ?>
                <div class="col-md-3">
                    <div class="product-shoe-info shoe text-center md-3">
                        <div class="men-thumb-item">
                            <img width="200px" height="200px" src="foto_produk/<?php echo $perproduk['foto_produk']; ?>"
                                alt="">
                        </div>
                        <div class="item-info-product">
                            <h4>
                                <a href="#"><?php echo $perproduk['nama_produk']; ?></a>
                            </h4>
                            <a>Rp.<?php echo number_format($perproduk['harga_produk']); ?></a>
                            <br>
                            <a href="beli.php?id=<?php echo $perproduk['id_produk']; ?>"
                                class="btn btn-primary">Beli!</a>
                        </div>
                    </div>

                </div>
                <?php } ?>
            </div>
        </div>
    </section>


</body>

</html>