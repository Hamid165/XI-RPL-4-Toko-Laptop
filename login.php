<?php
session_start();
include 'koneksi.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <title>Login Pelanggan</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>

<body>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <title>My Laptop</title>
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="keranjang.php">Keranjang</a>
                    </li>
                    <!--jk sudah login(ada sesion pelanggan-->
                    <?php if (isset($_SESSION["pelanggan"])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                    <!--selain itu (blm login||blm ada sesion pelanggan-->
                    <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <?php endif ?>

                    <li class="nav-item">
                        <a class="nav-link" href="checkout.php">Checkout</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading"><br>
                            <h3 class="panel-title">Login Pelanggan</h3>
                        </div>
                        <div class="panel-body">
                            <form method="post">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                                <button class="btn btn-primary" name="login">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        //jk tombol login (tombolditekan)
        if (isset($_POST["login"])) {
            // lakukan kuery ngecek akun di tabel pelanggan di db
            $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$_POST[email]' AND password_pelanggan='$_POST[password]'");

            //akun yang terhitung
            $akunyangcocok = $ambil->num_rows;
            //jika 1 akun yang cocok maka diloginkan
            if ($akunyangcocok == 1) {
                //anda sudah login
                //mendapatkan akun dlm bentuk array
                $akun = $ambil->fetch_assoc();
                //simpan di session pelanggan
                $_SESSION["pelanggan"] = $akun;
                echo "<script>alert('anda sukses login');</script>";
                echo "<script>location='index.php';</script>";
            } else {
                //anda gagal login
                echo "<script>alert('anda gagal login, periksa akun anda');</script>";
                echo "<script>location='index.php';</script>";
            }
        }
        ?>
    </body>

</html>