<?php
session_start();
require_once 'db.php';

// var_dump($_POST);
// print_r($_SESSION);
$str =  json_encode($_SESSION, JSON_PRETTY_PRINT);
echo "<pre>$str</pre>";

$id_hoa_don = rand(100000000, 999999999);
$ngay = $_POST['buydate'];
$tinh_trang = $_POST['status'];
$tong_tien = $_POST['total'];

$sql = "INSERT INTO hoa_don VALUES (?, ?, ?, ?)";
$stmt = $con->prepare($sql);
$stmt->bind_param("issi", $id_hoa_don, $ngay, $tinh_trang, $tong_tien);
$inserted_bill = $stmt->execute();
$inserted_detail = false;

if ($inserted_bill) {
  foreach ($_SESSION['soluong_sp'] as $id_san_pham => $soluong) {

    $sql2 = "INSERT INTO chi_tiet_hoadon VALUES (?, ?, ?, ?)";
    $stmt2 = $con->prepare($sql2);
    $stmt2->bind_param("iiii", $id_hoa_don, $id_san_pham, $soluong, $_SESSION['sanpham'][$id_san_pham]['don_gia']);
    $inserted_detail = $stmt2->execute();
    // var_dump($inserted_detail);
  }
}

unset($_SESSION['sanpham']);
unset($_SESSION['soluong_sp']);
unset($_SESSION['tong_tien']);

header("Location: /cafe/hoadon.php");
