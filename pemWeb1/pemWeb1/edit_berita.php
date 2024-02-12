<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Berita</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Berita</h2>
        <?php
            // Sambungkan ke database dan ambil data berita berdasarkan ID
            $conn = new mysqli("localhost", "root", "", "umbiwa");

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if (isset($_GET['id'])) {
                $berita_id = $_GET['id'];
                $sql = "SELECT * FROM news WHERE id = $berita_id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo "<form action='proses_edit_berita.php?id={$row['id']}' method='post' enctype='multipart/form-data'>
                            <!-- Form edit berita disini -->
                            <div class='mb-3'>
                                <label for='judul' class='form-label'>Judul</label>
                                <input type='text' class='form-control' id='judul' name='judul' value='{$row['title']}' required>
                            </div>
                            <div class='mb-3'>
                                <label for='berita' class='form-label'>Berita</label>
                                <textarea class='form-control' id='berita' name='berita' rows='4' required>{$row['content']}</textarea>
                            </div>
                            <div class='mb-3'>
                                <label for='deskripsi' class='form-label'>Deskripsi</label>
                                <textarea class='form-control' id='deskripsi' name='deskripsi' rows='2'>{$row['description']}</textarea>
                            </div>
                            <div class='mb-3'>
                                <label for='gambar' class='form-label'>Gambar</label>
                                <input type='file' class='form-control' id='gambar' name='gambar'>
                            </div>
                            <button type='submit' class='btn btn-primary'>Simpan Perubahan</button>
                        </form>";
                } else {
                    echo "<p>Data berita tidak ditemukan.</p>";
                }
            } else {
                echo "<p>ID berita tidak ditemukan.</p>";
            }

            $conn->close();
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
