<?php
require_once 'header.php';

if (!isset($_SESSION['myIdx'])) {
  back('관리자만 접근 가능합니다.');
  exit;
}

$idx = $_SESSION['myIdx'];

$store = DB::fetch("select * from bookstore where idx = '$idx'");

$myBooks = DB::fetchAll("select * from book where storeIdx = '$idx'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./css/admin.css">
  <link rel="stylesheet" href="./css/book.css">
</head>

<body>
  <main>
    <div class="wrap">
      <div class="wrap">
      <div class="mainTitle">
        <h2>도서 관리 - <?= $store['name'] ?></h2>
        <p>서점에 책 들을 추가 및 삭제 할 수 있습니다.</p>
      </div>
      <div class="adminCon">
        <h3 style="justify-self: center;margin-bottom:10px;">도서 등록</h3>
        <form action="bookProcess.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="mode" value="insert">
          <input type="hidden" name="storeIdx" value="<?= $idx ?>">

          <input type="text" name="title" placeholder="책 제목" required maxlength="27">
          <input type="text" name="author" placeholder="책 저자" required maxlength="26">
          <textarea name="content" placeholder="책 설명"></textarea>
          <input type="number" name="count" placeholder="수량" min="1" required>
          <input type="file" name="img" required>

          <button type="submit" class="btn">책 등록하기</button>
        </form>
      </div>
      </div>
      <div class="wrap">
        <div class="mainTitle">
          <h2>도서 목록</h2>
          <p>서점에 추가 된 책들의 목록입니다.</p>
        </div>
         <div class="books">
          <?php foreach($myBooks as $book) { ?>
            <div class="book">
              <div class="bookedit"><a href="bookEdit.php?idx=<?= $book['idx'] ?>" class="btn">수정</a></div>
              <div class="booktitle">
                <span>제목</span>
                <h2><?= $book['title'] ?></h2>
            </div>
              <div class="bookimgcover">
                <img src="./img/<?= $book['img'] ?>" alt="">
              </div>
              <div class="bookContent">
                <div style="display: flex;align-items: center; gap: 5px;"><span style="font-size: 13px;color: #575757aa;">저자 </span><div class="author"><?= $book['author'] ?></div></div>
                <div><span style="font-size: 13px;color: #575757aa;">수량 </span><span><?= $book['count'] ?></span>권</div>
              </div>
            </div>
          <?php } ?>
         </div>
      </div>
    </div>
  </main>
</body>

</html>