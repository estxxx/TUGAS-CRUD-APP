<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ima Listiatus Sa'diyah - 3055</title>
    <link rel="stylesheet" href="style-dashboard.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Blog</title>
    <link rel="stylesheet" href="style.css">
</head>
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
                    <a href="#" id="logout-btn">
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
            <th>Judul</th>
            <th>Konten</th>
            <th>Tanggal Posting</th>
            <th>Kategori</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody id="post-list">
        <!-- Data post akan dimasukkan disini -->
        </tbody>
    </table>
    </div>

    <div id="modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2 id="modal-title"></h2>
        <form id="post-form">
        <input type="hidden" id="post-id">
        <input type="text" id="post-title" placeholder="Judul" required>
        <input type="text"id="post-content" placeholder="Konten" required>
        <input type="text" id="post-category" placeholder="Kategori" required>
        <button type="submit" id="submit-post-btn">Simpan</button>
        </form>
    </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('modal');
        const modalTitle = document.getElementById('modal-title');
        const postForm = document.getElementById('post-form');
        const postList = document.getElementById('post-list');
        const addPostBtn = document.getElementById('add-post-btn');
        const closeBtn = document.querySelector('.close');

        function openModal(title, id) {
            modal.style.display = 'block';
            modalTitle.innerText = title;
            document.getElementById('post-id').value = id || '';
        }

        function closeModal() {
            modal.style.display = 'none';
            postForm.reset();
        }

        // Event listener to open modal when "Tambah Post" button is clicked
        addPostBtn.addEventListener('click', function() {
            openModal('Tambah Post');
        });

        // Event listener to close modal when close button is clicked
        closeBtn.addEventListener('click', function() {
            closeModal();
        });

        // Event listener to close modal when user clicks outside the modal
        window.addEventListener('click', function(event) {
            if (event.target == modal) {
            closeModal();
            }
        });

        // Function to create table row for a post
        function createPostRow(id, title, content, date, category) {
            const tr = document.createElement('tr');
            tr.innerHTML = `
            <td>${title}</td>
            <td>${content}</td>
            <td>${date}</td>
            <td>${category}</td>
            <td>
                <button class="edit-post-btn" data-id="${id}">Edit</button>
                <button class="delete-post-btn" data-id="${id}">Hapus</button>
            </td>
            `;
            return tr;
        }

        // Function to fetch posts from localStorage and display in the table
        function displayPosts() {
            postList.innerHTML = '';
            const posts = JSON.parse(localStorage.getItem('posts')) || [];
            posts.forEach(post => {
            postList.appendChild(createPostRow(post.id, post.title, post.content, post.date, post.category));
            });
        }

        // Event listener to display posts when the page loads
        document.addEventListener('DOMContentLoaded', displayPosts);

        // Event listener to handle form submission for adding/editing a post
        postForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const postId = document.getElementById('post-id').value;
            const title = document.getElementById('post-title').value;
            const content = document.getElementById('post-content').value;
            const category = document.getElementById('post-category').value;
            const date = new Date().toLocaleDateString();

            if (postId) {
            // Edit post
            const posts = JSON.parse(localStorage.getItem('posts')) || [];
            const editedPosts = posts.map(post => {
                if (post.id === postId) {
                return { id: postId, title, content, date, category };
                }
                return post;
            });
            localStorage.setItem('posts', JSON.stringify(editedPosts));
            } else {
            // Add new post
            const newPost = { id: Date.now().toString(), title, content, date, category };
            const posts = JSON.parse(localStorage.getItem('posts')) || [];
            posts.push(newPost);
            localStorage.setItem('posts', JSON.stringify(posts));
            }

            displayPosts();
            closeModal();
        });

        // Event listener to handle edit and delete button clicks
        postList.addEventListener('click', function(event) {
            if (event.target.classList.contains('edit-post-btn')) {
            const postId = event.target.getAttribute('data-id');
            const posts = JSON.parse(localStorage.getItem('posts')) || [];
            const post = posts.find(post => post.id === postId);
            if (post) {
                document.getElementById('post-title').value = post.title;
                document.getElementById('post-content').value = post.content;
                document.getElementById('post-category').value = post.category;
                openModal('Edit Post', postId);
            }
            } else if (event.target.classList.contains('delete-post-btn')) {
            const postId = event.target.getAttribute('data-id');
            const posts = JSON.parse(localStorage.getItem('posts')) || [];
            const updatedPosts = posts.filter(post => post.id !== postId);
            localStorage.setItem('posts', JSON.stringify(updatedPosts));
            displayPosts();
            }
        });

        
        // Event listener untuk tombol "Logout"
        document.getElementById('logout-btn').addEventListener('click', function() {
            alert("Anda telah logout!");
            localStorage.removeItem('user');
            window.location.href = "login.html";
        });

        
    });
    </script>

</body>
</html>
    
