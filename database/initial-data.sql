
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
-- Daten f√ºr Tabelle `attacks`
--

INSERT INTO `attacks` (`attack_id`, `source_district_id`, `target_district_id`, `battle_time`) VALUES
(1, 1, 2, '2013-12-28 15:57:41');

--
-- Daten f√ºr Tabelle `districts`
--

INSERT INTO `districts` (`district_id`, `owner_id`, `district_name`, `position_x`, `position_y`, `district_threat`) VALUES
(1, 1, 'Teststadt', 1, 1, 0),
(2, 2, 'Zielstadt', 5, 5, 0);

--
-- Daten f√ºr Tabelle `district_units`
--

INSERT INTO `district_units` (`id`, `unit_id`, `district_id`, `count`) VALUES
(1, 1, 1, 10),
(2, 2, 2, 5);

--
-- Daten f√ºr Tabelle `torm_info`
--

INSERT INTO `torm_info` (`id`) VALUES
(1);

--
-- Daten f√ºr Tabelle `units`
--

INSERT INTO `units` (`unit_id`, `unit_name`, `unit_class`, `unit_atk`, `unit_def`, `unit_speed`, `unit_res`) VALUES
(1, 'Schwertk‰mpfer', 'Offensiv', 10, 5, 5, 100),
(2, 'Ritter', 'Offensiv', 15, 8, 20, 250);

--
-- Daten f√ºr Tabelle `users`
--

INSERT INTO `users` (`user_id`, `username`, `age`, `mail`, `password`, `salt`) VALUES
(1, 'admin', 1, 'admin@localhost.com', '§!ﬁ:ÅsÑ˜–i¥~Î‡\nn¸', '93439'),
(2, 'victim', 12, 'test@localhost', '§!ﬁ:ÅsÑ˜–i¥~Î‡\nn¸', '93439');
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
