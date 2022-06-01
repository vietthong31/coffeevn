<?php
require 'src/db.php';
$sql = "SELECT * FROM bo_phan";
$result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lý CoffeeVN</title>
  <?php include 'component/head.html' ?>
</head>

<body>
  <?php include 'component/header.php' ?>
  <?php include 'component/panel.php' ?>
  <main>
    <h1>Quản lý bộ phận</h1>
    <table>
      <thead>
        <th>Mã</th>
        <th>Tên bộ phận</th>
        <th>Mô tả</th>
        <td colspan="2"></td>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()) : ?>
          <tr>
            <td class='id'><?php echo $row['id'] ?></td>
            <td><?php echo $row['ten'] ?></td>
            <td><?php echo $row['mo_ta'] ?></td>
            <td class="action delete"><a href="src/deleteBoPhan.php?id=<?php echo $row['id'] ?>">Xóa</a></td>
            <td class="action edit">Sửa</td>
          </tr>
        <?php endwhile ?>
      </tbody>
    </table>
  </main>
  <?php include 'component/script.html' ?>
  <script>
    // const deleteBtn = document.getElementById('delete');
    // const id = document.getElementById('id').textContent;

    // deleteBtn.addEventListener('click', () => {
    //   let yes = window.confirm('Xóa bộ phận và tất cả nhân viên thuộc bộ phận này?');
    //   if (yes) {
    //     window.location.assign('src/deleteBoPhan.php');
    //   }
    // });
  </script>
</body>

</html>