<?php
  require_once 'db.php';
  require_once 'lib.php';
  if(!isset($_SESSION['user'])){
    back('로그인 후 이용이 가능합니다.');
    exit;
  }

  $userId = $_SESSION['user']['id'];
  $bookIdx = $_GET['bookIdx'] ?? '';

  if(!$bookIdx) {
    back('잘못된 접근입니다.');
    exit;
  }

  $book = DB::fetch("select * from book where idx = ?", [$bookIdx]);

  if(!$book) {
    back('존재하지 않는 도서입니다');
    exit;
  }

  if($book['count'] <= 0) {
    back('재고가 없어 대여가 불가능합니다.');
    exit;
  }

  $checkRent = DB::fetch("SELECT * FROM rent WHERE userId = ? AND status = '대여중'", [$userId]);

if ($checkRent) {
    back('이미 대여 중인 도서가 있습니다. (1인 1권 제한)');
    exit;
}

$returnDate = date("Y-m-d H:i:s", strtotime("+7 days"));
$res1 = DB::exec("INSERT INTO rent (userId, bookIdx, rentDate, returnDate, status) VALUES (?, ?, NOW(), ?, '대여중')", [
    $userId, $bookIdx, $returnDate 
]);

$res2 = DB::exec("UPDATE book SET count = count - 1 WHERE idx = ?", [$bookIdx]);

if ($res1 && $res2) {
    alert('대여가 완료되었습니다. 반납 예정일은 ' . date("Y-m-d", strtotime($returnDate)) . '입니다.');
    move('myPage.php'); 
} else {
    back('대여 처리 중 오류가 발생했습니다.');exit;
}