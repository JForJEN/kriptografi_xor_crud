<?php 
include 'db.php';

$logs = mysqli_query($conn, "SELECT * FROM logs ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Log Enkripsi & Dekripsi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
<div class="card shadow">
<div class="card-header bg-dark text-white">
    <h3 class="mb-0">Log Enkripsi & Dekripsi</h3>
</div>
<div class="card-body">

<a href="index.php" class="btn btn-secondary mb-3">Kembali ke Menu</a>

<table class="table table-bordered table-striped">
    <tr class="table-dark">
        <th>ID</th>
        <th>Aksi</th>
        <th>Plaintext</th>
        <th>Ciphertext</th>
        <th>Waktu</th>
    </tr>

    <?php while($row = mysqli_fetch_assoc($logs)): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><span class="badge bg-primary"><?= $row['action'] ?></span></td>
        <td><?= htmlspecialchars($row['plaintext']) ?></td>
        <td><?= htmlspecialchars($row['ciphertext']) ?></td>
        <td><?= $row['created_at'] ?></td>
    </tr>
    <?php endwhile; ?>
</table>

</div></div></div>

</body>
</html>