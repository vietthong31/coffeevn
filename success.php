<?php
session_start();
if (!isset($_SESSION['signupSuccess'])) {
  header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đăng ký thành công</title>
  <?php include 'component/head.html' ?>
  <link rel="stylesheet" href="resource/style/success.css">
</head>

<body>
  <main class="text-center">
    <div>
      <span class="bi bi-check-circle"></span>
      <h1>Thành công</h1>
    </div>
    <p>Đăng ký tài khoản thành công.<br /> <a href="index.php" class="signin">Đăng nhập</a></p>
  </main>
</body>

</html>