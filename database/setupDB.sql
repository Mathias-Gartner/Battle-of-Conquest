
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `boc`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `active_units`
--

CREATE TABLE IF NOT EXISTS `active_units` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `district_id` int(11) NOT NULL,
  `target_district_id` int(11) NOT NULL,
  `attacker` int(11) NOT NULL,
  `defender` int(11) NOT NULL,
  `supporter` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_fk_district_id` (`district_id`),
  KEY `idx_fk_target_district_id` (`target_district_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `buildings`
--

CREATE TABLE IF NOT EXISTS `buildings` (
  `building_id` int(11) NOT NULL AUTO_INCREMENT,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `buildings_level`
--

CREATE TABLE IF NOT EXISTS `buildings_level` (
  `id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `building_id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_fk_district_id` (`district_id`),
  KEY `idx_fk_building_id` (`building_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `distances`
--

CREATE TABLE IF NOT EXISTS `distances` (
  `distance_id` int(11) NOT NULL AUTO_INCREMENT,
  `district_a` int(11) NOT NULL,
  `district_b` int(11) NOT NULL,
  `time` time NOT NULL,
  `distance` float NOT NULL,
  PRIMARY KEY (`distance_id`),
  KEY `district_a` (`district_a`),
  KEY `district_b` (`district_b`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `districts`
--

CREATE TABLE IF NOT EXISTS `districts` (
  `district_id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) NOT NULL,
  `district_name` varchar(32) NOT NULL,
  `position_x` int(11) NOT NULL,
  `position_y` int(11) NOT NULL,
  `district_threat` tinyint(4) NOT NULL,
  PRIMARY KEY (`district_id`),
  KEY `owner_id` (`owner_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `torm_info`
--

CREATE TABLE IF NOT EXISTS `torm_info` (
  `id` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `units`
--

CREATE TABLE IF NOT EXISTS `units` (
  `unit_id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_name` varchar(32) NOT NULL,
  `unit_class` varchar(32) NOT NULL,
  `unit_atk` int(11) NOT NULL,
  `unit_def` int(11) NOT NULL,
  `unit_speed` int(11) NOT NULL,
  `unit_res` int(11) NOT NULL,
  PRIMARY KEY (`unit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `mail` varchar(64) NOT NULL,
  `password` binary(20) NOT NULL,
  `salt` char(5) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `active_units`
--
ALTER TABLE `active_units`
  ADD CONSTRAINT `fk_active_unit_district` FOREIGN KEY (`district_id`) REFERENCES `districts` (`district_id`),
  ADD CONSTRAINT `fk_active_unit_target_district` FOREIGN KEY (`target_district_id`) REFERENCES `districts` (`district_id`);

--
-- Constraints der Tabelle `buildings_level`
--
ALTER TABLE `buildings_level`
  ADD CONSTRAINT `fk_building` FOREIGN KEY (`building_id`) REFERENCES `buildings` (`building_id`),
  ADD CONSTRAINT `fk_building_level_district` FOREIGN KEY (`district_id`) REFERENCES `districts` (`district_id`);

--
-- Constraints der Tabelle `distances`
--
ALTER TABLE `distances`
  ADD CONSTRAINT `fk_district_a` FOREIGN KEY (`district_a`) REFERENCES `districts` (`district_id`),
  ADD CONSTRAINT `fk_district_b` FOREIGN KEY (`district_b`) REFERENCES `districts` (`district_id`);

--
-- Constraints der Tabelle `districts`
--
ALTER TABLE `districts`
  ADD CONSTRAINT `fk_owner` FOREIGN KEY (`owner_id`) REFERENCES `users` (`user_id`);

