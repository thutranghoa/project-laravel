-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 09, 2024 lúc 06:51 PM
-- Phiên bản máy phục vụ: 10.4.27-MariaDB
-- Phiên bản PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `cuoiky`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  `content` text NOT NULL,
  `is_correct` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `content`, `is_correct`, `created_at`, `updated_at`) VALUES
(97, 1, '3', 0, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(98, 1, '4', 1, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(99, 1, '5', 0, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(100, 1, '6', 0, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(101, 2, '12', 1, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(102, 2, '15', 0, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(103, 2, '10', 0, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(104, 2, '18', 0, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(105, 3, 'Lực là nguyên nhân làm thay đổi trạng thái của vật', 1, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(106, 3, 'Lực là một đại lượng không có khối lượng', 0, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(107, 3, 'Lực không có tác dụng gì', 0, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(108, 3, 'Lực làm thay đổi trạng thái tĩnh của vật', 0, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(109, 4, 'Đặc điểm của phản lực', 1, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(110, 4, 'Đặc điểm của tác dụng lực', 1, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(111, 4, 'Lực không tương tác', 0, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(112, 4, 'Phản lực không bằng tác dụng lực', 0, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(113, 5, 'Hydrogen', 1, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(114, 5, 'Oxygen', 0, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(115, 5, 'Nitrogen', 0, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(116, 5, 'Carbon', 0, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(117, 6, 'H2 + O2 -> H2O', 1, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(118, 6, 'H2 + O2 -> H2O2', 0, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(119, 6, 'H2 + O2 -> H2', 0, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(120, 6, 'H2 + O -> H2O', 0, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(121, 7, 'Có lục lạp', 1, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(122, 7, 'Không có thành tế bào', 1, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(123, 7, 'Có nhân tế bào', 0, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(124, 7, 'Không có màng tế bào', 0, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(125, 8, 'Đoạn mã di truyền', 1, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(126, 8, 'Protein', 0, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(127, 8, 'Lipids', 0, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(128, 8, 'RNA', 0, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(129, 9, 'Trận chiến ở Verdun', 1, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(130, 9, 'Trận chiến ở Marathon', 0, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(131, 9, 'Trận chiến ở Waterloo', 0, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(132, 9, 'Trận chiến ở Normandy', 0, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(133, 10, 'Thucydides', 1, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(134, 10, 'Herodotus', 1, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(135, 10, 'Plato', 0, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(136, 10, 'Aristotle', 0, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(137, 11, 'Châu Á', 1, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(138, 11, 'Châu Âu', 0, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(139, 11, 'Châu Phi', 0, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(140, 11, 'Châu Mỹ', 0, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(141, 12, 'Sông Hồng', 1, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(142, 12, 'Sông Mekong', 0, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(143, 12, 'Sông Đồng Nai', 0, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(144, 12, 'Sông Đà', 0, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(145, 13, 'Nguyễn Du', 1, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(146, 13, 'Nguyễn Trãi', 0, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(147, 13, 'Nguyễn Bỉnh Khiêm', 0, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(148, 13, 'Nguyễn Đình Chiểu', 0, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(149, 14, 'Có sự linh hoạt', 1, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(150, 14, 'Có nhiều cấu trúc phức tạp', 1, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(151, 14, 'Có cấu trúc đơn giản', 0, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(152, 14, 'Cứng nhắc', 0, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(153, 15, 'Went', 1, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(154, 15, 'Gone', 0, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(155, 15, 'Go', 0, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(156, 15, 'Going', 0, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(157, 16, 'Cat', 1, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(158, 16, 'Run', 0, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(159, 16, 'Dog', 0, '2024-06-09 13:47:06', '2024-06-09 13:47:06'),
(160, 16, 'Bird', 0, '2024-06-09 13:47:06', '2024-06-09 13:47:06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Toán', 'Môn học về các con số và phép toán', '2024-06-09 12:55:44', '2024-06-09 12:55:44'),
(2, 'Lý', 'Môn học về vật lý', '2024-06-09 12:55:44', '2024-06-09 12:55:44'),
(3, 'Hóa', 'Môn học về hóa học', '2024-06-09 12:55:44', '2024-06-09 12:55:44'),
(4, 'Sinh', 'Môn học về sinh học', '2024-06-09 12:55:44', '2024-06-09 12:55:44'),
(5, 'Sử', 'Môn học về lịch sử', '2024-06-09 12:55:44', '2024-06-09 12:55:44'),
(6, 'Địa', 'Môn học về địa lý', '2024-06-09 12:55:44', '2024-06-09 12:55:44'),
(7, 'Văn', 'Môn học về ngữ văn', '2024-06-09 12:55:44', '2024-06-09 12:55:44'),
(8, 'Tiếng Anh', 'Môn học về tiếng Anh', '2024-06-09 12:55:44', '2024-06-09 12:55:44');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  `content` text NOT NULL,
  `type` enum('single_choice','multiple_choice') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `questions`
--

INSERT INTO `questions` (`id`, `quiz_id`, `content`, `type`, `created_at`, `updated_at`) VALUES
(1, 1, '2 + 2 bằng bao nhiêu?', 'single_choice', '2024-06-09 12:55:56', '2024-06-09 12:55:56'),
(2, 1, '4 x 3 bằng bao nhiêu?', 'single_choice', '2024-06-09 12:55:56', '2024-06-09 12:55:56'),
(3, 2, 'Định luật Newton thứ 2 nói về điều gì?', 'single_choice', '2024-06-09 12:55:56', '2024-06-09 12:55:56'),
(4, 2, 'Lực tác dụng và phản lực có đặc điểm gì?', 'multiple_choice', '2024-06-09 12:55:56', '2024-06-09 12:55:56'),
(5, 3, 'Nguyên tố hóa học nào có ký hiệu là H?', 'single_choice', '2024-06-09 12:55:56', '2024-06-09 12:55:56'),
(6, 3, 'Phản ứng hóa học nào là đúng?', 'multiple_choice', '2024-06-09 12:55:56', '2024-06-09 12:55:56'),
(7, 4, 'Tế bào động vật khác tế bào thực vật ở điểm nào?', 'multiple_choice', '2024-06-09 12:55:56', '2024-06-09 12:55:56'),
(8, 4, 'Gen là gì?', 'single_choice', '2024-06-09 12:55:56', '2024-06-09 12:55:56'),
(9, 5, 'Trận chiến nào đã đánh dấu sự kết thúc của chiến tranh thế giới thứ nhất?', 'single_choice', '2024-06-09 12:55:56', '2024-06-09 12:55:56'),
(10, 5, 'Nhà sử học nào nổi tiếng với các tác phẩm về lịch sử cổ đại?', 'multiple_choice', '2024-06-09 12:55:56', '2024-06-09 12:55:56'),
(11, 6, 'Châu lục nào lớn nhất trên thế giới?', 'single_choice', '2024-06-09 12:55:56', '2024-06-09 12:55:56'),
(12, 6, 'Sông nào dài nhất Việt Nam?', 'single_choice', '2024-06-09 12:55:56', '2024-06-09 12:55:56'),
(13, 7, 'Truyện Kiều là tác phẩm của ai?', 'single_choice', '2024-06-09 12:55:56', '2024-06-09 12:55:56'),
(14, 7, 'Cấu trúc câu trong tiếng Việt có gì đặc biệt?', 'multiple_choice', '2024-06-09 12:55:56', '2024-06-09 12:55:56'),
(15, 8, 'What is the past tense of \"go\"?', 'single_choice', '2024-06-09 12:55:56', '2024-06-09 12:55:56'),
(16, 8, 'Which of the following words is a noun?', 'multiple_choice', '2024-06-09 12:55:56', '2024-06-09 12:55:56');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Nguyen Van A', 'nguyenvana@example.com', 'hashed_password_1', 'user', '2024-06-09 12:53:39', '2024-06-09 12:53:39'),
(2, 'Tran Thi B', 'tranthib@example.com', 'hashed_password_2', 'user', '2024-06-09 12:53:39', '2024-06-09 12:53:39'),
(3, 'Le Van C', 'levanc@example.com', 'hashed_password_3', 'admin', '2024-06-09 12:53:39', '2024-06-09 12:53:39');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
