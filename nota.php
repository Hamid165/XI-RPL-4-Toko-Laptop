<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['pelanggan'])) {
    echo "<script>alert('Login Dulu Bos!!!')</script>";
    echo "<script>location='login.php';</script>";
    header('location:login.php');
    exit();
}
?>

<head>
    <title>Nota </title>
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
                </ul>
            </nav>
            <!-- //nav -->
        </div>
        <section class="konten">
            <div class="container">
                <h1 class="text-center">Nota Pembelian</h1>
                <hr>
                <?php
                $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan
    ON pembelian.id_pelanggan=pelanggan.id_pelanggan
    WHERE pembelian.id_pembelian='$_GET[id]'");
                $detail = $ambil->fetch_assoc();
                ?>
                <div class="row">
                    <div class="col-md-4">
                        <h3>Pembelian</h3>
                        <strong>No Pembelian : <?php echo $detail['id_pembelian']; ?><br>
                            <h6>
                                Tanggal : <?php echo $detail['tanggal_pembelian']; ?><br>
                                total pembelian : Rp. <?php echo number_format($detail['total_pembelian']); ?>

                            </h6>
                        </strong>
                    </div>
                    <div class="col-md-4">
                        <h3>Pelanggan</h3>
                        <strong>Nama : <?php echo $detail['nama_pelanggan']; ?><br>
                            <h6>
                                No : <?php echo $detail['telepon_pelanggan']; ?><br>
                                Email : <?php echo $detail['email_pelanggan']; ?>
                            </h6>

                        </strong>
                    </div>

                </div>
                <br>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $nomor = 1; ?>
                        <?php $ambil = $koneksi->query("SELECT * FROM pembelian_produk JOIN produk ON
        pembelian_produk.id_produk = produk.id_produk 
        WHERE pembelian_produk.id_pembelian='$_GET[id]'"); ?>
                        <?php while ($bagi = $ambil->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $nomor ?></td>
                            <td><?php echo $bagi['nama_produk']; ?></td>
                            <td>Rp. <?php echo number_format($bagi['harga_produk']); ?></td>
                            <td><?php echo $bagi['jumlah']; ?></td>
                            <td>
                                Rp. <?php echo number_format($bagi['harga_produk'] * $bagi['jumlah']); ?>
                            </td>
                        </tr>
                        <?php $nomor++; ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>
        <div class="container">
            <div class="col-md-5">
                <div class="alert alert-success">
                    <h7>
                        Silakan Lakukan Pembayaran Sebesar Rp. <?php echo number_format($detail['total_pembelian']); ?>
                        <strong>BANK BCA 123-456-78910 AN PT THE STORE</strong>

                    </h7>
                </div>
            </div>
        </div>
        </header>
</body>

</html>