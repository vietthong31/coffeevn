<?php
// chuyển về trang chủ (bắt đăng nhập) nếu chưa đăng nhập.
if (!isset($_SESSION['login'])) {
  header("Location: index.php");
}
