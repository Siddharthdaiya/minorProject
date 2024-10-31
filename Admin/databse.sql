create database realestate;



-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- Insert data...
INSERT INTO `admins` (`id`, `username`, `password`, `created_at`) VALUES
(2, 'sidd', '$2y$10$/S/vi7nZunnwvOHPeV8EBOeIsQvlimVwUGDGorFU.ofRTDRcnFv0i', '2024-09-06 15:45:47'),
(3, 'admin', '$2y$10$Nw5ND95ew8/8lhu4TD2MOei1o6g3eGisrjGSmYtaZESHj1OrLvkwm', '2024-09-06 16:11:50'),
(4, 'prashant', '$2y$10$hj8Cwe50URMgZGpWQmPgg.FakEZiMmXTVZ6zwWtrbZEM3i3B2OaHm', '2024-09-08 06:10:38');

ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;


-- Table structure for table `inquiries`
--

CREATE TABLE `inquiries` (
  `id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `inquiries` (`id`, `property_id`, `name`, `email`, `mobile`, `message`, `created_at`) VALUES
(20, 6, 'SIDDHARTH DAIYA', 'sid.daiya1230@gmail.com', '09173812260', 'am intersted in this pproperty\r\n', '2024-10-07 18:53:14'),
(21, 9, 'SIDDHARTH DAIYA', 'sid.daiya1230@gmail.com', '09173812260', 'qwerty', '2024-10-07 18:53:14'),
(22, 9, 'SIDDHARTH DAIYA', 'sid.daiya1230@gmail.com', '09173812260', 'qwert', '2024-10-07 18:53:14'),
(23, 9, 'SIDDHARTH DAIYA', 'sid.daiya1230@gmail.com', '09173812260', 'jkdvnksjvbsd', '2024-10-07 18:53:14');


-- Indexes for table `inquiries`
--
ALTER TABLE `inquiries`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inquiries`
--
ALTER TABLE `inquiries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;



CREATE TABLE `property` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `address` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `sqft` int(11) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `property`
--

INSERT INTO `property` (`id`, `name`, `price`, `address`, `image`, `sqft`, `mobile`, `email`, `created_at`, `description`) VALUES
(35, 'efnvken', 99999999.99, '202,Golden Palace', 'pexels-alex-staudinger-829197-1732414.jpg', 222, '0917381226', 'sid.daiya1230@gmail.com', '2024-10-06 07:53:43', NULL),
(36, 'qwerty', 2222220.00, '202,Golden Palace', 'carousel-2.jpg', 20111, '09173812260', 'sid.daiya1230@gmail.com', '2024-10-06 07:58:46', NULL),
(37, 'dwerfklernfwe11e1312', 1122222.00, 'minvfi', 'carousel-1.jpg', 33, '1234567890', 'sid.daiya1230@gmail.com', '2024-10-06 08:09:43', NULL);
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

--
-- Table structure for table `rentproperty`
--

CREATE TABLE `rentproperty` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `address` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `sqft` int(11) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- Dumping data for table `rentproperty`
--

INSERT INTO `rentproperty` (`id`, `name`, `price`, `address`, `image`, `sqft`, `mobile`, `email`, `created_at`) VALUES
(6, 'Pent House', 250000.00, '202,Golden Palace', 'pexels-pixabay-280229.jpg', 2500, '09173812260', 'sid.daiya1230@gmail.com', '2024-09-10 05:39:57'),
(9, 'Banglow', 8522.00, '202,Golden Palace', 'pexels-alex-staudinger-829197-1732414.jpg', 2500, '09173812260', 'sid.daiya1230@gmail.com', '2024-09-10 05:45:57'),
(10, 'surat', 789654.00, '202,Golden Palace', 'property-3.jpg', 2000, '09173812260', 'sid.daiya1230@gmail.com', '2024-09-10 05:46:35'),
(11, 'qwerty', 789787.00, '202,Golden Palace', 'pexels-fotoaibe-1643383.jpg', 12300, '09173812260', 'sid.daiya1230@gmail.com', '2024-09-10 05:50:38'),
(12, 'Palace', 85222.00, '202,Golden Palace', 'pexels-pixabay-259588.jpg', 2500, '09173812260', 'sid.daiya1230@gmail.com', '2024-09-10 05:52:03'),
(13, 'Building', 123000.00, '202,Golden Palace', 'carousel-1.jpg', 25400, '09173812260', 'sid.daiya1230@gmail.com', '2024-09-10 05:54:20'),
(15, 'mahesh cops', 256314.00, '202,Golden Palace', 'about.jpg', 25100, '09173812260', 'sid.daiya1230@gmail.com', '2024-09-12 05:01:40'),
(16, 'hiracops', 85222.00, '202,Golden Palace', 'pexels-pixabay-210617.jpg', 2500, '09173812260', 'sid.daiya1230@gmail.com', '2024-09-12 05:07:19'),
(17, 'sidmansion', 85214799.00, '202,Golden Palace', 'carousel-2.jpg', 2500, '09173812260', 'sid.daiya1230@gmail.com', '2024-09-12 05:15:54'),
(18, 'sdw', 45.00, '202,Golden Palace', 'carousel-2.jpg', 454, '09173812260', 'sid.daiya1230@gmail.com', '2024-09-12 05:29:44'),
(19, 'skyway', 74544.00, 'mumabaii', 'carousel-1.jpg', 12222, '7894561120', 'sid.daiya1230@gmail.com', '2024-10-06 08:00:34');


--
ALTER TABLE `rentproperty`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rentproperty`
--
ALTER TABLE `rentproperty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;


-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `phone`, `created_at`) VALUES
(1, 'sidd', 'sid.daiya1230@gmail.com', '$2y$10$h/QR0EvzX1782gEJCa9Ge.zSHcA.FCG84RPxtLpV3byC8WV8QeETi', '9173812260', '2024-09-17 07:14:28'),
(2, 'Pravin', 'pravin@gmail.com', '$2y$10$gjwbF1tVuh4XoQzVRhfvYubYWpYSY2g.cRcOA8.qfYRW6KhrM1JLi', '7383776050', '2024-10-07 19:05:05');
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `site_title` varchar(255) DEFAULT NULL,
  `site_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;











