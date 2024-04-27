<?php
// Include the database connection file
include 'db_connection.php';

// Validate and sanitize post_id from URL parameter
$post_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($post_id <= 0) {
    // Invalid or missing post_id, handle the error accordingly (e.g., redirect to an error page)
    echo "Invalid post ID.";
    exit;
}

// Query to get the post data for editing
$query = "SELECT * FROM tbposts WHERE post_id = $post_id";
$result = mysqli_query($conn, $query);

// Check if data is found
if ($result && mysqli_num_rows($result) > 0) {
    // Get the post data
    $row = mysqli_fetch_assoc($result);
    $post_id = $row['post_id'];
    $title = $row['title'];
    $content = $row['content'];
    $date = $row['date'];
    $category = $row['category'];
    $image = $row['image'];

    // Display the form for editing the post
    ?>
    <h1>Edit Post</h1>
    <form method="post" action="update_post.php" enctype="multipart/form-data">
        <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
        <input type="text" name="title" value="<?php echo $title; ?>" placeholder="Judul" required><br>
        <textarea name="content" placeholder="Konten" required><?php echo $content; ?></textarea><br>
        <input type="date" name="date" value="<?php echo $date; ?>" placeholder="Tanggal Posting" required><br>
        <input type="text" name="category" value="<?php echo $category; ?>" placeholder="Kategori" required><br>
        <!-- Input for image upload -->
        <input type="file" name="new_image" accept="image/*"><br> <!-- Use appropriate file input for uploading new image -->
        <!-- Preview current image -->
        <?php if ($image): ?>
            <img src="img/<?php echo $image; ?>" style="max-width: 100px;"><br>
        <?php endif; ?>
        <input type="submit" value="Simpan">
    </form>
    <?php
} else {
    // If data is not found, display an error message
    echo "Data not found.";
}
?>
