<?php
session_start();
require_once "../src/check_login.php";
require_once "../src/db.php";
require_once "../src/query_function.php";


if (isset($_POST['add'])) {
  $randomId = rand(0, 1000);
  $sql = "INSERT INTO danh_muc VALUES (?, ?, ?)";
  $stmt = $con->prepare($sql);
  $ten = $_POST['ten'];
  $mota = $_POST['mota'];
  $stmt->bind_param("iss", $randomId, $ten, $mota);
  $stmt->execute();
  header("Location: danhmuc.php");
}

?>

<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thêm danh mục</title>
  <?php include '../component/head.html' ?>
  <link rel="stylesheet" href="resource/style/login.css">
</head>

<body>
  <div id='bg-img'></div>
  <main>
    <a href="admin/danhmuc.php"><span class="bi bi-arrow-left"></span>Về trang quản lý</a>
    <h1 class="mb-1">Thêm danh mục mới</h1>

    <form action="" method="post" class="form">
      <div class="form-field">
        <label for="ten">Tên danh mục</label>
        <input type="text" name='ten' id='ten' value="<?php echo $_POST["ten"] ?? "" ?>" required>
      </div>

      <div class="form-field">
        <label for="mota">Mô tả</label>
        <textarea name="mota" id="mota" cols="30" rows="10"><?php echo $_POST['mota'] ?? "" ?></textarea>
      </div>

      <input type="submit" name="add" value="Thêm">
    </form>
  </main>
</body>

</html>