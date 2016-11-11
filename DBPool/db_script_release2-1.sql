CREATE TABLE  `car_model_notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `maker_id` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `car_model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_group` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ID for the car model.',
  PRIMARY KEY (`id`),
  UNIQUE KEY `car_model` (`car_model`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;