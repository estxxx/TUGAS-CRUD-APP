<?php


// Check if data is found
if ($result && $result->num_rows > 0) {
    // Get the post data
    $row = $result->fetch_assoc();
    $post_id = $row['post_id'];
    $title = htmlspecialchars ($row['title']);
    $content = htmlspecialchars ($row['content']);
    $date = $row['date'];
    $category = htmlspecialchars ($row['category']);
    $image = htmlspecialchars ($row['image']);

    // Display the form for editing the post
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Post</title>
        <style>
            @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap");

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: "Poppins", sans-serif;
            }
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #F8E6E8;
            }
            .container {
                max-width: 600px;
                margin: 20px auto;
                padding: 20px;
                background-color: rgb(255, 190, 201);
                border-radius: 8px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            }
            h1 {
                margin-top: 0;
                color: #333;
            }
            input[type="text"],
            input[type="date"],
            textarea {
                width: 100%;
                padding: 10px;
                margin-bottom: 10px;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }
            input[type="file"] {
                margin-top: 10px;
            }
            img {
                max-width: 100px;
                margin-bottom: 10px;
            }
            input[type="submit"] {
                padding: 10px 20px;
                background-color: rgb(73, 17, 70);
                color: white;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }
            input[type="submit"]:hover {
                background-color: #45a049;
            }
        </style>
    </head>
    <body>
    <div class="container">
        <h1>Edit Post</h1>
        <form method="post" action="<?= urlpath("post/update?id=".$post_id); ?>" enctype="multipart/form-data">
            <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
            <input type="text" name="title" value="<?php echo $title; ?>" placeholder="Judul" required><br>
            <textarea name="content" placeholder="Konten" required><?php echo $content; ?></textarea><br>
            <input type="date" name="date" value="<?php echo $date; ?>" placeholder="Tanggal Posting" required><br>
            <input type="text" name="category" value="<?php echo $category; ?>" placeholder="Kategori" required><br>
            <!-- Input for image upload -->
            <input type="file" name="new_image" accept="image/*"><br> <!-- Use appropriate file input for uploading new image -->
            <!-- Preview current image -->
            <?php if ($image): ?>
                <img src="../public/img/<?php echo $image; ?>" alt="Current Image">
            <?php endif; ?><br>
            <input type="submit" value="Simpan">
        </form>
    </div>
    </body>
    </html>
    <?php
} else {
    // If data is not found, display an error message
    echo "Data not found.";
}
?>
