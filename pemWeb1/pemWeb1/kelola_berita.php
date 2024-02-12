<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Berita</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Kelola Berita</h2>
        <a href="tambah_berita.php" class="btn btn-primary mb-3">Tambah Berita</a>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Berita</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Sambungkan ke database Anda di sini
                    $conn = new mysqli("localhost", "root", "", "umbiwa");
                    
                    // Periksa koneksi
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Ambil data dari tabel berita
                    $sql = "SELECT * FROM news";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['title']}</td>
                                    <td>{$row['content']}</td>
                                    <td>{$row['description']}</td>
                                    <td><img src='{$row['image_url']}' alt='Gambar' width='50'></td>
                                    <td>
                                        <a href='edit_berita.php?id={$row['id']}' class='btn btn-warning'>Edit</a>
                                        <a href='hapus_berita.php?id={$row['id']}' class='btn btn-danger'>Hapus</a>
                                    </td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>Tidak ada berita.</td></tr>";
                    }

                    // Tutup koneksi
                    $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
