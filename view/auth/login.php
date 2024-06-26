<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TUGAS</title>
    <link rel="stylesheet" href="./public/style/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div class="wrapper" style="margin-top:180px">
        <form action="<?= urlpath('dashboard'); ?>">
            <h1 style="font-size:36px">Login</h1>
            <div class="input-box">
                <input type="text" placeholder="Username" required>
                <i class='bx bx-user'></i>
            </div>
            <div class="input-box">
                <input type="password" placeholder="Password" required>
                <i class='bx bx-lock'></i>
            </div>

            <button type="submit" class="btn">Login</button>

            <p>Belum punya akun? <a href="<?= urlpath('user/register'); ?>">Registrasi</a></p>

        </form>

    </div>
</body>

</html>