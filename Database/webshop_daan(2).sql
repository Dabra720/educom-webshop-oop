-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2023 at 08:15 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webshop_daan`
--

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `date`, `user_id`) VALUES
(1, '0000-00-00', 1),
(2, '2023-03-08', 1),
(3, '2023-03-08', 1),
(4, '2023-03-08', 4),
(5, '2023-03-08', 4),
(6, '2023-03-10', 1),
(7, '2023-03-15', 1),
(8, '2023-03-15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_row`
--

CREATE TABLE `invoice_row` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice_row`
--

INSERT INTO `invoice_row` (`id`, `invoice_id`, `product_id`, `quantity`) VALUES
(1, 1, 1, 4),
(2, 1, 2, 4),
(3, 2, 1, 4),
(4, 2, 2, 4),
(5, 2, 5, 6),
(6, 3, 1, 1),
(7, 3, 2, 2),
(8, 4, 3, 5),
(9, 4, 4, 20),
(10, 5, 1, 8),
(11, 5, 2, -5),
(12, 6, 1, 8),
(13, 6, 2, 3),
(14, 6, 4, 4),
(15, 6, 3, 4),
(16, 7, 1, 1),
(17, 7, 5, 15),
(18, 8, 1, 1),
(19, 8, 5, 15);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `filename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `filename`) VALUES
(1, 'XXL Shaker zwart (bidon) 800ml', 'Shaker\n\nMaak in slechts een handomdraai de lekkerste en egale eiwitshakes met gebruik van de XXL Nutrition Shaker! Deze shaker is voorzien van een raster zodat je met slechts een paar keer shaken al de lekkerste en luchtigste eiwitshakes maakt. Dit doe je door op locatie de shake te bereiden, of een shake te maken en deze vervolgens mee te nemen. Maar let op; vervoer de XXL Nutrition Shaker altijd rechtop wanneer deze gevuld is om te voorkomen dat de shaker gaat lekken. De Shaker is voorzien van handige maataanduiding zodat je zeker weet dat je altijd jouw favoriete verhouding kunt aanhouden. En met een inhoud van 800ml is de XXL Nutrition Shaker ook ideaal om grote hoeveelheden shakes in één keer te maken.\n\nGebruik\n\nVoor een optimale en egale eiwitshake vul je de beker eerst met water of melk, en voeg je daarna pas het eiwitpoeder toe. Plaats het raster op de beker en schroef de dop stevig vast. Even schudden en je kunt van een heerlijke eiwitshake genieten, die je door de handige drinkdop direct uit de shaker drinkt.\n\n \n\n    Inhoud 800 ml\n    Vrij van giftige DEHP en BPA\n    Handige maataanduiding tot 700ml.\n    Voorzien van een raster.', '7.95', 'xxl_bidon.png'),
(2, 'Whey Delicious 1000g Eiwitshake Vannilla', 'Whey Delicious\r\nMaak kennis met Whey Delicious; volgens vele gebruikers de lekkerste eiwitshake op de markt! Whey Delicious zit boordevol hoogwaardige wei-eiwitten, BCAA’s en glutamine en met een eiwitpercentage van 80% werk je gemakkelijk aan een hoge eiwit-inname. Het is ons tevens gelukt om zonder gebruik van toegevoegde suikers, en slechts een kleine hoeveelheid zoetstoffen (0,17%), een proteïne shake te maken die zó lekker is dat je hem de hele dag door wilt blijven drinken.', '29.95', 'whey_delicious_vanilla_1000g.png'),
(3, 'Whey Delicious 1000g Eiwitshake Raspberry/kiwi', 'Whey Delicious\r\nMaak kennis met Whey Delicious; volgens vele gebruikers de lekkerste eiwitshake op de markt! Whey Delicious zit boordevol hoogwaardige wei-eiwitten, BCAA’s en glutamine en met een eiwitpercentage van 80% werk je gemakkelijk aan een hoge eiwit-inname. Het is ons tevens gelukt om zonder gebruik van toegevoegde suikers, en slechts een kleine hoeveelheid zoetstoffen (0,17%), een proteïne shake te maken die zó lekker is dat je hem de hele dag door wilt blijven drinken.', '29.95', 'whey_delicious_raspberry_kiwi_1000g.png'),
(4, 'Whey Delicious 1000g Eiwitshake Coconut', 'Whey Delicious\r\nMaak kennis met Whey Delicious; volgens vele gebruikers de lekkerste eiwitshake op de markt! Whey Delicious zit boordevol hoogwaardige wei-eiwitten, BCAA’s en glutamine en met een eiwitpercentage van 80% werk je gemakkelijk aan een hoge eiwit-inname. Het is ons tevens gelukt om zonder gebruik van toegevoegde suikers, en slechts een kleine hoeveelheid zoetstoffen (0,17%), een proteïne shake te maken die zó lekker is dat je hem de hele dag door wilt blijven drinken.', '29.95', 'whey_delicious_coconut_1000g.png'),
(5, 'Creatine Monohydraat 500g', 'Het waarschijnlijk meest gebruikte voedingssupplement wereldwijd is creatine. En dit is niet voor niets; er zijn namelijk talloze onderzoeken die de werking van creatine wetenschappelijk bewijzen. Bij een dagelijkse inname van 3 gram helpt creatine je prestaties te verbeteren en ondersteunt het spieropbouw bij explosieve krachtinspanningen. Creatine is niet alleen geschikt voor krachttraining, maar ook voor bijvoorbeeld een intensieve sprinttraining. De Creatine van XXL Nutrition bestaat uitsluitend uit zuivere, microfijne monohydraat. Zo weet je zeker dat er geen onnodige grondstoffen inzitten en je creatine in zijn puurste vorm gebruikt.', '18.95', 'creatine_monohydate_500g.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `admin`) VALUES
(1, 'Daan Braas', 'dbraas@gmail.com', 'test', 1),
(2, 'Kim Cena', 'Bing@chilling.com', 'ching', 0),
(3, 'Johnny Bravo', 'j.bravo@strong.de', 'bravo', 0),
(4, 'Test', 'test@test.test', 'test', 0),
(5, 'Daan', 'daan_braas@hotmail.com', 'test', 0),
(6, 'Iphone', 'I@phone.ios', 'ios', 0),
(7, 'tester', 'tester@test.test', 'tester', 0),
(8, 'Dana', 'dana@mail.nl', 'test', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `invoice_row`
--
ALTER TABLE `invoice_row`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_id` (`invoice_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `invoice_row`
--
ALTER TABLE `invoice_row`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `invoice_row`
--
ALTER TABLE `invoice_row`
  ADD CONSTRAINT `invoice_id` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`id`),
  ADD CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
