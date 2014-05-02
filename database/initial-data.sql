
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
-- Daten fÃ¼r Tabelle `attacks`
--

TRUNCATE TABLE `attacks`;

INSERT INTO `attacks` (`attack_id`, `source_district_id`, `target_district_id`, `battle_time`) VALUES
(1, 1, 2, '2013-12-28 15:57:41');

--
-- Daten fÃ¼r Tabelle `districts`
--

TRUNCATE TABLE `districts`;

INSERT INTO `districts` (`owner_id`, `district_name`, `position_x`, `position_y`, `district_threat`) VALUES
(1, 'Abadan', 1, 1, 0),
(2, 'Nahavand', 5, 5, 0),
(1, 'Varamin', 1, 5, 0),
(1, 'Parsa', 2, 5, 0),
(1, 'Qutschan', 3, 5, 0),
(1, 'Rezaiyeh', 4, 5, 0),
(1, 'Amol', 5, 1, 0),
(1, 'Zahedan', 5, 2, 0),
(1, 'Yazd', 5, 3, 0),
(1, 'Babol', 5, 4, 0),
(1, 'Sirdschan', 4, 1, 0),
(1, 'Zabol', 4, 2, 0),
(1, 'Ekbatana', 4, 3, 0),
(1, 'Chark', 4, 4, 0),
(1, 'Ardakan', 3, 1, 0),
(1, 'Hamedan', 3, 2, 0),
(1, 'Teheran', 3, 3, 0),
(1, 'Damqan', 1, 3, 0),
(1, 'Kaschan', 2, 3, 0),
(1, 'Amstetten', 1, 3, 0),
(1, 'Calco', 1, 3, 0),
(1, 'Saharanpur', 1, 3, 0),
(1, 'Leersum', 1, 3, 0),
(1, 'Lairg', 1, 3, 0),
(1, 'Breda', 1, 3, 0),
(1, 'Koninksem', 1, 3, 0),
(1, 'South Portland', 1, 3, 0),
(1, 'Cap-Saint-Ignace', 1, 3, 0),
(1, 'Sanquhar', 1, 3, 0),
(1, 'Wichita', 1, 3, 0),
(1, 'Knittelfeld', 1, 3, 0),
(1, 'Frignano', 1, 3, 0),
(1, 'Greater Sudbury', 1, 3, 0),
(1, 'Greenlaw', 1, 3, 0),
(1, 'Warburg', 1, 3, 0),
(1, 'Tourcoing', 1, 3, 0),
(1, 'Beringen', 1, 3, 0),
(1, 'Flint', 1, 3, 0),
(1, 'MontluÃ§on', 1, 3, 0),
(1, 'Mondolfo', 1, 3, 0),
(1, 'Lebach', 1, 3, 0),
(1, 'Provo', 1, 3, 0),
(1, 'Jefferson City', 1, 3, 0),
(1, 'Dannevirke', 1, 3, 0),
(1, 'Whitby', 1, 3, 0),
(1, 'Sint-Pieters-Kapelle', 1, 3, 0),
(1, 'Cuddapah', 1, 3, 0),
(1, 'Piringen', 1, 3, 0),
(1, 'St. Neots', 1, 3, 0),
(1, 'Canino', 1, 3, 0),
(1, 'Capannori', 1, 3, 0),
(1, 'Bad Neuenahr-Ahrweiler', 1, 3, 0),
(1, 'Lives-sur-Meuse', 1, 3, 0),
(1, 'Mandi Bahauddin', 1, 3, 0),
(1, 'Darwin', 1, 3, 0),
(1, 'Lavoir', 1, 3, 0),
(1, 'Whitby', 1, 3, 0),
(1, 'De Haan', 1, 3, 0),
(1, 'Coaldale', 1, 3, 0),
(1, 'Aurora', 1, 3, 0),
(1, 'Wayaux', 1, 3, 0),
(1, 'Portico e San Benedetto', 1, 3, 0),
(1, 'Pietrasanta', 1, 3, 0),
(1, 'Damme', 1, 3, 0),
(1, 'Friedrichshafen', 1, 3, 0),
(1, 'Sanquhar', 1, 3, 0),
(1, 'Edmonton', 1, 3, 0),
(1, 'Fort Simpson', 1, 3, 0),
(1, 'Vagli Sotto', 1, 3, 0),
(1, 'Berlin', 1, 3, 0),
(1, 'Kermt', 1, 3, 0),
(1, 'Remscheid', 1, 3, 0),
(1, 'Lang', 1, 3, 0),
(1, 'Bolton', 1, 3, 0),
(1, 'Ehein', 1, 3, 0),
(1, 'Cardedu', 1, 3, 0),
(1, 'Neyveli', 1, 3, 0),
(1, 'Waiuku', 1, 3, 0),
(1, 'Orbais', 1, 3, 0),
(1, 'Oldenzaal', 1, 3, 0),
(1, 'Hallaar', 1, 3, 0),
(1, 'Falisolle', 1, 3, 0),
(1, 'Maisiï¿½res', 1, 3, 0),
(1, 'Castiglione a Casauria', 1, 3, 0),
(1, 'Duncan', 1, 3, 0),
(1, 'ValÃ©ncia', 1, 3, 0),
(1, 'Meeuwen', 1, 3, 0),
(1, 'Launceston', 1, 3, 0),
(1, 'Kufstein', 1, 3, 0),
(1, 'Hastings', 1, 3, 0),
(1, 'Lakewood', 1, 3, 0),
(1, 'North Battleford', 1, 3, 0),
(1, 'Napier', 1, 3, 0),
(1, 'Perth', 1, 3, 0),
(1, 'Ruddervoorde', 1, 3, 0),
(1, 'Sint-Kwintens-Lennik', 1, 3, 0),
(1, 'Champorcher', 1, 3, 0),
(1, 'Melton Mowbray', 1, 3, 0),
(1, 'Wandlitz', 1, 3, 0),
(1, 'Corbara', 1, 3, 0),
(1, 'Bingen', 1, 3, 0),
(1, 'Haridwar', 1, 3, 0),
(1, 'Bergisch Gladbach', 1, 3, 0),
(1, 'Wondelgem', 1, 3, 0),
(1, 'Southend', 1, 3, 0),
(1, 'Bidar', 1, 3, 0),
(1, 'Ketchikan', 1, 3, 0),
(1, 'Cheyenne', 1, 3, 0),
(1, 'Rimbey', 1, 3, 0),
(1, 'Macquenoise', 1, 3, 0),
(1, 'Hull', 1, 3, 0),
(1, 'Longvilly', 1, 3, 0),
(1, 'Phoenix', 1, 3, 0),
(1, 'De Haan', 1, 3, 0),
(1, 'Tongrinne', 1, 3, 0),
(1, 'Bassano in Teverina', 1, 3, 0),
(1, 'New Orleans', 1, 3, 0),
(1, 'Grand-Hallet', 1, 3, 0);

