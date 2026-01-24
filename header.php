<?php
    require_once 'db.php';
    require_once 'lib.php';
    if(!isset($_SESSION)) session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/main.css">
</head>
<body>
    <header>
        
        <div class="hdWrap">
        <div>
            <a href="./index.php">DGT_LIB</a>
            <div>
            <a href="./bookStore.php">BookStore</a>
            <a href="./cart.php">Cart</a>
            <a href="./myPage.php">MyPage</a>
            </div>
        </div>
        <div class="login">
            <div class="signinBtn"><span class="btn">로그인</span> 해주세요.</div>
            <div class="signupBtn"><span class="btn">회원가입</span>이 안되셨다면?</div>
        </div>
    </div>
    </header>
</body>
</html>