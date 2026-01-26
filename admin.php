<?php
  require_once 'header.php';

  if(!isset($_SESSION['user']) || $_SESSION['user']['id'] !== 'admin'){
    back('관리자만 접근 가능합니다.');
    exit;
  }

  $stores = DB::fetchAll("select * from bookstore");
?>
<main>
<div class="wrap">
  <h2 class="mainTitle btn">서점 & 관리자 등록 </h2>
  <form action="adminProcess.php" method="POST" enctype="multipart/form-data">
    <h3>서점 등록</h3>
    <div><input type="text" name="storeName" placeholder="서점 이름" required></div>
    <div ><h3>서점 로고</h3> <input type="file" name="storeImg" placeholder="서점 로고" required></div>

    <h3 style="margin-top: 50px;">관리자 등록</h3>
    <div><input type="text" name="id" placeholder="id" required></div>
    <div><input type="password" name="pw" placeholder="password" pattern="(?=.*[A-Za-z])(?=.*[0-9])(?=.*[~!@#$%^&*]).{6,}" title="영어, 숫자, 특수문자 1개씩 포함 및 6자 이상" required></div>
    <div><input type="text" name="name" placeholder="name" required></div>

    <button class="btn" style="padding: 2.5px 5px;margin-top:30px;">등록하기</button>
  </form>
  <h2 class="mainTitle btn">등록된 서점 목록</h2>
  <table>
    <thead>
      <tr>
        <th>로고</th>
        <th>서점명</th>
        <th>담당 관리자</th>
        <th>관리</th>
      </tr>
    </thead>
     <tbody>
      <?php foreach($stores as $store) { ?>
      <tr>
        <td><img src="./img/<?= $store['img'] ?>" alt="" style="object-fit:cover;"></td>
        <td><?= $store['name'] ?></td>
        <td><?= $store['id'] ?></td>
        <td>
          <a href="deleteStore.php?idx=<?= $store['idx'] ?>" class="btn"><button>삭제</button></a>
        </td>
      </tr>
      <?php } ?>
     </tbody>
  </table>
</div>

</main>