<?php
require_once 'db.php';
require_once 'lib.php';

$mode = $_REQUEST['mode'] ?? 'insert';
if ($mode !== 'delete') {
  $title = $_POST['title'];
  $author = $_POST['author'];
  $content = $_POST['content'];
  $count = $_POST['count'];
}

if ($mode === 'insert') {
  $storeIdx = $_POST['storeIdx'];

  $img = $_FILES['img'];
  $fileName = time() . "_" . $img['name'];
  move_uploaded_file($img['tmp_name'], "./img/" . $fileName);

  DB::exec("
      insert into book (storeIdx,title,author,content,img,count)
      values ('$storeIdx','$title','$author','$content','$fileName','$count')
    ");

  alert('책 등록 완료');
  move('manageBook.php');
} else if ($mode === 'update') {
  $idx = $_POST['idx'];
  $oldImg = $_POST['oldImg'];
  $imgSql = "";
  if (!empty($_FILES['img']['name'])) {
    $img = $_FILES['img'];
    $fileName = time() . "_" . $img['name'];
    move_uploaded_file($img['tmp_name'], "./img/" . $fileName);
    $finalImg = $fileName;
  } else {
    $finalImg = $oldImg;
  }
  DB::exec("update book set title='$title', author='$author', content='$content', count='$count', img='$finalImg' where idx = '$idx'");
  alert('도서 정보가 수정되었습니다.');
  move('manageBook.php');
} else if ($mode === 'delete') {
  $idx = $_GET['idx'];
  DB::exec("delete from book where idx = '$idx'");
  alert('도서가 삭제 되었습니다.');
  move('manageBook.php');
}
