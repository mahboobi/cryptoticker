-- phpMyAdmin SQL Dump
-- version 4.5.5
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2017 at 02:28 PM
-- Server version: 5.7.17
-- PHP Version: 5.5.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `lazygraph`
--

-- --------------------------------------------------------

--
-- Table structure for table `coins_hourly`
--

CREATE TABLE `coins_hourly` (
  `id` int(10) UNSIGNED NOT NULL,
  `coin_id` varchar(32) CHARACTER SET latin1 NOT NULL,
  `name` varchar(32) CHARACTER SET latin1 NOT NULL,
  `symbol` varchar(32) CHARACTER SET latin1 NOT NULL,
  `rank` smallint(5) UNSIGNED DEFAULT NULL,
  `price_usd` float UNSIGNED DEFAULT NULL,
  `price_btc` float UNSIGNED DEFAULT NULL,
  `24h_volume_usd` float UNSIGNED DEFAULT NULL,
  `market_cap_usd` float UNSIGNED DEFAULT NULL,
  `available_supply` float UNSIGNED DEFAULT NULL,
  `total_supply` float UNSIGNED DEFAULT NULL,
  `max_supply` float UNSIGNED DEFAULT NULL,
  `percent_change_1h` decimal(6,2) DEFAULT NULL,
  `percent_change_24h` decimal(6,2) DEFAULT NULL,
  `percent_change_7d` decimal(6,2) DEFAULT NULL,
  `last_updated` int(10) UNSIGNED NOT NULL,
  `month` varchar(7) CHARACTER SET latin1 NOT NULL COMMENT 'yy-mm',
  `date` date NOT NULL,
  `hour` tinyint(4) NOT NULL,
  `insert_ts` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coins_hourly`
--
ALTER TABLE `coins_hourly`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coin_id` (`coin_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coins_hourly`
--
ALTER TABLE `coins_hourly`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;