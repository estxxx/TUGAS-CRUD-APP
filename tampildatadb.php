<?php
// Sertakan file koneksi database
include 'db_connection.php';

// Query untuk mengambil data dari tabel tbposts
$sql = "SELECT * FROM tbposts";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data dari setiap baris
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["post_id"] . "</td>";
        echo "<td>" . $row["title"] . "</td>";
        echo "<td>" . $row["content"] . "</td>";
        echo "<td>" . $row["date"] . "</td>";
        echo "<td>" . $row["category"] . "</td>";
        echo "<td>" . $row["image"] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>Tidak ada data</td></tr>";
}

// Menutup koneksi
$conn->close();
?>