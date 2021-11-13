<h1>Tambah Produk</h1>
<form method="post" enctype="multipart/form-data">

    <div class="form-group"><label>Nama</label>
        <input type="text" class="form-control" name="nama">
    </div>

    <div class="form-group">
        <label>Stok</label>
        <input type="number" class="form-control" name="stok">
    </div>

    <div class="form-group">
        <label>Harga (Rp) </label>
        <input type="number" class="form-control" name="harga">
    </div>
    <div class="form-group">
        <label>Foto</label>
        <input type="file" class="form-control" name="foto">
    </div>
    <button class="btn btn-primary" name="save">Submit</button>
</form>
<?php
if (isset($_POST['save'])) {
    $nama = $_FILES['foto']['name'];
    $lokasi = $_FILES['foto']['tmp_name'];
    move_uploaded_file($lokasi, "../admin/foto_produk/" . $nama);
    $koneksi->query("INSERT INTO produk (nama_produk,stok_produk,harga_produk,foto_produk,deskripsi_produk) 
    VALUES ('$_POST[nama]','$_POST[stok]','$_POST[harga]','$nama','$_POST[deskripsi]')");
    
    echo "<script>alert('Produk Anda Berhasil Ditambahkan');</script>";
    echo "<script>location='index.php?halaman=produk';</script>";
}
?>