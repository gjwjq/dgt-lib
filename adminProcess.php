<?php
  require_once 'db.php';
  require_once 'lib.php';
  
  $mode = $_REQUEST['mode'] ?? 'insert';

  if ($mode === 'insert') {
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

  DB::exec("insert into user (id, pw, name) values ('$id', '$pw', '$name')");
  DB::exec("insert into bookstore (name, img, id) values ('$storeName', '$filename', '$id')");
    alert('서점 및 관리자 등록 완료');
  move('admin.php');
} else if ($mode === 'update') {
  $idx = $_POST['idx'];
  $storeName = $_POST['storeName'];

  $imgSql = "";

  if(isset($_FILES['storeImg']) && $_FILES['storeImg']['name'] !== "") {
    $file = $_FILES['storeImg'];
    $filename = time() . "_" . $file['name'];
    move_uploaded_file($file['tmp_name'], "./img/" . $filename);

    $imgSql = ", img = '$filename'";
  }
  // [중요] WHERE idx = $idx 가 있어야 딱 그 서점만 바뀜
    $sql = "UPDATE bookstore SET name = '$storeName' $imgSql WHERE idx = $idx";
    
    DB::exec($sql);

    alert('수정 완료');
    move('admin.php');
} 


