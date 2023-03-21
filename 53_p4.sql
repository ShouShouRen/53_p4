-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-03-21 08:13:28
-- 伺服器版本： 10.4.27-MariaDB
-- PHP 版本： 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `53_p4`
--

-- --------------------------------------------------------

--
-- 資料表結構 `login_log`
--

CREATE TABLE `login_log` (
  `user` varchar(100) NOT NULL,
  `login_time` datetime NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `login_log`
--

INSERT INTO `login_log` (`user`, `login_time`, `status`) VALUES
('admin', '2023-03-21 09:15:42', '登入失敗'),
('admin', '2023-03-21 09:16:44', '登入成功'),
('admin', '2023-03-21 09:47:17', '登出成功'),
('admin', '2023-03-21 09:47:46', '登入成功'),
('admin', '2023-03-21 10:18:34', '登出成功'),
('coffee', '2023-03-21 10:19:33', '登入成功'),
('coffee', '2023-03-21 10:21:59', '登出成功'),
('admin', '2023-03-21 10:22:08', '登入失敗'),
('admin', '2023-03-21 10:22:16', '登入成功'),
('admin', '2023-03-21 10:24:12', '登出成功'),
('admin', '2023-03-21 10:25:07', '登入成功'),
('admin', '2023-03-21 10:27:26', '登出成功'),
('coffee', '2023-03-21 10:29:02', '登入成功'),
('coffee', '2023-03-21 10:29:12', '登出成功'),
('admin', '2023-03-21 10:29:22', '登入成功'),
('admin', '2023-03-21 10:30:58', '登出成功'),
('user04', '2023-03-21 10:31:18', '登入失敗'),
('user03', '2023-03-21 10:31:30', '登入成功'),
('user03', '2023-03-21 10:35:22', '登出成功'),
('admin', '2023-03-21 10:47:11', '登入成功'),
('admin', '2023-03-21 13:53:25', '登出成功'),
('admin', '2023-03-21 13:53:35', '登入成功'),
('admin', '2023-03-21 14:30:21', '登出成功'),
('admin', '2023-03-21 14:43:41', '登入成功'),
('admin', '2023-03-21 14:47:38', '登出成功'),
('admin', '2023-03-21 14:49:45', '登入成功');

-- --------------------------------------------------------

--
-- 資料表結構 `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_des` text NOT NULL,
  `price` varchar(50) NOT NULL,
  `links` varchar(100) NOT NULL,
  `time` datetime NOT NULL,
  `images` varchar(100) NOT NULL,
  `template` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_des`, `price`, `links`, `time`, `images`, `template`) VALUES
(1, '咖啡商品01', '好喝的咖啡', '100', 'coffee.com', '2023-03-21 11:58:19', 'c966ea97ec364534a69cc3bda098128c.jpg', '1'),
(2, '咖啡商品02', '咖啡好好喝', '200', 'coffee.com', '2023-03-21 14:08:26', 'c757a8557f16f2471a7cf988619eecb7.jpg', '2'),
(3, '咖啡商品03', '咖啡濃醇香', '300', 'coffee.com', '2023-03-21 14:09:51', '6d8987b4db9af8fd076ecfc239de70d7.jpg', '4'),
(4, '咖啡商品04', '特調咖啡', '400', 'coffee.com', '2023-03-21 14:27:50', '9c9f7ac01e22becfd2f91b2e8d430fb1.jpg', '3');

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL,
  `pw` varchar(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `users`
--

INSERT INTO `users` (`id`, `user_id`, `user`, `pw`, `user_name`, `role`) VALUES
(1, '0000', 'admin', '1234', '超級管理員', 0),
(2, '0001', 'coffee', '1234', '咖啡使用者', 1),
(3, '0002', 'user01', '1234', '使用者01', 0),
(4, '0003', 'user02', '1234', '使用者02', 1),
(5, '0004', 'user03', '12345', '使用者03', 0);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
