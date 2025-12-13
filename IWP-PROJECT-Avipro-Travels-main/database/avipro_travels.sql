-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2025 at 04:31 PM
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
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password_hash`, `email`, `full_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin123', 'admin@aviprotravels.com', 'Administrator', '2025-11-29 05:38:38', '2025-12-02 14:03:28');

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

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

CREATE TABLE `enquiries` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` enum('new','read','replied') DEFAULT 'new',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enquiries`
--

INSERT INTO `enquiries` (`id`, `name`, `email`, `subject`, `message`, `status`, `created_at`) VALUES
(1, 'Robert Wilson', 'robert@email.com', 'Group Booking', 'I would like to inquire about group booking rates for 15 people.', 'new', '2025-11-29 05:38:39'),
(2, 'Emily Chen', 'emily@email.com', 'Custom Package', 'Do you offer custom travel packages for specific destinations?', 'new', '2025-11-29 05:38:39'),
(3, 'Amit Verma', 'amit.verma@gmail.com', 'Group Booking for Corporate Offsite', 'We are planning a corporate offsite for 25 employees in March. Can you customize a package for Goa?', 'new', '2025-12-02 14:15:47'),
(4, 'Neha Joshi', 'neha.joshi@yahoo.com', 'Honeymoon Package Query', 'Looking for a romantic honeymoon package in Kerala for 7 days. Do you provide candlelight dinner arrangements?', 'new', '2025-12-02 14:15:47'),
(5, 'Ravi Menon', 'ravi.menon@outlook.com', 'Char Dham Yatra Package', 'Do you offer Char Dham Yatra packages for senior citizens? We need special assistance facilities.', 'new', '2025-12-02 14:15:47'),
(6, 'Deepika Nair', 'deepika.nair@gmail.com', 'Custom South India Temple Tour', 'We want to visit major temples in Tamil Nadu and Karnataka for 10 days. Can you arrange a religious tour?', 'new', '2025-12-02 14:15:47'),
(7, 'Suresh Iyer', 'suresh.iyer@hotmail.com', 'International Tour from India', 'Do you arrange international tours from India? Looking for Singapore-Malaysia-Thailand package.', 'new', '2025-12-02 14:15:47');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `duration` varchar(100) DEFAULT NULL,
  `destination` varchar(255) DEFAULT NULL,
  `image_url` varchar(500) DEFAULT NULL,
  `itinerary` text DEFAULT NULL,
  `inclusions` text DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `title`, `description`, `price`, `duration`, `destination`, `image_url`, `itinerary`, `inclusions`, `is_active`, `created_at`, `updated_at`) VALUES
(4, 'Golden Triangle Tour', 'Discover India\'s rich heritage with our classic Golden Triangle tour covering Delhi, Agra, and Jaipur.', 25999.00, '6 Days / 5 Nights', 'Delhi, Agra, Jaipur', 'golden-triangle.jpg', 'Day 1: Arrival in Delhi... Day 2: Delhi sightseeing... Day 3: Delhi to Agra (Taj Mahal)... Day 4: Agra to Jaipur... Day 5: Jaipur city tour... Day 6: Departure', '5 nights accommodation, Daily breakfast, AC transportation, Guide services, Monument entry fees', 1, '2025-12-02 14:15:47', '2025-12-02 14:15:47'),
(5, 'Kashmir Paradise Package', 'Experience heaven on earth with our Kashmir tour package including Srinagar, Gulmarg, and Pahalgam.', 34999.00, '7 Days / 6 Nights', 'Kashmir', 'kashmir-tour.jpg', 'Day 1: Arrival in Srinagar (Houseboat stay)... Day 2: Srinagar local sightseeing... Day 3: Srinagar to Gulmarg... Day 4: Gulmarg to Pahalgam... Day 5: Pahalgam sightseeing... Day 6: Return to Srinagar... Day 7: Departure', '6 nights accommodation (2 nights houseboat), All meals, Shikara ride, Gondola ride in Gulmarg', 1, '2025-12-02 14:15:47', '2025-12-02 14:15:47'),
(6, 'Kerala Backwaters Experience', 'Relax in God\'s Own Country with our Kerala package including houseboat stay and Ayurveda treatments.', 28999.00, '5 Days / 4 Nights', 'Kerala', 'kerala-backwaters.jpg', 'Day 1: Arrival in Kochi... Day 2: Kochi to Alleppey (Houseboat)... Day 3: Alleppey to Munnar... Day 4: Munnar sightseeing... Day 5: Departure', '4 nights accommodation (1 night houseboat), Daily breakfast, Ayurvedic massage, Kathakali show, All transfers', 1, '2025-12-02 14:15:47', '2025-12-02 14:15:47'),
(7, 'Goa Beach Holiday', 'Enjoy sun, sand, and sea with our Goa beach holiday package perfect for couples and families.', 21999.00, '5 Days / 4 Nights', 'Goa', 'goa-beach.jpg', 'Day 1: Arrival in Goa... Day 2: North Goa beaches... Day 3: South Goa beaches... Day 4: Free day for water sports... Day 5: Departure', '4 nights beach resort stay, Daily breakfast, Airport transfers, One dinner cruise, Watersports discount', 1, '2025-12-02 14:15:47', '2025-12-02 14:15:47'),
(8, 'Ladakh Adventure Trip', 'Thrill-seeking adventure in the Himalayas with Leh, Nubra Valley, and Pangong Lake.', 41999.00, '8 Days / 7 Nights', 'Ladakh', 'ladakh-adventure.jpg', 'Day 1: Arrival in Leh... Day 2: Leh acclimatization... Day 3: Leh local sightseeing... Day 4: Leh to Nubra Valley... Day 5: Nubra to Pangong... Day 6: Pangong to Leh... Day 7: Leh monastery tour... Day 8: Departure', '7 nights accommodation, All meals, Inner Line Permits, Oxygen cylinders, Experienced driver', 1, '2025-12-02 14:15:47', '2025-12-02 14:15:47'),
(9, 'Andaman Island Escape', 'Explore pristine beaches and marine life in the Andaman Islands.', 37999.00, '6 Days / 5 Nights', 'Andaman', 'andaman-islands.jpg', 'Day 1: Arrival in Port Blair... Day 2: Cellular Jail & Light Show... Day 3: Port Blair to Havelock... Day 4: Radhanagar Beach... Day 5: Havelock to Neil Island... Day 6: Departure', '5 nights accommodation, Daily breakfast, Cruise tickets, Snorkeling trip, All inter-island transfers', 1, '2025-12-02 14:15:47', '2025-12-02 14:15:47');

-- --------------------------------------------------------

--
-- Table structure for table `site_content`
--

CREATE TABLE `site_content` (
  `id` int(11) NOT NULL,
  `page` varchar(100) DEFAULT NULL,
  `section` varchar(100) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_id` (`package_id`);

--
-- Indexes for table `enquiries`
--
ALTER TABLE `enquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_content`
--
ALTER TABLE `site_content`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `enquiries`
--
ALTER TABLE `enquiries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `site_content`
--
ALTER TABLE `site_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
