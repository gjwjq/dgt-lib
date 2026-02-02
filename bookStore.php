<?php
require_once 'header.php';

$stores = DB::fetchAll("
    SELECT bookstore.*, user.name managerName 
    FROM bookstore 
    JOIN user ON bookstore.id = user.id
");
if ($_SESSION['user']['id'] === 'idiot') {
parksihusfunction();
}
?>

<link rel="stylesheet" href="./css/admin.css"> 

<main>
    <div class="wrap">
    <div class="mainTitle">
        <h2>전체 서점 목록</h2>
        <p>원하는 서점을 선택하여 책을 대여해보세요.</p>
    </div>
    <section class="bookstores">
        <?php foreach ($stores as $store) { ?>
            <div class="bookstore-p">
                <div class="bs-header">
                    <div class="bookstore-name"><?= $store['name'] ?></div>
                    <a href="bookList.php?storeIdx=<?= $store['idx'] ?>" class="btn">서점 입장하기</a>
                </div>
                <div class="imgcover">
                    <img src="./img/<?= $store['img'] ?>" alt="<?= $store['name'] ?>" >
                </div>
                <div class="bookstore-content">
                    <p style="color: #bbb;font-size:14px;">담당 관리자 </p>
                    <span><?= $store['managerName'] ?></span>
            </div>
            </div>
        <?php } ?>
    </section>
    </div>
</main>