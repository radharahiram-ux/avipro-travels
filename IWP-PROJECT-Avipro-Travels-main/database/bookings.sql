-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2025 at 04:30 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `avipro_travels`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `package_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `travel_date` date DEFAULT NULL,
  `persons` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` enum('pending','confirmed','cancelled') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `package_id`, `name`, `email`, `phone`, `travel_date`, `persons`, `message`, `status`, `created_at`, `updated_at`) VALUES
(4, 4, 'Rajesh Sharma', 'rajesh.sharma@gmail.com', '+91-9876543210', '2025-12-20', 4, 'Family vacation for Diwali holidays', 'confirmed', '2025-12-02 14:15:47', '2025-12-02 14:29:11'),
(5, 5, 'Priya Patel', 'priya.patel@yahoo.co.in', '+91-8765432109', '2026-01-15', 2, 'Honeymoon trip', 'pending', '2025-12-02 14:15:47', '2025-12-02 14:30:57'),
(6, 6, 'Arjun Kumar', 'arjun.k@outlook.com', '+91-7890123456', '2026-02-10', 6, 'Family reunion tour', 'confirmed', '2025-12-02 14:15:47', '2025-12-02 14:31:01'),
(7, 7, 'Sneha Reddy', 'sneha.reddy@gmail.com', '+91-8901234567', '2025-12-28', 8, 'New Year celebration with friends', 'confirmed', '2025-12-02 14:15:47', '2025-12-02 14:31:05'),
(8, 8, 'Vikram Singh', 'vikram.singh@hotmail.com', '+91-9012345678', '2026-06-15', 3, 'Adventure bike trip planning', 'pending', '2025-12-02 14:15:47', '2025-12-02 14:31:15'),
(9, 6, 'Ananya Desai', 'ananya.desai@gmail.com', '+91-8123456789', '2026-03-20', 2, 'Anniversary celebration', 'confirmed', '2025-12-02 14:15:47', '2025-12-02 14:15:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_id` (`package_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
