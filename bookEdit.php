<?php
require_once 'header.php';

$idx = $_GET['idx'];
$book = DB::fetch("select * from book where idx = '$idx'");

if(!$book || $book['storeIdx'] !== $_SESSION['myIdx']) {
  back('접근 권한이 없거나 존재하지 않는 도서입니다.');
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./css/admin.css">
</head>
<body>
  <main>
    <div class="wrap">
      <div class="adminCon">
          <h2 style="text-align: center;margin-bottom:10px;">도서 정보 수정</h2>
            <form action="bookProcess.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="mode" value="update">
                <input type="hidden" name="oldImg" value="<?= $book['img'] ?>">
                <input type="hidden" name="idx" value="<?= $idx ?>">
                
                <h3>책 제목</h3>
                <input type="text" name="title" value="<?= $book['title'] ?>" required>
                
                <h3>저자</h3>
                <input type="text" name="author" value="<?= $book['author'] ?>" required>
                
                <h3>설명</h3>
                <textarea name="content"><?= $book['content'] ?></textarea>
                
                <h3>수량</h3>
                <input type="number" name="count" value="<?= $book['count'] ?>" min="1" required>
                
                <h3>이미지</h3>
                <div class="bookimgcover" style="margin-bottom: 10px;">
                    <img src="./img/<?= $book['img'] ?>" width="100" >
                </div>
                <input type="file" name="img">

                <div style="display: flex; gap: 10px; margin-top: 20px;">
                    <button type="submit" class="btn" style="flex: 1;">수정 완료</button>
                    <button type="button" class="btn" style="background: #ff4d4d; color: white;" 
                            onclick="if(confirm('정말 삭제하시겠습니까?')) location.href='bookProcess.php?mode=delete&idx=<?= $idx ?>'">
                        삭제하기
                    </button>
                </div>
            </form>
        </div>
    </div>
  </main>
</body>
</html>