<?php 
include 'db.php';
include 'functions.php';

$error = "";

if (isset($_POST['submit'])) {

    // VALIDASI INPUT
    if (empty($_POST['nama']) || empty($_POST['alamat'])) {
        $error = "Nama dan Alamat wajib diisi.";
    } else {

        $nama_plain = $_POST['nama'];
        $alamat_plain = $_POST['alamat'];

        // Enkripsi
        $nama_en = xor_encrypt($nama_plain);
        $alamat_en = xor_encrypt($alamat_plain);

        // LOGGING
        create_log("encrypt", $nama_plain, $nama_en);
        create_log("encrypt", $alamat_plain, $alamat_en);

        // INSERT
        $sql = "INSERT INTO users (nama, alamat) VALUES ('$nama_en', '$alamat_en')";
        mysqli_query($conn, $sql);

        header("Location: read.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
<div class="card shadow">
<div class="card-header"><h3>Tambah Data</h3></div>
<div class="card-body">

<?php if ($error != ""): ?>
<div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<form method="POST">
    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Alamat</label>
        <input type="text" name="alamat" class="form-control" required>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
</form>

</div></div></div>

</body>
</html>