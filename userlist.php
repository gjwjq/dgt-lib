<?php
require_once 'header.php';
if(!isset($_SESSION)) session_start();

  $member = DB::fetchAll("select * from user where id != 'admin'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/userlist.css">
  <title>Document</title>
</head>
<body>
  <main>
    <div class="wrap">
      <h2 class="mainTitle">유저 목록</h2>
    <table>
      <thead>
        <tr>
          <th>아이디</th>
          <th>비밀번호</th>
          <th>이름</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($member as $value) { ?>
        <tr>
          <td><?= $value['id'] ?></td>
          <td><?= $value['pw'] ?></td>
          <td><?= $value['name'] ?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
  </main>
</body>
</html>