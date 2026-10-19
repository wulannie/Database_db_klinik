<?php
session_start();
include "koneksi.php";

$pesan = "";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' AND password='$password'");
    
    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);

        $_SESSION['id_user'] = $data['id_user'];
        $_SESSION['username'] = $data['username'];

        header("Location: dashboard.php");
        exit;
    } else {
        $pesan = "Username atau password salah";
    }
}
?>

<!DOCTYPE htmml>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login - Klinik</title>

    <style>
        body {
            font-family: Arial;
            background-image: url("boneka.jpg");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .login-container {
            width: 350px;
            margin: 100px auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        }

        h2 {
            text-align: center;
            color: #1976d2;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 18px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 11px;
            background-color: #1976d2;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #125ca3;
        }

        .pesan {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

<div class="login-container">

    <h2>LOGIN SISTEM KLINIK</h2>

    <?php if ($pesan != "") { ?>
        <div class="pesan">
            <?php echo $pesan; ?>
        </div>
    <?php } ?>

    <form method="POST">

        <label>Username</label>
        <input type="text" name="username" placeholder="Masukkan username" required>

        <label>Password</label>
        <input type="password" name="password" placeholder="Masukkan password" required>

        <input type="submit" name="login" value="LOGIN">

    </form>

</div>

</body>
</html>