<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['pelanggan'])) {
    echo "<script>alert('Login Dulu Bos!!!')</script>";
    echo "<script>location='login.php';</script>";
    header('location:login.php');
    exit();
}
if (empty($_SESSION["keranjang"])) {
    echo "<script>alert('tidak dapat checkout, silakan masukan ke keranjang terlebih dahulu');</script>";
    echo "<script>location='index.php';</script>";
}
?>

<head>
    <title>Checkout </title>
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
                    <li class="active"><a href=" checkout.php">Checkout</a></li>
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
                <h1 class="text-center">Checkout</h1>
                <hr>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $nomor = 1; ?>
                        <?php $totalbelanja = 0; ?>
                        <?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah) : ?>
                        <?php
                            $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
                            $pecah = $ambil->fetch_assoc();
                            $subharga = $pecah['harga_produk'] * $jumlah;
                            ?>
                        <tr>
                            <td><?php echo $nomor; ?></td>
                            <td><?php echo $pecah["nama_produk"]; ?></td>
                            <td>Rp. <?php echo number_format($pecah["harga_produk"]); ?></td>
                            <td><?php echo $jumlah; ?></td>
                            <td>Rp. <?php echo number_format($subharga); ?></td>
                        </tr>
                        <?php $nomor++; ?>
                        <?php $totalbelanja += $subharga; ?>
                        <?php endforeach ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4">Total Belanja</th>
                            <th>Rp. <?php echo number_format($totalbelanja); ?></th>

                        </tr>
                    </tfoot>
                </table>
                <form method="post">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" readonly
                                    value="<?php echo $_SESSION["pelanggan"]['nama_pelanggan'] ?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" readonly
                                    value="<?php echo $_SESSION["pelanggan"]['telepon_pelanggan'] ?>"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <select class="form-control" name="id_ongkir">
                                <option value="">Pilih Ongkos Kirim</option>
                                <?php $ambil = $koneksi->query("SELECT * FROM ongkir");
                                while ($perongkir = $ambil->fetch_assoc()) { ?>
                                <option value="<?php echo $perongkir["id_ongkir"] ?>">
                                    <?php echo $perongkir['nama_kota']; ?>
                                    - Rp. <?php echo number_format($perongkir['tarif']); ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Alamat Lengkap</label>
                        <textarea name="alamat" class="form-control"
                            placeholder="Masukan Alamat Lengkap...."></textarea>
                    </div>
                    <button class="btn btn-success" name="checkout">Checkout</button>
                </form>
                <?php
                if (isset($_POST['checkout'])) {
                    $id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
                    $id_ongkir = $_POST['id_ongkir'];
                    $tanggalpembelian = date("Y-m-d");
                    $alamat = $_POST['alamat'];

                    $ambil = $koneksi->query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
                    $arrayongkir = $ambil->fetch_assoc();
                    $nama_kota = $arrayongkir['nama_kota'];
                    $tarif = $arrayongkir['tarif'];
                    $total_pembelian = $totalbelanja + $tarif;

                    $koneksi->query("INSERT INTO pembelian (id_pelanggan,id_ongkir,tanggal_pembelian,total_pembelian,nama_kota,tarif,alamat)
                VALUES ('$id_pelanggan','$id_ongkir','$tanggalpembelian','$total_pembelian','$nama_kota','$tarif','$alamat')");

                    $id_pembeliantadi = $koneksi->insert_id;
                    foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) {
                        $koneksi->query("INSERT INTO pembelian_produk (id_pembelian,id_produk,jumlah)
                    VALUES ('$id_pembeliantadi','$id_produk','$jumlah')");
                    }

                    $koneksi->query("UPDATE produk SET stok_produk='stok_produk -$jumlah' WHERE id_produk = '$id_produk'");

                    //belanja dikosongkan
                    unset($_SESSION["keranjang"]);

                    //dialihkan nota 
                    echo "<script>alert('pembelian sukses')</script>";
                    echo "<script>location='nota.php?id=$id_pembeliantadi';</script>";
                }
                ?>
            </div>
        </section>
</body>

</html>