
--
-- Datenbank: `boc`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `attacks`
--

DROP TABLE IF EXISTS `attacks`;
CREATE TABLE IF NOT EXISTS `attacks` (
  `attack_id` int(11) NOT NULL,
  `source_district_id` int(11) NOT NULL,
  `target_district_id` int(11) NOT NULL,
  `start_time` datetime NOT NULL,
  `battle_time` datetime NOT NULL,
  `battle_state` tinyint(1) NOT NULL DEFAULT '0',
  `attacker_won` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`attack_id`),
  FOREIGN KEY (`target_district_id`) REFERENCES `districts` (`district_id`),
  FOREIGN KEY (`source_district_id`) REFERENCES `districts` (`district_id`)
  -- KEY `source_district_id` (`source_district_id`),
  -- KEY `target_district_id` (`target_district_id`)
) ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `attack_units`
--

DROP TABLE IF EXISTS `attack_units`;
CREATE TABLE IF NOT EXISTS `attack_units` (
  `id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `attack_id` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`attack_id`) REFERENCES `attacks` (`attack_id`),
  FOREIGN KEY (`unit_id`) REFERENCES `units` (`unit_id`)
  -- UNIQUE KEY `unit_attack_unique_index` (`unit_id`,`attack_id`)
  -- KEY `unit_id` (`unit_id`),
  -- KEY `attack_id` (`attack_id`)
) ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `buildings`
--

DROP TABLE IF EXISTS `buildings`;
CREATE TABLE IF NOT EXISTS `buildings` (
  `building_id` int(11) NOT NULL,
  `building` varchar(32) NOT NULL,
  `resources` int(11) NOT NULL,
  `moral` float NOT NULL,
  `people` float NOT NULL,
  `diseases` float NOT NULL,
  `luck` float NOT NULL,
  `units_atk` float NOT NULL,
  `units_def` float NOT NULL,
  `move_speed` float NOT NULL,
  `build_speed` float NOT NULL,
  `resource_speed` float NOT NULL,
  PRIMARY KEY (`building_id`)
) ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `buildings_level`
--

DROP TABLE IF EXISTS `buildings_level`;
CREATE TABLE IF NOT EXISTS `buildings_level` (
  `id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `building_id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`building_id`) REFERENCES `buildings` (`building_id`),
  FOREIGN KEY (`district_id`) REFERENCES `districts` (`district_id`)
  -- KEY `idx_fk_district_id` (`district_id`),
  -- KEY `idx_fk_building_id` (`building_id`)
) ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `distances`
--

DROP TABLE IF EXISTS `distances`;
CREATE TABLE IF NOT EXISTS `distances` (
  `distance_id` int(11) NOT NULL,
  `district_a` int(11) NOT NULL,
  `district_b` int(11) NOT NULL,
  `time` time NOT NULL,
  `distance` float NOT NULL,
  PRIMARY KEY (`distance_id`),
  FOREIGN KEY (`district_a`) REFERENCES `districts` (`district_id`),
  FOREIGN KEY (`district_b`) REFERENCES `districts` (`district_id`)
  -- KEY `district_a` (`district_a`),
  -- KEY `district_b` (`district_b`)
) ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `districts`
--

DROP TABLE IF EXISTS `districts`;
CREATE TABLE IF NOT EXISTS `districts` (
  `district_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `district_name` varchar(32) NOT NULL,
  `position_x` int(11) NOT NULL,
  `position_y` int(11) NOT NULL,
  `district_threat` tinyint(4) NOT NULL,
  PRIMARY KEY (`district_id`),
  FOREIGN KEY (`owner_id`) REFERENCES `users` (`user_id`)
  -- KEY `owner_id` (`owner_id`)
) ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `district_status`
--

DROP TABLE IF EXISTS `district_status`;
CREATE TABLE IF NOT EXISTS `district_status` (
  `district_id` int(11) NOT NULL,
  `resources` int(11) NOT NULL,
  `moral` float NOT NULL,
  `people` int(11) NOT NULL,
  `diseases` float NOT NULL,
  `luck` float NOT NULL,
  `units_atk` float NOT NULL,
  `units_def` float NOT NULL,
  `move_speed` float NOT NULL,
  `build_speed` float NOT NULL,
  `resource_speed` float NOT NULL,
  `attacker_units` int(11) NOT NULL,
  `defender_units` int(11) NOT NULL,
  `supporter_units` int(11) NOT NULL,
  PRIMARY KEY (`district_id`),
  FOREIGN KEY (`district_id`) REFERENCES `districts` (`district_id`) ON DELETE CASCADE
) ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `district_units`
--

DROP TABLE IF EXISTS `district_units`;
CREATE TABLE IF NOT EXISTS `district_units` (
  `id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`unit_id`) REFERENCES `units` (`unit_id`),
  FOREIGN KEY (`district_id`) REFERENCES `districts` (`district_id`) ON DELETE CASCADE ON UPDATE CASCADE
  -- UNIQUE KEY `district_unit_unique_index` (`unit_id`,`district_id`)
  -- KEY `unit_id` (`unit_id`),
  -- KEY `district_id` (`district_id`)
) ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `torm_info`
--

DROP TABLE IF EXISTS `torm_info`;
CREATE TABLE IF NOT EXISTS `torm_info` (
  `id` int(1) DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `units`
--

DROP TABLE IF EXISTS `units`;
CREATE TABLE IF NOT EXISTS `units` (
  `unit_id` int(11) NOT NULL,
  `unit_name` varchar(32) NOT NULL,
  `unit_class` varchar(32) NOT NULL,
  `unit_atk` int(11) NOT NULL,
  `unit_def` int(11) NOT NULL,
  `unit_speed` int(11) NOT NULL,
  `unit_res` int(11) NOT NULL,
  PRIMARY KEY (`unit_id`)
) ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `mail` varchar(64) NOT NULL,
  `password` binary(20) NOT NULL,
  `salt` char(5) NOT NULL,
  PRIMARY KEY (`user_id`)
) ;


