<?php
// Include the database connection file
include 'db_connection.php';

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
    header("Location: dashboard.php");
    exit;
} else {
    // If deletion failed, display an error message
    echo "Error: " . mysqli_error($conn);
}
?>
