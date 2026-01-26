<?php
  require_once 'db.php';
  require_once 'lib.php';
  
  $file = $_FILES['storeImg'];
  $filename = $file['name'];
  move_uploaded_file($file['tmp_name'], "./img/" . $filename);
  
  $storeName = $_POST['storeName'];
  $id = $_POST['id'];
  $pw = $_POST['pw'];
  $name = $_POST['name'];

  $check = DB::fetch("select * from user where id = '$id'");
  if($check) {
    back('이미 존재하는 ID입니다.');
    exit;
  }

  $sql_user = "insert into user (id, pw, name) values ('$id', '$pw', '$name')";
  DB::exec($sql_user);

  $sql_store = "insert into bookstore (name, img, id) values ('$storeName', '$filename', '$id')";
  DB::exec($sql_store);

  alert('서점 및 관리자 등록 완료');
  move('admin.php');