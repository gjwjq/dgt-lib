<?php
  require_once 'header.php';
  $idx = $_GET['idx'];
  $book = DB::fetch("select * from book where idx = '$idx'");
  if(!$book){
    alert('도서가 존재하지 않음');
    move('booklist.php');
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./css/admin.css">
  <link rel="stylesheet" href="./css/book.css">
  <link rel="stylesheet" href="./css/bookExplane.css">
</head>
<body>
  <main>
    <div class="wrap">
      <div class="bookMain">
        <div class="bookLeft">
       
        <div class="bookImg">
          <img src="./img/<?= $book['img'] ?>" alt="" draggable="false">
        </div>
        <a href="borrow.php?bookIdx=<?= $book['idx'] ?>" class="borrow btn">대여하기</a>
      </div>
        <div class="bookRight">
           <div class="bookHeader">
       <div style="display: flex;"> <h1><?= $book['title'] ?></h1> <?php if($book['count'] > 0) {?>
        <span class="canBorrow">대여 가능</span>
       <?php }?></div>
        <div class="hdAuthor"><span>저자</span> - <span style="color: #333; font-weight:500;"><?= $book['author'] ?></span></div>
      </div>
        <div class="bookContent">
          <h2>책 소개</h2>
          <div class="bookDes"><?= $book['content'] ?></div>
      </div>
      <div class="countNum">수량 : <span ><?= $book['count'] ?></span></div>
      </div>
      </div>
    </div>
  </main>
</body>
</html>