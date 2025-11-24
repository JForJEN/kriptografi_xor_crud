<?php 
include 'db.php';
include 'functions.php';

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id=$id"));

$error = "";

if (isset($_POST['submit'])) {

    if (empty($_POST['nama']) || empty($_POST['alamat'])) {
        $error = "Semua field wajib diisi.";
    } else {

        $nama_plain = $_POST['nama'];
        $alamat_plain = $_POST['alamat'];

        $nama_en = xor_encrypt($nama_plain);
        $alamat_en = xor_encrypt($alamat_plain);

        create_log("encrypt", $nama_plain, $nama_en);
        create_log("encrypt", $alamat_plain, $alamat_en);

        mysqli_query($conn, "UPDATE users SET nama='$nama_en', alamat='$alamat_en' WHERE id=$id");

        header("Location: read.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
<div class="card shadow">
<div class="card-header"><h3>Edit Data</h3></div>
<div class="card-body">

<?php if($error != ""): ?>
<div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<form method="POST">
    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" value="<?= xor_encrypt($data['nama']) ?>" required>
    </div>
    <div class="mb-3">
        <label>Alamat</label>
        <input type="text" name="alamat" class="form-control" value="<?= xor_encrypt($data['alamat']) ?>" required>
    </div>

    <button type="submit" name="submit" class="btn btn-primary">Perbarui</button>
    <a href="read.php" class="btn btn-secondary">Kembali</a>
</form>

</div></div></div>

</body>
</html>