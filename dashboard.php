<?php
session_start();
$_SESSION['nama'] = 'admin';
include 'koneksi.php';

if (isset($_GET['hapus_id'])) {
    if (isset($_SESSION['nama']) && $_SESSION['nama'] === 'admin') {
        $id_hapus = $_GET['hapus_id'];
        mysqli_query($koneksi, "DELETE FROM users WHERE id = '$id_hapus'");
        
        header("Location: dashboard.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Halaman Dashboard</h1>

    <?php if (isset($_SESSION['nama']) && $_SESSION['nama'] === 'admin'): ?>
        <h3>Tabel Manajemen Data (Khusus Admin)</h3>
        <table border="1" cellpadding="5">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
            <?php
            $query = mysqli_query($koneksi, "SELECT id, nama FROM users");
            while ($data = mysqli_fetch_assoc($query)) {
            ?>
                <tr>
                    <td><?php echo $data['id']; ?></td>
                    <td><?php echo $data['nama']; ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $data['id']; ?>">Edit</a> | 
                        <a href="dashboard.php?hapus_id=<?php echo $data['id']; ?>" onclick="return confirm('Hapus data ini?');">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </table>

    <?php else: ?>
        <h3>Dashboard Reguler</h3>
        <p>Selamat datang! Anda login bukan sebagai admin, sehingga fitur manajemen disembunyikan.</p>
    <?php endif; ?>

</body>
</html>
