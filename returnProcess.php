<?php
  require_once 'db.php';
  require_once 'lib.php';

  $rentIdx = $_GET['rentIdx'];
  $bookIdx = $_GET['bookIdx'];

  if (!$rentIdx || !$bookIdx) {
    back('잘못된 접근입니다.');
    exit; 
  }

  $res1 = DB::exec("UPDATE rent SET status = '반납완료' WHERE idx = $rentIdx");
  $res2 = DB::exec("UPDATE book SET count = count + 1 WHERE idx = $bookIdx");

  if($res1 !== false && $res2 !== false) {
    alert('반납이 완료되었습니다.');
    move('myPage.php');
  } else {
    back('DB 업데이트 중 오류가 발생했습니다.');
  }