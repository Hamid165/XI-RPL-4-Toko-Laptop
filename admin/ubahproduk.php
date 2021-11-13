<h1>Edit Produk</h1>
<?php
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
$bagi = $ambil->fetch_assoc();
?>
<form method="post" enctype="multipart/form-data">

    <div class="form-group" <label>Nama</label>
        <input type="text" class="form-control" name="nama" value="<?php echo $bagi['nama_produk'] ?>">
    </div>

    <div class="form-group" <label>Stok</label>
        <input type="text" class="form-control" name="stok" value="<?php echo $bagi['stok_produk'] ?>">
    </div>

    <div class="form-group" <label>Harga (Rp)</label>
        <input type="number" class="form-control" name="harga" value="<?php echo $bagi['harga_produk'] ?>">
    </div>
    <div class="form-group">
        <img src="../admin/assets/img/<?php echo $bagi['foto_produk'] ?>" width="200">
    </div>
    <div class="form-group">
        <label>Ganti Foto</label>
        <input type="file" name="foto" class="form-control">
    </div>
    <button class="btn btn-primary" name="ubah">Submit</button>
</form>
<?php
if (isset($_POST['ubah'])) {
    $namafoto = $_FILES['foto']['name'];
    $lokasifoto = $_FILES['foto']['tmp_name'];
    if (!empty($lokasifoto)) {
        move_uploaded_file($lokasifoto, "../foto_produk/$namafoto");
        $koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]',stok_produk='$_POST[stok]'
        ,harga_produk='$_POST[harga]',foto_produk='$namafoto' WHERE id_produk='$_GET[id]'");
    } else {
        $koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]',stok_produk='$_POST[stok]'
        ,harga_produk='$_POST[harga]',foto_produk='$namafoto'WHERE id_produk='$_GET[id]'");
    }
    echo "<script>alert('produk berhasil diubah');</script>";
    echo "<script>location='index.php';</script>";
}
?>