-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 2018 年 10 月 20 日 03:53
-- サーバのバージョン： 5.6.38
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `gs_kadai07`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `comment` text,
  `indate` datetime NOT NULL,
  `delete_flg` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `product`
--

INSERT INTO `product` (`id`, `name`, `comment`, `indate`, `delete_flg`) VALUES
(1, 'うちの子１', 'うちの子１コメントうちの子１コメントうちの子１コメントうちの子１コメントうちの子１コメントうちの子１コメントうちの子１コメント\r\n\r\nうちの子１コメントうちの子１コメントうちの子１コメントうちの子１コメントうちの子１コメントaaa', '2018-09-24 12:00:00', 0),
(2, 'うちの子2', 'うちの子2コメントうちの子2コメントうちの子2コメントうちの子2コメントうちの子2コメントうちの子2コメントうちの子2コメント\r\nうちの子2コメントうちの子2コメントうちの子2コメント', '2018-09-26 00:00:00', 0),
(3, 'うちのこ３', 'とてもかわいい\r\n', '2018-09-26 00:00:00', 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `product_comment`
--

CREATE TABLE `product_comment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `product_id` int(11) NOT NULL,
  `star` int(11) NOT NULL,
  `indate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `product_comment`
--

INSERT INTO `product_comment` (`id`, `user_id`, `comment`, `product_id`, `star`, `indate`) VALUES
(1, 1, '親譲りの無鉄砲で小供の時から損ばかりしている。小学校に居る時分学校の二階から飛び降りて一週間ほど腰を抜かした事がある。なぜそんな無闇をしたと聞く人があるかも知れぬ。別段深い理由でもない。新築の二階から首を出していたら、同級生の一人が冗談に、いくら威張っても、そこから飛び降りる事は出来まい。弱虫やーい。と囃したからである。小使に負ぶさって帰って来た時、おやじが大きな眼をして二階ぐらいから飛び降りて腰を抜かす奴があるかと云ったから、この次は抜かさずに飛んで見せますと答えた。（青空文庫より）', 1, 5, '2018-09-23 00:00:00'),
(2, 0, 'aaaaaaa親譲りの無鉄砲で小供の時から損ばかりしている。小学校に居る時分学校の二階から飛び降りて一週間ほど腰を抜かした事がある。なぜそんな無闇をしたと聞く人があるかも知れぬ。別段深い理由でもない。新築の二階から首を出していたら、同級生の一人が冗談に、いくら威張っても、そこから飛び降りる事は出来まい。弱虫やーい。と囃したからである。小使に負ぶさって帰って来た時、おやじが大きな眼をして二階ぐらいから飛び降りて腰を抜かす奴があるかと云ったから、この次は抜かさずに飛んで見せますと答えた。（青空文庫より）', 1, 3, '2018-09-24 00:00:00'),
(3, 0, 'aaaaaaaaaaaaaaaaaaaかわいい', 1, 3, '2018-09-25 00:00:00'),
(4, 1, 'aaaaa', 1, 4, '2018-09-27 00:00:00'),
(5, 0, 'aaaaめっさかわいい', 1, 5, '2018-09-11 00:00:00'),
(6, 0, 'dotyakusokawaiどちゃくそかわいい', 1, 5, '2018-09-27 19:16:38'),
(7, 0, 'あああああかいわいい！！', 2, 2, '2018-09-27 19:17:22'),
(8, 0, 'ああああああ', 1, 3, '2018-09-29 18:00:31'),
(9, 0, 'aaaaaa', 1, 2, '2018-09-29 18:12:04');

-- --------------------------------------------------------

--
-- テーブルの構造 `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `indate` datetime NOT NULL,
  `lid` varchar(128) NOT NULL,
  `lpw` varchar(64) NOT NULL,
  `kanri_flg` int(1) NOT NULL,
  `life_flg` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `user`
--

INSERT INTO `user` (`id`, `name`, `indate`, `lid`, `lpw`, `kanri_flg`, `life_flg`) VALUES
(1, 'なまえ１', '2018-09-26 00:00:00', 'tets@tets.jp', 'test', 1, 0),
(2, 'なまえ２', '2018-09-27 00:00:00', 'test2@test.jp', 'test2', 0, 0),
(3, 'test3', '2018-10-20 02:40:25', 'test3@test.test', 'test', 0, 0),
(4, 'test4', '2018-10-20 02:42:05', 'test4@test.test', 'test', 0, 0),
(5, 'aa', '2018-10-20 02:51:46', 'aa@aa.aa', 'test', 0, 0),
(6, 'aaa', '2018-10-20 02:52:17', 'test@test.jp', 'test', 0, 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `want_list`
--

CREATE TABLE `want_list` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `indate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `want_list`
--

INSERT INTO `want_list` (`id`, `product_id`, `user_id`, `indate`) VALUES
(1, 2, 1, '0000-00-00 00:00:00'),
(2, 1, 1, '2018-09-27 22:34:33'),
(3, 1, 1, '2018-09-27 22:38:21'),
(4, 1, 1, '2018-09-29 18:00:50'),
(5, 1, 2, '2018-09-29 18:01:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_comment`
--
ALTER TABLE `product_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `want_list`
--
ALTER TABLE `want_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_comment`
--
ALTER TABLE `product_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `want_list`
--
ALTER TABLE `want_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
