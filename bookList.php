<?php
  require_once 'header.php';
  
  $storeIdx = $_GET['storeIdx'];
  $store = DB::fetch("select * from bookstore where idx = '$storeIdx'");
  $books = DB::fetchAll("select * from book where storeIdx = '$storeIdx'");
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
   <link rel="stylesheet" href="./css/admin.css">
  <link rel="stylesheet" href="./css/book.css">
  <style>
    .book:hover .booktitle h2{text-decoration: underline;}
  </style>
</head>
<body>
  <main>
    <div class="wrap">
      <div class="mainTitle">
        <h2><?= $store['name'] ?> - 도서 목록</h2>
        <p>해당 서점에서 책들을 둘러보고 대여 할 수 있습니다.</p>
      </div>
       <div class="books">
          <?php foreach($books as $book) { ?>
          <a href="bookExplane.php?idx=<?= $book['idx'] ?>">
            <div class="book">
              <div class="booktitle">
                <span>제목</span>
                <h2><?= $book['title'] ?></h2>
            </div>
              <div class="bookimgcover">
                <img src="./img/<?= $book['img'] ?>" alt="">
              </div>
              <div class="bookContent">
                <div style="display: flex;align-items: center; gap: 5px;"><span style="font-size: 13px;color: #575757aa;">저자 </span><div class="author"><?= $book['author'] ?></div></div>
                <div><span style="font-size: 13px;color: #575757aa;">수량 </span><span><?= $book['count'] ?>권</span></div>
              </div>
            </div>
            </a>
          <?php } ?>
         </div>
    </div>
  </main>
</body>
</html>