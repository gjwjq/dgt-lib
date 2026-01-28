<?php
  require_once 'db.php';
  require_once 'lib.php';

  $mode = $_POST['mode'];
  $storeIdx = $_POST['storeIdx'];
  $title = $_POST['title'];
  $content = $_POST['content'];
  $count = $_POST['count'];

  if ($mode === 'insert') {
    $img = $_FILES['img'];
    $fileName = time() . "_" . $img['name'];
    move_uploaded_file($img['tmp_name'], "./img/" . $fileName);

    DB::exec("
      insert into book (storeIdx,title,content,img,count)
      values ('$storeIdx','$title','$content','$fileName','$count')
    ");

    alert('책 등록 완료');
    move('manageBook.php');
  }