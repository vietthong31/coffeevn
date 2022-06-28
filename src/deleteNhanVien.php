<?php
require_once 'db.php';
if (isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $stmt = $con->prepare("DELETE FROM nhan_vien WHERE id = ?");
  $stmt->bind_param("i", $id);
  $result = $stmt->execute();
}

header("Location: /cafe/src/signout.php");
