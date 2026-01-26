<?php
  require_once 'db.php';
  require_once 'lib.php';
  session_start();

  $id = $_POST['id'];
  $pw = $_POST['pw'];
  $name = $_POST['name'];

  $check = DB::fetch("select * from user where id = '$id'");
  if($check) {
    back('id가 이미 존재합니다.');exit;
  }

  $sql = "insert into user (id, pw, name) values ('$id','$pw','$name')";
  DB::exec($sql);

  alert('회원가입 완료');
  move('index.php');