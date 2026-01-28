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
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <header>
        
        <div class="hdWrap">
        <div>
            <a href="./index.php" style="width: fit-content;">DGT_LIB</a>
            <div>
            <a href="./bookStore.php">BookStore</a>
            <a href="./cart.php">Cart</a>
            <a href="./myPage.php">MyPage</a>
            <?php if(isset($_SESSION['myIdx'])) { ?>
                <a href="./manageBook.php">BookManagement</a>
            <?php } ?>
            <?php if(isset($_SESSION['user']) && $_SESSION['user']['id'] === 'admin') { ?>
            <a href="./admin.php">Admin</a>
            <a href="./userlist.php">UserList</a>
            <?php } ?>
            </div>
        </div>
        <?php if(!isset($_SESSION['user'])) { ?>
        <div class="login">
            <div class="signinBtn"><span class="btn" onclick="document.querySelector('.signin').style.display = 'flex'">로그인</span> 해주세요.</div>
            <div class="signupBtn"><span class="btn" onclick="document.querySelector('.signup').style.display = 'flex'">회원가입</span>이 안되셨다면?</div>
        </div>
        <?php }  else { ?>
        <div class="login">
            <div><span style="font-size: 20px;" class="btn"><?= $_SESSION['user']['name'] ?></span>님, 환영합니다.</div>
            <a href="logout.php" class="btn" style="font-size: 13px;">로그아웃</a>
        </div>
        <?php } ?>
    </div>
    <dialog class="signin">
        <form action="signin.php" method="POST">
            <section class="closeWrap">
            <h2>로그인</h2>
            <button class="btn" type="button" onclick="document.querySelector('.signin').style.display = 'none'">X</button>
            </section>
            <div><span>id</span> <input type="text" name="id"  required></div>
            <div><span>password</span> <input type="password" name="pw"  required></div>
            <button class="btn" type="submit">로그인</button>
    </form>
    </dialog>
    <dialog class="signup">
        <form action="signup.php" method="POST">
            <section class="closeWrap">
            <h2>회원가입</h2>
            <button class="btn" type="button" onclick="document.querySelector('.signup').style.display = 'none'">X</button>
            </section>
            <div><span>id</span> <input type="text" name="id"  required></div>
            <div><span>password</span> <input type="password" name="pw"  pattern="(?=.*[A-Za-z])(?=.*[0-9])(?=.*[~!@#$%^&*]).{6,}" title="영어, 숫자, 특수문자 1개씩 포함 및 6자 이상" required></div>
            <div><span>name</span> <input type="text" name="name"  required></div>
            <button class="btn" type="submit"><span>회원가입</span></button>
    </form>
    </dialog>
    </header>
    <div style="height:100px;"></div>
</body>
</html>