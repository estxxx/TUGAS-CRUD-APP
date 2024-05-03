<?php

include_once 'model/post_model.php';
include_once 'config/conn.php';

class PostController {

    static function index()
    {

      global $conn;
      $sql = "SELECT * FROM tbposts";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {

          view('post/index', [
            'result' => $result
          ]);
      } else {
          echo "<tr><td colspan='6'>Tidak ada data</td></tr>";
      }


      // Menutup koneksi
      $conn->close();
    }
    static function add() {
        if (!isset($_SESSION['user'])) {
            header('Location: '.BASEURL.'login?auth=false');
            exit;
        }
        else {
            view('dash_page/layout', ['url' => 'view/contact_crud_page/add']);
        }
    }

    static function store() {
      global $conn;
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
          if (move_uploaded_file($image_temp, 'public/img/' . $image_name)) {
              // Jika berhasil menyimpan gambar, lanjutkan penyimpanan data ke database
              // Menyimpan data ke dalam database
              $sql = "INSERT INTO tbposts (post_id, title, content, date, category, image) VALUES ('$post_id', '$title', '$content', '$date', '$category', '$image_name')";
              if ($conn->query($sql) === TRUE) {
                  header('Location: '.BASEURL.'dashboard');
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
    }

    static function edit()
    {
      global $conn;
      // Validate and sanitize post_id from URL parameter
      $post_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

      if ($post_id <= 0) {
          // Invalid or missing post_id, handle the error accordingly (e.g., redirect to an error page)
          echo "Invalid post ID.";
          exit;
      }

      // Query to get the post data for editing
      $query = "SELECT * FROM tbposts WHERE post_id = ?";
      $stmt = $conn->prepare($query);
      $stmt->bind_param("i", $post_id);
      $stmt->execute();
      $result = $stmt->get_result();

      view('post/edit', [
        'result' => $result
    ]);
    }

    static function update() {
      $query = "UPDATE tbposts SET title=?, content=?, date=?, category=? , image=? WHERE post_id=?";

      global $conn;
      // Validate and sanitize post_id from URL parameter
      $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
      $title = isset($_POST['title']) ? htmlspecialchars ($_POST['title']) : '';
      $content = isset($_POST['content']) ? htmlspecialchars ($_POST['content']) : '';
      $date = isset($_POST['date']) ? htmlspecialchars ($_POST['date']) : '';
      $category = isset($_POST['category']) ? htmlspecialchars ($_POST['category']) : '';
      
      if ($post_id <= 0) {
          // Invalid or missing post_id, handle the error accordingly (e.g., redirect to an error page)
          echo "Invalid post ID.";
          exit;
      }
      if (isset($_FILES['new_image']['error']) && $_FILES['new_image']['error'] === UPLOAD_ERR_OK) {
        // Jika file gambar diunggah dengan benar, lanjutkan proses penyimpanan
        $image_name = $_FILES['new_image']['name']; // Nama file gambar
        $image_temp = $_FILES['new_image']['tmp_name']; // Path sementara file gambar
    
        // Pindahkan file gambar dari path sementara ke direktori yang diinginkan
        if (move_uploaded_file($image_temp, 'public/img/' . $image_name)) {
            // Jika berhasil menyimpan gambar, lanjutkan penyimpanan data ke database
            // Menyimpan data ke dalam database
            $query = "UPDATE tbposts SET title=?, content=?, date=?, category=? , image=? WHERE post_id=?";
      $stmt = $conn->prepare($query);
      $stmt->bind_param("sssssi", $title, $content, $date, $category, $image_name, $post_id);
      
      if ($stmt->execute()) {
          // If update successful, redirect back to dashboard or another appropriate page
          header('Location: '.BASEURL.'dashboard');
          exit;
      } else {
          // If update failed, display an error message
          echo "Error updating post: " . $stmt->error;
      }
      
      $stmt->close();
      $conn->close();
        } else {
            // Jika gagal menyimpan gambar, tampilkan pesan error
            echo "Error: Gagal menyimpan gambar.";
        }
      } else {
        // Jika terjadi kesalahan saat mengunggah file gambar, tampilkan pesan error
        echo "Error: Terjadi kesalahan saat mengunggah file gambar.";
      }
      
      // Update the post using prepared statement
      
  }

    static function destroy() {
      global $conn;
      // Validate and sanitize post_id from URL parameter
      $post_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
      
      // Check if post_id is valid
      if ($post_id <= 0) {
          // Invalid or missing post_id, handle the error accordingly
          echo "Invalid post ID.";
          exit;
      }
      
      // Query to delete the post
      $query = "DELETE FROM tbposts WHERE post_id = $post_id";
      
      // Execute the query
      $result = mysqli_query($conn, $query);
      
      // Check if deletion was successful
      if ($result) {
          // Redirect back to the dashboard or another appropriate page
          header('Location: '.BASEURL.'dashboard');
          exit;
      } else {
          // If deletion failed, display an error message
          echo "Error: " . mysqli_error($conn);
      }
    }
}