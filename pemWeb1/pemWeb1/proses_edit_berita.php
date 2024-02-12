<?php
// Sambungkan ke database Anda di sini
$conn = new mysqli("localhost", "root", "", "umbiwa");

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$upload_directory = 'uploads/';
if (!is_dir($upload_directory)) {
    // Jika belum ada, buat direktori 'uploads'
    if (!mkdir($upload_directory, 0777, true)) {
        die('Failed to create upload directory');
    }
}

if (isset($_GET['id'])) {
    $berita_id = $_GET['id'];

    // Tangkap data dari form edit berita
    $judul = $_POST['judul'];
    $berita = $_POST['berita'];
    $deskripsi = $_POST['deskripsi'];

    // Tangkap data gambar (jika ada perubahan)
    if ($_FILES['gambar']['name'] != "") {
        $gambar = $_FILES['gambar']['name'];
        $gambar_tmp = $_FILES['gambar']['tmp_name'];
        $gambar_path = "uploads/" . $gambar;

        // Pindahkan gambar ke folder uploads
        move_uploaded_file($gambar_tmp, $gambar_path);

        // Update data berita dengan gambar baru
        $sql = "UPDATE news SET title='$judul', content='$berita', description='$deskripsi', image_url='$gambar_path' WHERE id=$berita_id";
    } else {
        // Update data berita tanpa mengubah gambar
        $sql = "UPDATE news SET title='$judul', content='$berita', description='$deskripsi' WHERE id=$berita_id";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Berita berhasil diupdate!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "ID berita tidak ditemukan.";
}

// Tutup koneksi
$conn->close();
?>
