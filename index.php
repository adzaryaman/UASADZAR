<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
<title>BOOKKHOUSE</title>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <span class="navbar-brand mb-0 h1">BOOKHOUSESTROE</span>
    </nav>
    <div class="container">
        <br>
        <h4><center>DAFTAR BUKU</center></h4>
        <?php
            include "koneksi.php";

            // Cek apakah ada kiriman form dari method get
            if (isset($_GET['id_buku'])) {
                $id = htmlspecialchars($_GET["id_buku"]);

                $sql = "DELETE FROM perpustakaan WHERE id_buku='$id'";
                $hasil = mysqli_query($kon, $sql);

                // Kondisi apakah berhasil atau tidak
                if ($hasil) {
                    header("Location:index.php");
                } else {
                    echo "<div class='alert alert-danger'> Data Gagal dihapus.</div>";
                }
            }
        ?>

        <table class="my-3 table table-bordered">
            <thead>
                <tr class="table-primary">
                    <th>id</th>
                    <th>judul_buku</th>
                    <th>author</th>
                    <th>published_year</th>
                    <th>isbn</th>
                    <th>Alamat</th>
                    <th colspan='2'>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM book ORDER BY id_buku DESC";
                $hasil = mysqli_query($kon, $sql);

                // Periksa apakah query berhasil dieksekusi
                if ($hasil === false) {
                    die('Error in the query: ' . mysqli_error($kon));
                }

                $no = 0;

                // Periksa apakah ada baris data yang diambil
                if (mysqli_num_rows($hasil) > 0) {
                    while ($data = mysqli_fetch_array($hasil)) {
                        $no++;
                        // Proses data sesuai kebutuhan, contohnya:
                        echo "<tr>";
                        echo "<td>" . $no . "</td>";
                        echo "<td>" . $data['id_buku'] . "</td>";
                        echo "<td>" . $data['judul_buku'] . "</td>";
                        echo "<td>" . $data['author'] . "</td>";
                        echo "<td>" . $data['published_year'] . "</td>";
                        echo "<td>" . $data['isbn'] . "</td>";
                        // ... (lanjutkan dengan data lainnya)
                        echo "<td>";
                        echo "<a href='update.php?id_buku=" . htmlspecialchars($data['id_buku']) . "' class='btn btn-warning' role='button'>Update</a>";
                        echo "<a href='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "?id_buku=" . $data['id_buku'] . "' class='btn btn-danger' role='button'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    // Tidak ada data yang ditemukan
                    echo '<tr><td colspan="7">Tidak ada data ditemukan.</td></tr>';
                }
                ?>
            </tbody>
        </table>
        <a href="create.php" class="btn btn-primary" role="button">Tambah Data</a>
    </div>
</body>
</html>