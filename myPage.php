<?php 
  require_once 'header.php';
  if(!isset($_SESSION['user']) && isset($_SESSION['myIdx']) && $_SESSION['user']['id'] === 'admin') {
    back('일반 유저만 이용 가능합니다.');
    exit;
  }

  $userId = $_SESSION['user']['id'];

  $rentList = DB::fetchAll("select r.*")