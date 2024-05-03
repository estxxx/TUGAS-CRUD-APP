<?php

include_once 'model/registrasi_model.php';
include_once 'config/conn.php';

Class RegisterController{
  static function register()
  {
    global $conn;
        if(isset($_POST['username'], $_POST['email'], $_POST['password'], $_POST['confirm_password'])) {
            // Inisialisasi variabel
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
        
            // Validasi input (misalnya, apakah password dan konfirmasi password cocok)
            if ($password !== $confirm_password) {
                echo "Password dan konfirmasi password tidak cocok";
                exit();
            }
        
            // Enkripsi password sebelum disimpan ke database
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
            // Siapkan dan jalankan query untuk menyimpan data pengguna ke dalam tabel users
            $stmt = $conn->prepare("INSERT INTO registrasi (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $hashed_password);
        
            if ($stmt->execute()) {
                // Registrasi berhasil, redirect ke halaman login.php
                header('Location: '.BASEURL.'');
                exit;
            } else {
                echo "Terjadi kesalahan saat mendaftar, silakan coba lagi.";
            }
            $stmt->close();
        } else {
            // Jika data yang diperlukan tidak terkirim, tampilkan pesan error
            echo "Mohon lengkapi semua data yang diperlukan";
        }
        
        // Tutup koneksi ke database
        $conn->close();
  }
}