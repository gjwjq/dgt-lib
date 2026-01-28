<?php
  require_once 'db.php';
  require_once 'lib.php';
  if(!isset($_SESSION)) session_start();

  $id = $_POST['id'];
  $pw = $_POST['pw'];

  $user = DB::fetch("select * from user where id = '$id'");
  if($user) {
    $_SESSION['user'] = $user;

    $store = DB::fetch("select * from bookstore where id = '{$user['id']}'");
    if($store) {
      $_SESSION['myIdx'] = $store['idx'];
      alert("서점 관리자님 환영합니다.");
      move('manageBook.php');
    } else {
    alert('로그인 되었습니다.');
    move('index.php');
    }
  } else {
    back('비밀번호가 맞지 않아요');
    exit;
  }