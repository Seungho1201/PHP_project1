-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 24-06-05 11:28
-- 서버 버전: 10.4.32-MariaDB
-- PHP 버전: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `project1`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `board`
--

CREATE TABLE `board` (
  `num` int(11) NOT NULL,
  `title` char(20) DEFAULT NULL,
  `id` char(20) DEFAULT NULL,
  `grade` int(11) DEFAULT NULL,
  `write_day` char(20) DEFAULT NULL,
  `text` char(200) DEFAULT NULL,
  `board_img` char(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 테이블 구조 `members`
--

CREATE TABLE `members` (
  `num` int(11) NOT NULL,
  `name` char(15) NOT NULL,
  `id` char(20) NOT NULL,
  `passwd` char(20) NOT NULL,
  `phone_num` char(20) NOT NULL,
  `gender` char(5) DEFAULT NULL,
  `address` char(30) NOT NULL,
  `regist_day` char(20) DEFAULT NULL,
  `grade` int(11) DEFAULT NULL,
  `profile_img` char(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `hello` char(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 테이블 구조 `members_hobby`
--

CREATE TABLE `members_hobby` (
  `id` char(20) DEFAULT NULL,
  `hobby` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `members_hobby`
--

INSERT INTO `members_hobby` (`id`, `hobby`) VALUES
('1111', 'Array'),
('1111', '차분한'),
('1111', '신나는'),
('1234', '신나는'),
('1234', '슬픈'),
('1111', '차분한'),
('1111', '신나는'),
('1111', '슬픈'),
('osh1201', '잔잔한'),
('osh1201', '차분한'),
('osh1201', '차분한'),
('osh1201', '차분한'),
('osh1201', '차분한'),
('osh1201', '신나는'),
('osh1201', '잔잔한'),
('osh1201', '차분한'),
('osh1201', '신나는'),
('wjdghks', '잔잔한');

-- --------------------------------------------------------

--
-- 테이블 구조 `members_jjim`
--

CREATE TABLE `members_jjim` (
  `id` char(20) DEFAULT NULL,
  `num` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 테이블 구조 `message`
--

CREATE TABLE `message` (
  `num` int(11) NOT NULL,
  `send_id` char(20) NOT NULL,
  `rv_id` char(20) NOT NULL,
  `subject` char(200) NOT NULL,
  `content` text NOT NULL,
  `regist_day` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `board`
--
ALTER TABLE `board`
  ADD PRIMARY KEY (`num`);

--
-- 테이블의 인덱스 `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`num`);

--
-- 테이블의 인덱스 `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`num`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `board`
--
ALTER TABLE `board`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- 테이블의 AUTO_INCREMENT `members`
--
ALTER TABLE `members`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- 테이블의 AUTO_INCREMENT `message`
--
ALTER TABLE `message`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
