
CREATE TABLE `coins_binance` (
  `id` int(10) UNSIGNED NOT NULL,
  `base_currency` varchar(12) CHARACTER SET latin1 NOT NULL,
  `coin_symbol` varchar(12) CHARACTER SET latin1 NOT NULL,
  `symbol` varchar(12) CHARACTER SET latin1 NOT NULL,
  `priceChange` float NOT NULL,
  `priceChangePercent` float NOT NULL,
  `weightedAvgPrice` float UNSIGNED NOT NULL,
  `prevClosePrice` float UNSIGNED NOT NULL,
  `lastPrice` float UNSIGNED NOT NULL,
  `lastQty` float UNSIGNED NOT NULL,
  `bidPrice` float UNSIGNED NOT NULL,
  `bidQty` float UNSIGNED NOT NULL,
  `askPrice` float UNSIGNED NOT NULL,
  `askQty` float UNSIGNED NOT NULL,
  `openPrice` float UNSIGNED NOT NULL,
  `highPrice` float UNSIGNED NOT NULL,
  `lowPrice` float UNSIGNED NOT NULL,
  `volume` float UNSIGNED NOT NULL,
  `quoteVolume` float UNSIGNED NOT NULL,
  `openTime` int(13) UNSIGNED NOT NULL,
  `closeTime` int(13) UNSIGNED NOT NULL,
  `month` varchar(7) CHARACTER SET latin1 NOT NULL,
  `date` date NOT NULL,
  `insert_ts` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coins_binance`
--
ALTER TABLE `coins_binance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `symbol` (`symbol`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coins_binance`
--
ALTER TABLE `coins_binance`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;





CREATE TABLE `coins_bitfinex` (
  `id` int(10) UNSIGNED NOT NULL,
  `coin_symbol` varchar(12) CHARACTER SET latin1 NOT NULL,
  `base_currency` varchar(12) CHARACTER SET latin1 NOT NULL,
  `pair` varchar(12) CHARACTER SET latin1 NOT NULL,
  `bid` float UNSIGNED NOT NULL,
  `ask` float UNSIGNED NOT NULL,
  `mid` float UNSIGNED NOT NULL,
  `last_price` float UNSIGNED NOT NULL,
  `low` float UNSIGNED NOT NULL,
  `high` float UNSIGNED NOT NULL,
  `volume` float UNSIGNED NOT NULL,
  `timestamp` float UNSIGNED NOT NULL,
  `month` varchar(7) CHARACTER SET latin1 NOT NULL,
  `date` date NOT NULL,
  `insert_ts` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coins_bitfinex`
--
ALTER TABLE `coins_bitfinex`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pair` (`pair`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coins_bitfinex`
--
ALTER TABLE `coins_bitfinex`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;