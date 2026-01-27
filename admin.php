<?php
require_once 'header.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['id'] !== 'admin') {
  back('관리자만 접근 가능합니다.');
  exit;
}

$stores = DB::fetchAll("select * from bookstore");
?>
<link rel="stylesheet" href="./css//admin.css">
<main>
  <div class="wrap">
    <h2 class="mainTitle btn">서점 & 관리자 등록 </h2>
    <div class="adminCon">
    <form action="adminProcess.php" method="POST" enctype="multipart/form-data">
      <h3>서점 등록</h3>
      <div><input type="text" name="storeName" placeholder="서점 이름" required></div>
      <div>
        <h3>서점 로고</h3> <input type="file" name="storeImg" placeholder="서점 로고" required>
      </div>

      <h3 style="margin-top: 50px;">관리자 등록</h3>
      <div><input type="text" name="id" placeholder="id" required></div>
      <div><input type="password" name="pw" placeholder="password" pattern="(?=.*[A-Za-z])(?=.*[0-9])(?=.*[~!@#$%^&*]).{6,}" title="영어, 숫자, 특수문자 1개씩 포함 및 6자 이상" required></div>
      <div><input type="text" name="name" placeholder="name" required></div>

      <button class="btn" style="padding: 2.5px 5px;margin-top:30px;">등록하기</button>
      </div>
    </form>
    <h2 class="mainTitle btn">등록된 서점 목록</h2>
    <div class="bookstores">
      <?php foreach ($stores as $store) { ?>
        <div class="bookstore-p">
          <div class="bs-header">
          <div class="bookstore-name"><?= $store['name'] ?></div>
           <div class="btnWrap">
             <a href="editStore.php?idx=<?= $store['idx'] ?>" class="btn">수정</a><span style="user-select: none;">/</span>
              <a href="deleteStore.php?idx=<?= $store['idx'] ?>" class="btn">X</a>
            </div>
            </div>
          <div class="imgcover">
            <img src="./img/<?= $store['img'] ?>" alt="" style="object-fit:cover;">
          </div>
          <div class="booktstore-content">
            <div><span style="color: #bbb;font-size: 14px;">담당 관리자</span></div>
            <span><?= $store['id'] ?></span>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>

</main>