<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMBiwa - Perusahaan Inovatif</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<section class="container mt-4 berita-section">
    <h2 class="text-center">Berita Terbaru UMBiwa</h2>
    <div class="row">
        <?php
        // Sambungkan ke database Anda
        $conn = new mysqli("localhost", "root", "", "umbiwa");

        // Periksa koneksi
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Ambil data berita dari database
        $sql = "SELECT * FROM news ORDER BY created_at DESC";
        $result = $conn->query($sql);

        // Periksa apakah ada berita yang diambil
        if ($result->num_rows > 0) {
            // Loop untuk setiap berita
            while ($row = $result->fetch_assoc()) {
                echo '<div class="col-md-6">';
                echo '<div class="card">';
                echo '<img src="' . $row['image_url'] . '" class="card-img-top" alt="' . $row['title'] . '">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $row['title'] . '</h5>';
                echo '<p class="card-text">' . $row['content'] . '</p>';
                echo '<a href="#" class="btn btn-primary">Baca Selengkapnya</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>Tidak ada berita yang ditemukan.</p>';
        }

        // Tutup koneksi
        $conn->close();
        ?>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>