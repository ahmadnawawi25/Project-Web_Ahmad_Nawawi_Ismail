<?php 
session_start();
include 'Koneksi/config.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username =$_POST['username'] ?? '';
    $password =$_POST['password'] ?? '';

    $sql = "SELECT * from users where username= '$username' and password= '$password'";
    $result = mysqli_query($koneksi, $sql);

    if(mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user ['role'];

        //arahkan bedasarkan role
        if($user['role'] == 'admin') {
            header("Location: admin/index.php");
        } else if ($user['role'] == 'siswa') {
            header("Location: siswa/index.php");
        }
        exit;
    } else {
        $error = "Login gagal! username atau password salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style-login.css">
</head>
<body>
    <div class="login-box">
        <div class="login-container">
        <img src="img/login.jpg" alt="logo" class="logo">
        </div>
        <h2>login</h2>

        <?php if(!empty($error)): ?>
        <div class="error-message"><?= $error ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="username" required />
            <input type="text" name="password" placeholder="password" required />
            <input type="submit" value="login">
        </form>
    </div>
</body>
</html>