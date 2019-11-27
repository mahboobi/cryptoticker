ALTER TABLE `coins_meta` CHANGE `coin_id` `coin_id` VARCHAR(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL, CHANGE `name` `name` VARCHAR(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;

ALTER TABLE `coins_hourly` CHANGE `coin_id` `coin_id` VARCHAR(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL, CHANGE `name` `name` VARCHAR(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;

ALTER TABLE `coins_meta` ADD INDEX(`symbol`);