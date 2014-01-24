
SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT=0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `boc`
--

--
-- Daten für Tabelle `attacks`
--

INSERT INTO `attacks` (`attack_id`, `source_district_id`, `target_district_id`, `battle_time`) VALUES
(1, 1, 2, '2013-12-28 15:57:41');

--
-- Daten für Tabelle `districts`
--

INSERT INTO `districts` (`district_id`, `owner_id`, `district_name`, `position_x`, `position_y`, `district_threat`) VALUES
(1, 1, 'Abadan', 1, 1, 0),
(2, 2, 'Nahavand', 5, 5, 0),
(3, 2, 'Varamin', 1, 5, 0),
(4, 2, 'Parsa', 2, 5, 0),
(5, 2, 'Qutschan', 3, 5, 0),
(6, 2, 'Rezaiyeh', 4, 5, 0),
(7, 2, 'Amol', 5, 1, 0),
(8, 2, 'Zahedan', 5, 2, 0),
(9, 2, 'Yazd', 5, 3, 0),
(10, 2, 'Babol', 5, 4, 0),
(11, 2, 'Sirdschan', 4, 1, 0),
(12, 2, 'Zabol', 4, 2, 0),
(13, 2, 'Ekbatana', 4, 3, 0),
(14, 2, 'Chark', 4, 4, 0),
(15, 2, 'Ardakan', 3, 1, 0),
(16, 2, 'Hamedan', 3, 2, 0),
(17, 2, 'Teheran', 3, 3, 0),
(18, 2, 'Damqan', 1, 3, 0),
(19, 2, 'Kaschan', 2, 3, 0);

--
-- Daten für Tabelle `district_units`
--

INSERT INTO `district_units` (`id`, `unit_id`, `district_id`, `count`) VALUES
(1, 1, 1, 10),
(2, 2, 2, 5);

--
-- Daten für Tabelle `torm_info`
--

INSERT INTO `torm_info` (`id`) VALUES
(1);

--
-- Daten für Tabelle `units`
--

INSERT INTO `units` (`unit_id`, `unit_name`, `unit_class`, `unit_atk`, `unit_def`, `unit_speed`, `unit_res`) VALUES
(1, 'Swordsman', 'Offensiv', 10, 5, 5, 100),
(2, 'Knight', 'Offensiv', 15, 8, 20, 250);

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`user_id`, `username`, `age`, `mail`, `password`, `salt`) VALUES
(1, 'admin', 1, 'admin@localhost.com', unhex('a421de3a817384f7d069b417197eebe01e0a6efc'), '93439'),
(2, 'victim', 12, 'test@localhost', unhex('a421de3a817384f7d069b417197eebe01e0a6efc'), '93439');
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

--
-- Daten für Tabelle `buildings`
--

INSERT INTO `boc`.`buildings` (`building_id`, `building`, `resources`, `moral`, `people`, `diseases`, `luck`, `units_atk`, `units_def`, `move_speed`, `build_speed`, `resource_speed`) VALUES (NULL, 'Armory', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1');
INSERT INTO `boc`.`buildings` (`building_id`, `building`, `resources`, `moral`, `people`, `diseases`, `luck`, `units_atk`, `units_def`, `move_speed`, `build_speed`, `resource_speed`) VALUES (NULL, 'Hospital', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1');
INSERT INTO `boc`.`buildings` (`building_id`, `building`, `resources`, `moral`, `people`, `diseases`, `luck`, `units_atk`, `units_def`, `move_speed`, `build_speed`, `resource_speed`) VALUES (NULL, 'Brothel', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1');