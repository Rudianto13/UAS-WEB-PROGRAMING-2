<?php
// Sambungkan ke database Anda di sini
$conn = new mysqli("localhost", "root", "", "umbiwa");

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $berita_id = $_GET['id'];

    // Hapus data berita
    $sql = "DELETE FROM news WHERE id=$berita_id";

    if ($conn->query($sql) === TRUE) {
        echo "Berita berhasil dihapus!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "ID berita tidak ditemukan.";
}

// Tutup koneksi
$conn->close();
?>
