<?php
require_once 'db.php';
if (isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $stmt = $con->prepare("DELETE FROM san_pham WHERE id = ?");
  $stmt->bind_param("i", $id);
  $result = $stmt->execute();
}

header("Location: /cafe/admin/sanpham.php");
