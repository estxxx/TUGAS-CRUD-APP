<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ima Listiatus Sa'diyah - 3055</title>
    <link rel="stylesheet" href="./public/style/style-dashboard.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div class="sidebar">
        <div class="logo">
            <ul class="menu">
                <li class="active">
                    <a href="#">
                        <i class='bx bxs-tachometer'></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class='bx bx-user-circle'></i>
                        <span>Profile</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class='bx bx-calendar-alt'></i>
                        <span>Schedule</span>
                    </a>
                </li>
                <li class="logout">
                    <a href="index.php" id="logout-btn">
                        <i class='bx bxs-door-open' ></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="container">
        <h1>Blog's Schedule</h1>
        <button id="add-post-btn"><i class='bx bx-plus-circle' ></i></button>
        <table id="post-table">
            <thead>
                <tr>
                    <th>ID Post</th>
                    <th>Judul</th>
                    <th>Konten</th>
                    <th>Tanggal Posting</th>
                    <th>Kategori</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <?php

            // Check if query is successful
            if ($result) {
                // Display data
                while ($row = mysqli_fetch_assoc($result)) {
                    // Access data from $row and display it in HTML
                    echo "<tr>";
                    echo "<td>" . $row['post_id'] . "</td>";
                    echo "<td>" . $row['title'] . "</td>";
                    echo "<td>" . $row['content'] . "</td>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>" . $row['category'] . "</td>";
                    echo "<td><img src='public/img/". $row['image'] . "'></td>";
                    echo "<td>";
                    echo "<a href='post/edit?id=" . $row["post_id"] . "' class='btn-edit' data-id='" . $row["post_id"] . "'><i class='bx bxs-edit'></i></a>";
                    echo " | ";
                    echo "<a href='post/delete?id=" . $row["post_id"] . "' class='btn-delete'  data-id='" . $row["post_id"] . "'><i class='bx bxs-trash-alt'></i></a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                // If query fails, display error message
                echo "Error: " . mysqli_error($conn);
            }
            ?>
            <tbody id="post-list">
                <!-- Data post akan dimasukkan disini -->
            </tbody>
        </table>
    </div>

    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 id="modal-title"></h2>
            <form id="post-form" action="<?= urlpath('post/create'); ?>" method="POST" enctype="multipart/form-data">
                <input type="text" name="post_id" id="post_id" placeholder="ID Post" required> <!-- Perubahan di sini -->
                <input type="text" name="title" id="title" placeholder="Judul" required>
                <input type="text" name="content" id="content" placeholder="Konten" required>
                <input type="date" name="date" id="date" placeholder="Tanggal Posting" required>
                <input type="text" name="category" id="category" placeholder="Kategori" required>
                <input type="file" name="image" id="image" accept="uploads/*" required>
                <img id="image-preview" src="" style="max-width: 300px;">
                <button type="submit" id="submit-post-btn">Simpan</button>
            </form>
        </div>
    </div>



    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('modal');
        const modalTitle = document.getElementById('modal-title');
        const postForm = document.getElementById('post-form');
        const addPostBtn = document.getElementById('add-post-btn');
        const closeBtn = document.querySelector('.close');

        function openModal(title) {
            modal.style.display = 'block';
            modalTitle.innerText = title;
        }

        function closeModal() {
            modal.style.display = 'none';
            postForm.reset();
        }

        // Event listener untuk membuka modal saat tombol tambah data ditekan
        addPostBtn.addEventListener('click', function () {
            openModal('Tambah Data');
        });

        // Event listener untuk menutup modal saat tombol close ditekan
        closeBtn.addEventListener('click', function () {
            closeModal();
        });

        // Event listener untuk menutup modal saat user mengklik di luar modal
        window.addEventListener('click', function (event) {
            if (event.target == modal) {
                closeModal();
            }

            
        });

        // Event listener untuk submit form
        // postForm.addEventListener('submit', function (event) {
        //     event.preventDefault();
            
        //     // Lakukan kirim data ke server menggunakan teknik AJAX
        //     // Misalnya, Anda dapat menggunakan fetch API atau XMLHttpRequest

        //     // Ambil data dari form
        //     const formData = new FormData(postForm);

        //     // Kirim data ke server menggunakan fetch API
        //     fetch('/post/create', {
        //         method: 'POST',
        //         body: formData
        //     })
        //     .then(response => {
        //         if (!response.ok) {
        //             throw new Error;
        //         }
        //         return response.json();
        //     })
        //     .then(data => {
        //         // Tampilkan pesan sukses atau lakukan tindakan lain yang diperlukan
        //         console.log('Data berhasil ditambahkan:', data);
        //         closeModal();
        //     })
        //     .catch(error => {
        //         console.error('Terjadi kesalahan:', error);
        //         // Tampilkan pesan error kepada pengguna
        //         alert;
        //     });
        // });
    });


    // Function to create table row for a post
    // function createPostRow(id, title, content, date, category, image) {
    //     const tr = document.createElement('tr');
    //     tr.innerHTML = `
    //     <td>${id}</td>
    //     <td>${title}</td>
    //     <td>${content}</td>
    //     <td>${date}</td>
    //     <td>${category}</td>
    //     <td>${image ? `<img src="${image}" style="max-width: 100px;" />` : 'Tidak ada gambar'}</td>
    //     <td>
    //         <button class="edit-post-btn" data-id="${id}">
    //             <i class='bx bxs-edit'></i>
    //         </button>
    //         <button class="delete-post-btn" data-id="${id}">
    //             <i class='bx bxs-trash-alt'></i>
    //         </button>
    //     </td>
    // `;
    //     return tr;
    // }

    // Function to fetch posts from localStorage and display in the table
    // function displayPosts() {
    //     postList.innerHTML = '';
    //     const posts = JSON.parse(localStorage.getItem('posts')) || [];
    //     posts.forEach(post => {
    //         postList.appendChild(createPostRow(post.id, post.title, post.content, post.date, post.category, post.image));
    //     });
    // }

    // postForm.addEventListener('submit', function (event) {
    //     event.preventDefault();
    //     const postId = document.getElementById('post_id').value;
    //     const title = document.getElementById('title').value;
    //     const content = document.getElementById('content').value;
    //     const date = document.getElementById('date').value;
    //     const category = document.getElementById('category').value;
    //     const imageInput = document.getElementById('image');

    //     // Check if an image is selected
    //     if (imageInput.files.length > 0) {
    //         const imageFile = imageInput.files[0];
    //         const reader = new FileReader();

    //         reader.onload = function (event) {
    //             const imageBase64 = event.target.result;

    //             // Save data to localStorage or send it to server
    //             if (postId) {
    //                 // Edit post
    //                 const posts = JSON.parse(localStorage.getItem('posts')) || [];
    //                 const editedPostIndex = posts.findIndex(post => post.id === postId);
    //                 if (editedPostIndex !== -1) {
    //                     posts[editedPostIndex] = {
    //                         id: postId,
    //                         title: title,
    //                         content: content,
    //                         date: date,
    //                         category: category,
    //                         image: imageBase64
    //                     };
    //                     localStorage.setItem('posts', JSON.stringify(posts));
    //                     displayPosts();
    //                     closeModal();
    //                 } else {
    //                     alert('Post not found!');
    //                 }
    //             } else {
    //                 // Add new post
    //                 const newPost = {
    //                     id: Date.now().toString(),
    //                     post_id: post_id,
    //                     title: title,
    //                     content: content,
    //                     date: date,
    //                     category: category,
    //                     image: imageBase64
    //                 };
    //                 const posts = JSON.parse(localStorage.getItem('posts')) || [];
    //                 posts.push(newPost);
    //                 localStorage.setItem('posts', JSON.stringify(posts));
    //                 displayPosts();
    //                 closeModal();
    //             }
    //         };

    //         // Read the selected image as data URL
    //         reader.readAsDataURL(imageFile);
    //     } else {
    //         // Handle case when no image is selected
    //         alert('Please select an image.');
    //     }
    //     });


    function confirmLogout() {
        var result = confirm("Yakin Log Out?");
        if (result) {
            window.location.href = "index.php";
        } else {
        }
    }



        // Display posts when the page loads
        displayPosts();

        
    </script>

</body>

</html>
