<?php
require_once 'db.php'; // 이미 만드신 DB 연결 파일

try {
    // 1. 서점 테이블 생성
    DB::exec("CREATE TABLE IF NOT EXISTS `bookstore` (
        `idx` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(255) NOT NULL,
        `adminId` varchar(255) DEFAULT NULL,
        PRIMARY KEY (`idx`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    // 2. 도서 테이블 생성
    DB::exec("CREATE TABLE IF NOT EXISTS `book` (
        `idx` int(11) NOT NULL AUTO_INCREMENT,
        `storeIdx` int(11) NOT NULL,
        `title` varchar(255) NOT NULL,
        `author` varchar(255) NOT NULL,
        `content` text NOT NULL,
        `img` varchar(255) DEFAULT NULL,
        `count` int(11) DEFAULT 0,
        PRIMARY KEY (`idx`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    // 3. 대여 기록 테이블 생성
    DB::exec("CREATE TABLE IF NOT EXISTS `rent` (
        `idx` int(11) NOT NULL AUTO_INCREMENT,
        `userId` varchar(255) NOT NULL,
        `bookIdx` int(11) NOT NULL,
        `rentDate` datetime DEFAULT current_timestamp(),
        `returnDate` datetime NOT NULL,
        `status` enum('대여중','반납완료') DEFAULT '대여중',
        PRIMARY KEY (`idx`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    echo "<script>alert('모든 테이블이 성공적으로 생성되었습니다!'); location.href='index.php';</script>";
} catch (Exception $e) {
    echo "테이블 생성 중 오류 발생: " . $e->getMessage();
}