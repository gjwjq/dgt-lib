<?php
  require_once 'header.php';
  
  $storeIdx = $_GET['storeIdx'];
  $store = DB::fetch("select * from bookstore where idx = '$storeIdx'");
  $books = DB::fetchAll("select * from book where storeIdx = '$storeIdx'")
?>