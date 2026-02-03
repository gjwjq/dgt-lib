<?php
  require_once 'db.php';
  require_once 'lib.php';

  $rentIdx = $_GET['rentIdx'];
  $bookIdx = $_GET['bookIdx'];

  if (!$rentIdx || !$bookIdx) {
    back('잘못된 접근입니다.');
    exit; 
  }

  $res1 = DB::exec("update rent set status = '반납완료' where idx = '$rentIdx'");
  $res2 = DB::exec("update book set count = count + 1 where idx = '$bookIdx'");


  if($res1) {
    alert('반납이 완료되었습니다.');
    move('myPage.php');
  } else {
    back('반납에 문제가 생겼습니다.');
  }