--
-- Daten fÃ¼r Tabelle `district_units`
--

TRUNCATE TABLE `district_units`;

INSERT INTO `district_units` (`id`, `unit_id`, `district_id`, `count`) VALUES
(1, 1, 1, 10),
(2, 2, 2, 5);

--
-- Daten fÃ¼r Tabelle `torm_info`
--

TRUNCATE TABLE `torm_info`;

INSERT INTO `torm_info` (`id`) VALUES
(1);

--
-- Daten fÃ¼r Tabelle `units`
--

TRUNCATE TABLE `units`;

INSERT INTO `units` (`unit_id`, `unit_name`, `unit_class`, `unit_atk`, `unit_def`, `unit_speed`, `unit_res`) VALUES
(1, 'Swordsman', 'Offensiv', 10, 5, 5, 100),
(2, 'Knight', 'Offensiv', 15, 8, 20, 250);

--
-- Daten fÃ¼r Tabelle `users`
--

TRUNCATE TABLE `users`;

INSERT INTO `users` (`user_id`, `username`, `age`, `mail`, `password`, `salt`) VALUES
(1, 'admin', 1, 'admin@localhost.com', unhex('a421de3a817384f7d069b417197eebe01e0a6efc'), '93439'),
(2, 'victim', 12, 'test@localhost', unhex('a421de3a817384f7d069b417197eebe01e0a6efc'), '93439');
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

--
-- Daten fÃ¼r Tabelle `buildings`
--

INSERT INTO `buildings` (`building_id`, `building`, `resources`, `moral`, `people`, `diseases`, `luck`, `units_atk`, `units_def`, `move_speed`, `build_speed`, `resource_speed`) VALUES (NULL, 'Armory', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1');
INSERT INTO `buildings` (`building_id`, `building`, `resources`, `moral`, `people`, `diseases`, `luck`, `units_atk`, `units_def`, `move_speed`, `build_speed`, `resource_speed`) VALUES (NULL, 'Hospital', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1');
INSERT INTO `buildings` (`building_id`, `building`, `resources`, `moral`, `people`, `diseases`, `luck`, `units_atk`, `units_def`, `move_speed`, `build_speed`, `resource_speed`) VALUES (NULL, 'Brothel', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1');
