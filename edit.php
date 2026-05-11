<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['nama']) || $_SESSION['nama'] !== 'admin' || !isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$id_user = $_GET['id'];

if (isset($_POST['update'])) {
    $nama_baru = $_POST['nama'];
    $password_baru_hashed = password_hash($_POST['password_baru'], PASSWORD_DEFAULT);
    
    $query_update = "UPDATE users SET nama = '$nama_baru', password = '$password_baru_hashed' WHERE id = '$id_user'";
    $hasil_update = mysqli_query($koneksi, $query_update);

    if ($hasil_update) {
        header("Location: dashboard.php");
        exit;
    }
}

$query_lama = mysqli_query($koneksi, "SELECT * FROM users WHERE id = '$id_user'");
$data_lama = mysqli_fetch_assoc($query_lama);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Pengguna</title>
</head>
<body>
    <h2>Edit Data Pengguna</h2>

    <form action="" method="POST">
        <label>Nama:</label><br>
        <input type="text" name="nama" value="<?php echo $data_lama['nama']; ?>" required>
        <br><br>

        <label>Password Baru:</label><br>
        <input type="password" name="password_baru" required>
        <br><br>

        <button type="submit" name="update">Simpan Perubahan</button>
    </form>
</body>
</html>
