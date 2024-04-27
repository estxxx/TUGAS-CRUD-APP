<?php
// Memasukkan file koneksi.php yang berisi konfigurasi koneksi database
require 'db_connection.php';

// Memeriksa jika method yang digunakan adalah POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Menerima data dari formulir
    $post_id = $_POST['post_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $date = $_POST['date'];
    $category = $_POST['category'];
    
 // Memeriksa apakah file gambar telah diunggah dengan benar
if (isset($_FILES['image']['error']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    // Jika file gambar diunggah dengan benar, lanjutkan proses penyimpanan
    $image_name = $_FILES['image']['name']; // Nama file gambar
    $image_temp = $_FILES['image']['tmp_name']; // Path sementara file gambar

    // Pindahkan file gambar dari path sementara ke direktori yang diinginkan
    if (move_uploaded_file($image_temp, 'img/' . $image_name)) {
        // Jika berhasil menyimpan gambar, lanjutkan penyimpanan data ke database
        // Menyimpan data ke dalam database
        $sql = "INSERT INTO tbposts (post_id, title, content, date, category, image) VALUES ('$post_id', '$title', '$content', '$date', '$category', '$image_name')";
        if ($conn->query($sql) === TRUE) {
            echo "Data berhasil ditambahkan ke database";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // Jika gagal menyimpan gambar, tampilkan pesan error
        echo "Error: Gagal menyimpan gambar.";
    }
} else {
    // Jika terjadi kesalahan saat mengunggah file gambar, tampilkan pesan error
    echo "Error: Terjadi kesalahan saat mengunggah file gambar.";
}


}
?>
