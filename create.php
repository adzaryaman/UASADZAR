<!DOCTYPE html>
<html>
<head>
    <title>Form Pendaftaran Buku</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <?php
    include "koneksi.php";

    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_buku = input($_POST["id_buku"]);
        $judul_buku = input($_POST["judul_buku"]);
        $author = input($_POST["author"]);
        $published_year = input($_POST["published_year"]);
        $isbn = input($_POST["isbn"]);

        $sql = "INSERT INTO book (id_buku, judul_buku, author, published_year, isbn) VALUES ('$id_buku', '$judul_buku', '$author', '$published_year', '$isbn')";

        $hasil = mysqli_query($kon, $sql);

        if ($hasil) {
            header("Location: index.php");
            exit;
        } else {
            // Menampilkan pesan kesalahan rinci
            echo "<div class='alert alert-danger'> Gagal menyimpan data. Error: " . mysqli_error($kon) . "</div>";
        }
    }
    ?>

    <h2>Input Data</h2>

    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        <div class="form-group">
            <label>Id Buku:</label>
            <input type="text" name="id_buku" class="form-control" placeholder="Masukkan Id Buku" required />
        </div>
        <div class="form-group">
            <label>Judul:</label>
            <input type="text" name="judul_buku" class="form-control" placeholder="Masukkan Judul Buku" required/>
        </div>
        <div class="form-group">
            <label>Author:</label>
            <input type="text" name="author" class="form-control" placeholder="Masukkan Author" required/>
        </div>
        <div class="form-group">
            <label>Publisher:</label>
            <input type="text" name="published_year" class="form-control" placeholder="Masukkan Published Year" required/>
        </div>
        <div class="form-group">
            <label>ISBN:</label>
            <textarea name="isbn" class="form-control" rows="5" placeholder="Masukkan ISBN" required></textarea>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>
