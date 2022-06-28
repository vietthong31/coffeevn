<?php
session_start();

require_once "../src/check_login.php";
require_once "../src/db.php";
require_once "../src/query_function.php";

$danhmuc = query_danhmuc();

if (isset($_POST['add'])) {
  $ten = $_POST['ten'] ?? "";
  $id_danhmuc = $_POST['danhmuc'] ?? "";
  $dongia = $_POST['gia'] ?? "";
  $hinhanh = $_FILES['anh'];

  $sql = "INSERT INTO san_pham VALUES (null, ?, ?, ?, null)";
  $sql2 = "INSERT INTO san_pham VALUES (null, ?, ?, ?, ?)";


  if ($hinhanh['error'] == 0) {
    $fname = $hinhanh['name'];
    if (move_uploaded_file($hinhanh['tmp_name'], "resource/img/$fname")) {
      $stmt = $con->prepare($sql2);
      $stmt->bind_param("siis", $ten, $id_danhmuc, $dongia, $hinhanh);
      $stmt->execute();
    }
  } else {
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sii", $ten, $id_danhmuc, $dongia);
    $stmt->execute();
  }

  header("Location: sanpham.php");
}

?>

<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thêm sản phẩm</title>
  <?php include '../component/head.html' ?>
  <link rel="stylesheet" href="resource/style/login.css">
</head>

<body>
  <div id='bg-img'></div>
  <main>
    <a href="admin/sanpham.php"><span class="bi bi-arrow-left"></span>Về trang quản lý</a>
    <h1 class="mb-1">Thêm sản phẩm</h1>

    <form action="" method="post" class="form" enctype="multipart/form-data">

      <div class="form-field">
        <label for="ten">Tên sản phẩm</label>
        <input type="text" name='ten' id='ten' value="<?php echo $_POST['ten'] ?? "" ?>" required>
      </div>

      <div class="form-field">
        <label for="danhmuc">Danh mục</label>
        <select name="danhmuc" id="danhmuc" required>
          <?php
          for ($i = 0; $i < count($danhmuc); $i++) {
            $id = $danhmuc[$i]['id'];
            $ten = $danhmuc[$i]['ten'];
            echo "<option value='$id'>$ten</option>";
          }
          ?>
        </select>
      </div>

      <div class="form-field">
        <label for="gia">Đơn giá</label>
        <input type="number" name='gia' id='gia' min="1000" step="1000" value="<?php echo $_POST['don_gia'] ?? "" ?>" required>
      </div>

      <div class="form-field">
        <label for="anh">Hình ảnh</label>
        <input type="file" name="anh" id="anh">
      </div>

      <input type="submit" name="add" value="Thêm">
    </form>
  </main>
</body>

</html>