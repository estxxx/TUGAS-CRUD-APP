<?php
// Include the database connection file
include 'db_connection.php';

// Memeriksa jika method yang digunakan adalah POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Menerima data dari formulir
    $post_id = $_POST['post_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $date = $_POST['date'];
    $category = $_POST['category'];
    
    // Memeriksa apakah file gambar baru telah diunggah dengan benar
    if (isset($_FILES['new_image']['error']) && $_FILES['new_image']['error'] === UPLOAD_ERR_OK) {
        // Jika file gambar diunggah dengan benar, lanjutkan proses penyimpanan
        $image_name = $_FILES['new_image']['name']; // Nama file gambar baru
        $image_temp = $_FILES['new_image']['tmp_name']; // Path sementara file gambar baru

        // Pindahkan file gambar baru dari path sementara ke direktori yang diinginkan
        if (move_uploaded_file($image_temp, 'img/' . $image_name)) {
            // Hapus gambar lama jika ada
            $query_select_old_image = "SELECT image FROM tbposts WHERE post_id = $post_id";
            $result_select_old_image = mysqli_query($conn, $query_select_old_image);
            $old_image_row = mysqli_fetch_assoc($result_select_old_image);
            $old_image = $old_image_row['image'];
            if ($old_image && file_exists('img/' . $old_image)) {
                unlink('img/' . $old_image);
            }
            // Perbarui data dalam database, termasuk gambar baru
            $sql = "UPDATE tbposts SET title='$title', content='$content', date='$date', category='$category', image='$image_name' WHERE post_id=$post_id";
            if ($conn->query($sql) === TRUE) {
                // Jika berhasil memperbarui data dan gambar, arahkan kembali ke halaman dashboard
                header("Location: dashboard.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            // Jika gagal menyimpan gambar baru, tampilkan pesan error
            echo "Error: Gagal menyimpan gambar baru.";
        }
    } else {
        // Jika tidak ada file gambar baru diunggah, lanjutkan proses penyimpanan tanpa memperbarui gambar
        // Perbarui data dalam database tanpa menyertakan gambar baru
        $sql = "UPDATE tbposts SET title='$title', content='$content', date='$date', category='$category' WHERE post_id=$post_id";
        if ($conn->query($sql) === TRUE) {
            // Jika berhasil memperbarui data tanpa gambar, arahkan kembali ke halaman dashboard
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>
