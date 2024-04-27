<?php
require 'db_connection.php';

// Terima data dari formulir
$post_id = $_POST['post_id'];
$title = $_POST['title'];
$content = $_POST['content'];
$date = $_POST['date'];
$category = $_POST['category'];
$image = $_POST['image'];

// Ambil nama file gambar
$nama_file = $_FILES['image']['name'];

// Lokasi penyimpanan file gambar
$lokasi = 'image/';

// Upload file gambar ke folder uploads
if(move_uploaded_file($_FILES['image']['tmp_name'], $lokasi.$nama_file)){
    // File berhasil diunggah, masukkan data ke dalam tabel film
    $query = "INSERT INTO tbposts (post_id, title, content, date, category, image) VALUES ('$post_id', '$title', '$content', '$date', '$category', '$image', '$nama_file')";

    if (mysqli_query($conn, $query)) {
        // Data berhasil disimpan, tampilkan alert
        echo '<script>alert("Data berhasil ditambahkan ke database.");</script>';
        // Redirect kembali ke halaman tambah
        echo '<script>window.location.href = "dashboard.php";</script>';
    } else {
        echo "Gagal menambahkan data ke database: " . mysqli_error($conn);
    }
} else {
        // Data berhasil disimpan, tampilkan alert
        echo '<script>alert("Isi Semua Data");</script>';
        // Redirect kembali ke halaman tambah
        echo '<script>window.location.href = "tambahdatadb.php";</script>';
}

?>