<?php
session_start();

require_once "../src/check_login.php";
require_once "../src/db.php";
require_once "../src/query_function.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
  header("Location: admin/sanpham.php");
} else {
  $sql = "SELECT * FROM san_pham WHERE id = " . $_GET['id'];
  $result = $con->query($sql);
  $row = $result->fetch_assoc();
}

$danhmuc = query_danhmuc();

?>

<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cập nhật sản phẩm</title>
  <?php include '../component/head.html' ?>
  <link rel="stylesheet" href="resource/style/login.css">
</head>

<body>
  <div id='bg-img'></div>
  <main>
    <a href=<?php echo "admin/sanpham.php?page=" . $_SESSION['sanpham_page'] ?>><span class="bi bi-arrow-left"></span>Về trang quản lý</a>
    <h1 class="mb-1">Cập nhật sản phẩm mã <?php echo $row['id'] ?></h1>

    <form action="src/updateSanPham.php" method="post" class="form" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
      <div class="form-field">
        <label for="ten">Tên sản phẩm</label>
        <input type="text" name='ten' id='ten' value="<?php echo $row['ten'] ?>" required>
      </div>

      <div class="form-field">
        <label for="danhmuc">Danh mục</label>
        <select name="danhmuc" id="danhmuc" required>
          <?php
          for ($i = 0; $i < count($danhmuc); $i++) {
            $id = $danhmuc[$i]['id'];
            $ten = $danhmuc[$i]['ten'];
            $selected = $danhmuc[$i]['id'] == $row['id_danh_muc'] ? "selected" : "";
            echo "<option value='$id' $selected>$ten</option>";
          }
          ?>
        </select>
      </div>

      <div class="form-field">
        <label for="gia">Đơn giá</label>
        <input type="number" name='gia' id='gia' min="1000" step="1000" value="<?php echo $row['don_gia'] ?>" required>
      </div>

      <div class="form-field">
        <?php if ($row['hinh_anh'] == '') : ?>
          <em>Chưa có ảnh</em>
        <?php else : ?>
          <span>Hình ảnh hiện tại</span>
          <img src="<?php echo "resource/img/" . $row['hinh_anh'] ?>" alt="" width="100" height="100" />
        <?php endif ?>
        <label for="anh">Chọn ảnh mới</label>
        <input type="file" name="anh" id="anh">
      </div>

      <input type="submit" name="update" value="Cập nhật">
    </form>
  </main>
</body>

</html>