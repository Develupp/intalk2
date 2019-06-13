-- Adminer 4.7.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE DATABASE `firewalls` /*!40100 DEFAULT CHARACTER SET latin2 COLLATE latin2_hungarian_ci */;
USE `firewalls`;

DROP TABLE IF EXISTS `firewall`;
CREATE TABLE `firewall` (
  `firewall_id` int(11) NOT NULL AUTO_INCREMENT,
  `firewall_name` varchar(20) COLLATE latin2_hungarian_ci NOT NULL,
  `firewall_ip` varchar(15) COLLATE latin2_hungarian_ci NOT NULL,
  `firewall_type_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`firewall_id`),
  KEY `firewall_type_id` (`firewall_type_id`),
  CONSTRAINT `firewall_ibfk_1` FOREIGN KEY (`firewall_type_id`) REFERENCES `type` (`type_id`) ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_hungarian_ci;

TRUNCATE `firewall`;
INSERT INTO `firewall` (`firewall_id`, `firewall_name`, `firewall_ip`, `firewall_type_id`) VALUES
(25,	'junos_firewall33',	'10.0.0.2',	2),
(26,	'junos_firewall2',	'10.0.0.3',	1),
(45,	'junos_firewall3232',	'192.168.1.22',	3),
(48,	'test',	'192.168.1.3',	2),
(49,	'test2',	'192.168.1.4',	3);

DROP TABLE IF EXISTS `firewall_network`;
CREATE TABLE `firewall_network` (
  `fn_id` int(11) NOT NULL AUTO_INCREMENT,
  `firewall` int(11) NOT NULL,
  `network` int(11) NOT NULL,
  PRIMARY KEY (`fn_id`),
  KEY `firewall` (`firewall`),
  KEY `network` (`network`),
  CONSTRAINT `firewall_network_ibfk_1` FOREIGN KEY (`firewall`) REFERENCES `firewall` (`firewall_id`) ON DELETE NO ACTION,
  CONSTRAINT `firewall_network_ibfk_2` FOREIGN KEY (`network`) REFERENCES `network` (`network_id`) ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_hungarian_ci;

TRUNCATE `firewall_network`;
INSERT INTO `firewall_network` (`fn_id`, `firewall`, `network`) VALUES
(1,	26,	2),
(2,	25,	3),
(3,	45,	5),
(4,	45,	6),
(5,	45,	8);

DROP TABLE IF EXISTS `network`;
CREATE TABLE `network` (
  `network_id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(15) COLLATE latin2_hungarian_ci NOT NULL,
  `netmask` int(2) NOT NULL,
  PRIMARY KEY (`network_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_hungarian_ci;

TRUNCATE `network`;
INSERT INTO `network` (`network_id`, `ip`, `netmask`) VALUES
(2,	'10.20.144.0',	24),
(3,	'10.19.144.0',	24),
(5,	'172.28.10.0',	24),
(6,	'10.18.144.0',	24),
(7,	'10.21.144.0',	23),
(8,	'10.188.144.0',	25),
(9,	'10.22.144.0',	24);

DROP TABLE IF EXISTS `type`;
CREATE TABLE `type` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(20) COLLATE latin2_hungarian_ci NOT NULL,
  `manufacturer` varchar(20) COLLATE latin2_hungarian_ci NOT NULL,
  `end_of_support` date NOT NULL,
  `end_of_life` date NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_hungarian_ci;

TRUNCATE `type`;
INSERT INTO `type` (`type_id`, `type_name`, `manufacturer`, `end_of_support`, `end_of_life`) VALUES
(1,	'srx',	'juniper',	'2021-06-15',	'2025-12-30'),
(2,	'asa',	'cisco',	'2025-06-15',	'2030-12-30'),
(3,	'fortigate',	'fortinet',	'2030-06-15',	'2035-12-30');

-- 2019-06-12 18:45:45
