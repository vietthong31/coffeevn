<?php
require_once 'src/db.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "SELECT * FROM chi_tiet_hoadon INNER JOIN san_pham sp ON id_sanpham = sp.id WHERE id_hoadon = '$id'";
  $result = $con->query($sql);
  $sl = 0;
  $tong = 0;
}

?>

<?php if (isset($result)) : ?>
  <div>
    <p class="m-0">Chi tiết hóa đơn mã <?php echo $id ?></p>
    <table class="small">
      <tr>
        <th>Mã sản phẩm</th>
        <th>Tên sản phẩm</th>
        <th>Số lượng</th>
        <th>Đơn giá</th>
        <th>Thành tiền</th>
      </tr>
      <?php while ($row = $result->fetch_assoc()) : ?>
        <?php
        $sl += $row['so_luong'];
        $tong += $row['so_luong'] * $row['don_gia'];
        ?>
        <tr>
          <td><?php echo $row['id_sanpham'] ?></td>
          <td><?php echo $row['ten'] ?></td>
          <td><?php echo $row['so_luong'] ?></td>
          <td><?php echo $row['don_gia'] ?></td>
          <td><?php echo $row['so_luong'] * $row['don_gia'] ?></td>
        </tr>
      <?php endwhile ?>
      <tr>
        <td colspan="2"></td>
        <td><?php echo $sl; ?></td>
        <td></td>
        <td><?php echo $tong; ?></td>
      </tr>
    </table>
  </div>

<?php else : ?>

<?php endif ?>