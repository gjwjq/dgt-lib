<?php
require_once 'header.php';
if (!isset($_SESSION['user']) && isset($_SESSION['myIdx']) && $_SESSION['user']['id'] === 'admin') {
    back('일반 유저만 이용 가능합니다.');
    exit;
}

$userId = $_SESSION['user']['id'];

//   $rentList = DB::fetchAll("select * from rent join book on rent.bookIdx = book.idx where userId = '$userId' and status = '대여중'");
$rentList = DB::fetchAll("
    SELECT *, rent.idx AS rIdx 
    FROM rent 
    JOIN book ON rent.bookIdx = book.idx 
    WHERE userId = '$userId' AND status = '대여중'
");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/book.css">
    <title>Document</title>
</head>

<body>
    <main>
        <div class="wrap">
            <div class="mainTitle">
                <h2>마이페이지</h2>
                <p>현재 대여 중인 도서 목록입니다. (1인 1권 대여 가능)</p>
            </div>

            <div class="books">
                <?php foreach ($rentList as $rent) : ?>
                    <div class="book">
                        <div class="booktitle">
                            <span>제목</span>
                            <h2><?= $rent['title'] ?></h2>
                        </div>
                        <div class="bookimgcover">
                            <img src="./img/<?= $rent['img'] ?>" alt="<?= $rent['title'] ?>" style="object-fit: cover;">
                        </div>
                        <div class="bookContent">
                            <div>
                                <span style="font-size: 13px; color: #575757aa;">저자 </span>
                                <span class="author"><?= $rent['author'] ?></span>
                            </div>
                            <div style="margin-top: 10px; color: #ff4d4d; font-weight: bold;">
                                <span style="font-size: 12px;">반납 예정일</span><br>
                                <?= date("Y-m-d", strtotime($rent['returnDate'])) ?>
                            </div>
                        </div>
                        <a href="returnProcess.php?rentIdx=<?= $rent['rIdx'] ?>&bookIdx=<?= $rent['bookIdx'] ?>"
                            class="btn"
                            onclick="return confirm('정말 반납하시겠습니까?')">
                            반납하기
                        </a>
                    </div>
                <?php endforeach; ?>

                <?php if (empty($rentList)) : ?>
                    <div style="text-align: center; width: 100%; padding: 50px;">
                        <p>현재 대여 중인 도서가 없습니다.</p>
                        <a href="bookStore.php" class="btn" style="display: inline-block; margin-top: 20px; padding: 10px 20px; background: #0f172a; color: #becfe7;">책 빌리러 가기</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>
</body>

</html>