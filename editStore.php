<?php
require_once 'header.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['id'] !== 'admin') {
  back('관리자만 접근 가능합니다.');
  exit;
}

$idx = $_GET['idx'];

$store = DB::fetch("select * from bookstore where idx = $idx");

if (!$store) {
  back('존재하지 않는 서점입니다.');
  exit;
}
?>
<link rel="stylesheet" href="./css/admin.css">
<main>
  <div class="wrap">
    <h2 class="mainTitle btn">서점 정보 수정</h2>
    <div class="adminCon">

      <form action="adminProcess.php" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="mode" value="update">
        <input type="hidden" name="idx" value="<?= $store['idx'] ?>">

        <h3>서점 이름</h3>
        <input type="text" name="storeName" value="<?= $store['name'] ?>" required>
        <h3>서점 로고</h3>
        <div class="imgcover">
          <img src="./img/<?= $store['img'] ?>" alt="현재 로고">
        </div>
        <input type="file" name="storeImg">
        <button type="submit" class="btn">수정완료</button>

      </form>
    </div>
  </div>
</main>