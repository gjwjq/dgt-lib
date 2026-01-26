<?php
  require_once 'lib.php';
  session_start();
  session_destroy();
  alert('로그아웃 되었습니다.');
  move('index.php'); 
  exit;