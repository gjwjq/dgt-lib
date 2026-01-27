<?php
require_once 'db.php';
require_once 'lib.php';

$idx = $_GET['idx'];

DB::exec("delete from bookstore where idx = '$idx'");

alert('삭제가 완료되었습니다.');
move('admin.php');