-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 17 Sty 2022, 14:30
-- Wersja serwera: 10.4.21-MariaDB
-- Wersja PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `shop`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orders`
--

CREATE TABLE `orders` (
  `orderID` int(50) NOT NULL,
  `userID` int(50) NOT NULL,
  `fullPrice` decimal(50,0) NOT NULL,
  `orderStatus` varchar(50) NOT NULL,
  `orderDate` date NOT NULL,
  `shippedDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `orders`
--

INSERT INTO `orders` (`orderID`, `userID`, `fullPrice`, `orderStatus`, `orderDate`, `shippedDate`) VALUES
(1, 3, '233', 'Cancelled', '2022-01-16', '0000-00-00'),
(2, 3, '33', 'Processing', '2022-01-16', '0000-00-00'),
(3, 3, '4008', 'Processing', '2022-01-17', '0000-00-00'),
(4, 5, '980', 'Processing', '2022-01-17', '0000-00-00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `order_products`
--

CREATE TABLE `order_products` (
  `orderID` int(50) NOT NULL,
  `productID` int(50) NOT NULL,
  `quantity` int(50) NOT NULL,
  `price` decimal(20,0) NOT NULL,
  `discount` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `order_products`
--

INSERT INTO `order_products` (`orderID`, `productID`, `quantity`, `price`, `discount`) VALUES
(1, 2, 1, '200', '20'),
(1, 10, 1, '60', '15'),
(1, 15, 1, '10', '2'),
(2, 8, 1, '30', '5'),
(2, 15, 1, '10', '2'),
(3, 8, 1, '30', '5'),
(4, 8, 1, '30', '5'),
(5, 8, 1, '30', '5'),
(6, 8, 1, '30', '5'),
(7, 8, 1, '30', '5'),
(8, 6, 1, '2000', '0'),
(8, 8, 1, '30', '5'),
(8, 27, 1, '5', '0'),
(9, 6, 1, '2000', '0'),
(9, 8, 1, '30', '5'),
(9, 27, 1, '5', '0'),
(10, 6, 1, '2000', '0'),
(10, 8, 1, '30', '5'),
(10, 19, 1, '4', '0'),
(10, 27, 1, '5', '0'),
(11, 2, 1, '200', '20'),
(11, 6, 1, '2000', '0'),
(11, 8, 1, '30', '5'),
(11, 13, 1, '4900', '900'),
(11, 15, 1, '10', '2'),
(11, 19, 1, '4', '0'),
(11, 27, 1, '5', '0'),
(3, 13, 1, '4900', '900'),
(3, 15, 1, '10', '2'),
(4, 13, 1, '4900', '900'),
(4, 15, 1, '10', '2'),
(4, 22, 1, '1', '0'),
(4, 27, 1, '5', '0'),
(4, 2, 1, '200', '20'),
(4, 7, 1, '900', '100');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE `products` (
  `productID` int(50) NOT NULL,
  `productName` varchar(50) NOT NULL,
  `stock` int(50) NOT NULL,
  `price` decimal(50,0) NOT NULL,
  `category` varchar(30) NOT NULL,
  `attributes` varchar(100) NOT NULL,
  `promotion` int(11) DEFAULT NULL,
  `imagePath` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `products`
--

INSERT INTO `products` (`productID`, `productName`, `stock`, `price`, `category`, `attributes`, `promotion`, `imagePath`) VALUES
(1, 'Chair', 942, '76', 'furniture', 'brown', 0, 'images/chair.jpg'),
(2, 'Table', 359, '200', 'furniture', 'brown', 20, 'images/table.png'),
(3, 'Shirt', 9851, '20', 'clothing', 'black, M', 0, 'images/shirt.png'),
(4, 'Pants', 9851, '30', 'clothing', 'brown, L', 0, 'images/pants.jpg'),
(5, 'Motor', 176, '800', 'vehicles', 'black', 0, 'images/motor.jpg'),
(6, 'Motor', 45, '2000', 'vehicles', '', NULL, 'images/motor2.jpg'),
(7, 'Laptop', 13, '900', 'electronics', '', 100, 'images/laptop.png'),
(8, 'Shirt', 130, '30', 'clothes', '', 5, 'images/shirt2.jfif'),
(9, 'Aspirin', 98, '5', 'health', '', 0, 'images/aspirin.jpg'),
(10, 'Garden scissors', 66, '60', 'garden', '', 15, 'images/gardenScissors.jpg'),
(11, 'Painting', 9, '200', 'art', '', 30, 'images/painting.jpg'),
(12, 'Painting', 3, '150', 'art', '', 0, 'images/painting2.jpeg'),
(13, 'Car', 2, '4900', 'vehicles', '', 900, 'images/car.jpg'),
(14, 'Car', 4, '200', 'vehicles', '', 0, 'images/car2.jfif'),
(15, 'Colored Pencils', 91, '10', 'art', '', 2, 'images/coloredPencils.jpg'),
(16, 'Bed', 30, '400', 'furniture', '', 0, 'images/bed.jfif'),
(17, 'Wardrobe', 24, '300', 'furniture', '', 0, 'images/wardrobe.jpg'),
(18, 'Shampoo', 67, '6', 'health', '', 0, 'images/shampoo2.jpg'),
(19, 'Shampoo', 83, '4', 'health', '', 0, 'images/shampoo.png'),
(20, 'Phone', 43, '900', 'electronics', '', 0, 'images/phone.jfif'),
(21, 'Soap', 433, '2', 'health', '', 0, 'images/soap.jpg'),
(22, 'Apple', 9912, '1', 'food', '', 0, 'images/apple.jpg'),
(23, 'Lemon', 5432, '1', 'food', '', 0, 'images/lemon.jpg'),
(24, 'Lemon', 1234, '2', 'food', '2', 0, 'images/2lemons.jpg'),
(25, 'Lemon', 854, '3', 'food', '3', 0, 'images/3lemons.jpg'),
(26, 'Lemon', 341, '4', 'food', '4', NULL, 'images/4lemons.jpg'),
(27, 'Lemon', 91, '5', 'food', '5', NULL, 'images/5lemons.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `userID` int(50) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `name` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `birthday` date NOT NULL,
  `mobile` int(11) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`userID`, `login`, `password`, `email`, `name`, `surname`, `birthday`, `mobile`, `admin`) VALUES
(1, 'JohSmi', 'Abc123', 'johnsmith@gmail.com', 'John', 'Smith', '1995-10-20', 434000909, 0),
(2, 'Marlui', 'Def456', 'marioluigi@gmail.com', 'Mario', 'Luigi', '1985-09-13', 933200121, 0),
(3, 'Marbro', 'Abc123', 'marybrown@gmail.com', 'Mary', 'Brown', '2001-10-10', 898111223, 0),
(4, 'Stejon', 'Abc123', 'stevenjones@gmail.com', 'Steven', 'Jones', '1975-01-05', 707101020, 0),
(5, 'Thotho', 'Abc123', 'thomasthompson@gmail.com', 'Thomas', 'Thompson', '1991-02-28', 707070707, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user_address`
--

CREATE TABLE `user_address` (
  `userID` int(50) NOT NULL,
  `country` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `postalCode` int(10) NOT NULL,
  `city` varchar(30) NOT NULL,
  `addressLine1` varchar(30) NOT NULL,
  `addressLine2` varchar(30) NOT NULL,
  `addressLine3` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
