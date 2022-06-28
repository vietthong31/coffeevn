<?php
session_start();
require_once 'db.php';

if (isset($_POST['id'])) {
  $id = $_POST['id'];
  $ten = $_POST['ten'] ?? "";
  $id_danhmuc = $_POST['danhmuc'] ?? "";
  $dongia = $_POST['gia'] ?? "";
  $hinhanh = $_FILES['anh'];

  $sql = "UPDATE san_pham SET ten = ?, id_danh_muc = ?, don_gia = ? WHERE id = ?";
  $sql2 = "UPDATE san_pham SET ten = ?, id_danh_muc = ?, don_gia = ?, hinh_anh = ? WHERE id = ?";

  if ($hinhanh['error'] == 0) {
    $fname = $hinhanh['name'];
    if (move_uploaded_file($hinhanh['tmp_name'], "resource/img/$fname")) {
      $stmt = $con->prepare($sql2);
      $stmt->bind_param("siiss", $ten, $id_danhmuc, $dongia, $hinhanh, $id);
      $stmt->execute();
    }
  } else {
    $stmt = $con->prepare($sql);
    $stmt->bind_param("siis", $ten, $id_danhmuc, $dongia, $id);
    $stmt->execute();
  }
}

header("Location: /cafe/admin/sanpham.php?page=" . $_SESSION['sanpham_page']);
