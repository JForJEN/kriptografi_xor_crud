<?php 
include 'db.php';
include 'functions.php';

$search = "";
$where = "";

if (isset($_GET['search']) && $_GET['search'] != "") {
    $search = $_GET['search'];
}

$limit = 5; 
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

$sql = "SELECT * FROM users LIMIT $start, $limit";
$result = mysqli_query($conn, $sql);

$total_data = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users"));
$total_pages = ceil($total_data / $limit);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
<div class="card shadow">
<div class="card-header"><h3>Data Users</h3></div>
<div class="card-body">

<form method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Cari nama / alamat..." value="<?= $search ?>">
        <button class="btn btn-primary">Cari</button>
    </div>
</form>

<table class="table table-bordered table-striped">
<tr>
    <th>ID</th>
    <th>Nama</th>
    <th>Alamat</th>
    <th>Aksi</th>
</tr>

<?php 
while ($row = mysqli_fetch_assoc($result)):
    $nama_de = xor_encrypt($row['nama']);
    $alamat_de = xor_encrypt($row['alamat']);

    if ($search != "" && stripos($nama_de . " " . $alamat_de, $search) === false)
        continue;
?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= $nama_de ?></td>
    <td><?= $alamat_de ?></td>
    <td>
        <a href="update.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
        <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data?');">Hapus</a>
    </td>
</tr>
<?php endwhile; ?>

</table>

<nav>
<ul class="pagination">

<?php if($page > 1): ?>
<li class="page-item"><a class="page-link" href="?page=<?= $page-1 ?>&search=<?= $search ?>">Previous</a></li>
<?php endif; ?>

<?php for($i=1; $i<=$total_pages; $i++): ?>
<li class="page-item <?= ($i==$page?'active':'') ?>">
    <a class="page-link" href="?page=<?= $i ?>&search=<?= $search ?>"><?= $i ?></a>
</li>
<?php endfor; ?>

<?php if($page < $total_pages): ?>
<li class="page-item"><a class="page-link" href="?page=<?= $page+1 ?>&search=<?= $search ?>">Next</a></li>
<?php endif; ?>

</ul>
</nav>

</div></div></div>

</body>
</html>