-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2018 at 08:46 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assets`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `description` varchar(30) NOT NULL,
  `expirydate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `value`, `description`, `expirydate`) VALUES
(13, 'Cardillac Limo', '8000000.00', 'Black SUV', '2019-09-08'),
(14, 'Crown Paint', '30000.00', 'Blue paint', '2020-03-16'),
(15, 'Clean Washing Detergents', '10000.00', 'Surface cleaner', '2019-04-28'),
(17, 'Hp Server', '550000.00', 'Company Server', '2020-12-31'),
(18, 'Hp Laptops', '850000.00', 'User Laptops', '2025-12-31'),
(26, 'Total Gas', '24533.00', '20Kg Cylinder', '2019-02-21'),
(27, 'Konica Printer', '2334565.00', 'C268', '2019-04-06'),
(28, 'Konica Printer', '2334565.00', 'C320', '2019-04-06'),
(29, 'Total Gas', '12344.00', '10Kg Cylinder', '2019-01-12'),
(30, 'Kyocera Printer', '200000.00', 'Version 3', '2030-07-26');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `name` varchar(15) NOT NULL,
  `description` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`, `description`) VALUES
(9, 'Nakuru', 'County Office'),
(11, 'Nairobi', 'Branch Office'),
(13, 'Naivasha', 'Main Warehouse'),
(15, 'Nairobi', 'Main Office'),
(16, 'Turkana', 'Branch Office'),
(17, 'Kiambu', 'Branch Office'),
(18, 'Eldoret', 'Branches'),
(19, 'Kitale', 'Branches');

-- --------------------------------------------------------

--
-- Table structure for table `responsibility`
--

CREATE TABLE `responsibility` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `description` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `responsibility`
--

INSERT INTO `responsibility` (`id`, `userid`, `startdate`, `enddate`, `description`) VALUES
(19, 31, '2018-03-12', '2018-03-31', 'HR');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(15) DEFAULT NULL,
  `lastname` varchar(15) DEFAULT NULL,
  `emailaddress` text,
  `idnumber` int(9) DEFAULT NULL,
  `dateofbirth` date DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `phone` varchar(13) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `emailaddress`, `idnumber`, `dateofbirth`, `gender`, `phone`, `password`) VALUES
(27, 'Susan', 'W', 'susanw@mail.com', 1234567834, '1994-11-17', 'Female', '+254712345623', '$2y$10$KujrD4jxz5PQdKLmCrLUo.ql1vU7m6Sgog83FvcCrG/Jv/LTbXlKG'),
(28, 'Ann', 'Wayne', 'annwayne@mail.com', 1234567854, '1994-11-17', 'Female', '+254712345667', '$2y$10$coqRx9IsITf1OfarfNoF0.8NlNfQhH4HRR09esy.xdI7FO2pmPFCi'),
(30, 'Stephen', 'Kamau', 'stephen2k@mail.com', 123456789, '1992-10-26', 'Male', '+254712345678', '$2y$10$kEESJcwXvmYbpin.B3Ezyebcf55g7LauoqDX6YD9ITgyfZf0Zfwui'),
(31, 'Stephen', 'Larry', 'larrysteve@mail.com', 1234567899, '1989-02-12', 'Male', '+254712345690', '$2y$10$MUAF4j8.IpK/4e1Oczpmc.Q0GxTAkN8GrMhu91pH8IN0MXYSA0tqi'),
(35, 'David', 'Kinyanjui', 'david@mail.com', 123456783, '1989-08-12', 'Male', '+254712345678', '$2y$10$eT77I.YWftC0HPSTrAzjQu4HX7pwtDvEZDKt6YzDrXh.6/RQn1Mey'),
(36, 'David', 'Kinyanjui', 'david12@mail.com', 123456345, '1990-03-12', 'Male', '+254712345679', '$2y$10$V4v5OZK6sQvE59lpjgItvOZ9JzJOiP8zbV6rkUzSZXs6vuP86kGx2'),
(37, 'Evans', 'Kinyanjui', 'david14@mail.com', 123456098, '1978-05-03', 'Male', '+254712345679', '$2y$10$FEufe6WbuoheyrNNOQ/OfuVRZ6QhHxUm8x6ygVn.Q7D865H1/Dc36'),
(41, 'Winnie', 'Mi', 'winnie@mail.com', 123456707, '1999-04-12', 'Female', '+254712345678', '$2y$10$a8hIaGEDt2lsaT8eT2QkT.FoeSFMHHGeIp2xbU9wTdEqAbE2eZGP6'),
(42, 'Stephen', 'K', 'stephenk@mail.com', 123456097, '1978-03-12', 'Male', '+254712345678', '$2y$10$FuTjv64iLDHZfWPSgT4iFeWBpi3EH.c90898Hkv7/nbp8wTsWGCGy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `responsibility`
--
ALTER TABLE `responsibility`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userpriviledges` (`userid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `responsibility`
--
ALTER TABLE `responsibility`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `responsibility`
--
ALTER TABLE `responsibility`
  ADD CONSTRAINT `userpriviledges` FOREIGN KEY (`userid`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
