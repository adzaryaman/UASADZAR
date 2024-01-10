<!DOCTYPE html>
<html>
<head>
    <title>Form Pendaftaran Anggota</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <?php

    // Include file koneksi, untuk koneksikan ke database
    include "koneksi.php";

    // Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Cek apakah ada nilai yang dikirim menggunakan method GET dengan nama id_buku
    if (isset($_GET['id_buku'])) {
        $id_buku = input($_GET["id_buku"]);

        // Query ambil data dari tabel buku berdasarkan id_buku
        $sql = "SELECT * FROM book WHERE 1 id_buku = $id_buku";
        $hasil = mysqli_query($kon, $sql);

        // Mengambil data sebagai asosiatif array
        $data = mysqli_fetch_assoc($hasil);
    }

    // Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id_buku = htmlspecialchars($_POST["id_buku"]);
        $judul_buku = input($_POST["judul_buku"]);
        $author = input($_POST["author"]);
        $published_year = input($_POST["published_year"]);
        $isbn = input($_POST["isbn"]);

        // Query update data pada tabel buku
        // Ganti "buku" dengan nama tabel yang benar
         $sql = "UPDATE book SET
          id_buku='$id_buku',
          judul_buku='$judul_buku',
          author='$author',
          publisher_year='$published_year',
          isbn='$isbn'
          WHERE id_buku=$id_buku";


        // Mengeksekusi atau menjalankan query diatas
        $hasil = mysqli_query($kon, $sql);

        // Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:index.php");
            exit;
        } else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan. Error: " . mysqli_error($kon) . "</div>";
        }
    }

    ?>
    <h2>Update Data</h2>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="form-group">
            <label>id:</label>
            <input type="text" name="id_buku" class="form-control" placeholder="Masukkan id" required value="<?php echo $data['id_buku']; ?>" />
        </div>
        <div class="form-group">
            <label>judul buku:</label>
            <input type="text" name="judul_buku" class="form-control" placeholder="Masukkan judul" required value="<?php echo $data['judul_buku']; ?>"/>
        </div>
        <div class="form-group">
            <label>author :</label>
            <input type="text" name="author" class="form-control" placeholder="Masukkan author" required value="<?php echo $data['author']; ?>"/>
        </div>
        <div class="form-group">
            <label>publisher:</label>
            <input type="text" name="published_year" class="form-control" placeholder="Masukkan published" required value="<?php echo $data['publisher_year']; ?>"/>
        </div>
        <div class="form-group">
            <label>isbn:</label>
            <textarea name="isbn" class="form-control" rows="5" placeholder="Masukkan isbn" required><?php echo $data['isbn']; ?></textarea>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>