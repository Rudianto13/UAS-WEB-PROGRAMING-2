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
// Tangkap data dari form tambah berita
$judul = $_POST['judul'];
$berita = $_POST['berita'];
$deskripsi = $_POST['deskripsi'];

// Tangkap data gambar
$gambar = $_FILES['gambar']['name'];
$gambar_tmp = $_FILES['gambar']['tmp_name'];
$gambar_path = "uploads/" . $gambar;

// Pindahkan gambar ke folder uploads
move_uploaded_file($gambar_tmp, $gambar_path);

// Simpan data ke database
$sql = "INSERT INTO news (title, content, description, image_url) VALUES ('$judul', '$berita', '$deskripsi', '$gambar_path')";
if ($conn->query($sql) === TRUE) {
    echo "Berita berhasil ditambahkan!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Tutup koneksi
$conn->close();
?>
