-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.20 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             8.3.0.4694
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for ecs_dev
DROP DATABASE IF EXISTS `ecs_dev`;
CREATE DATABASE IF NOT EXISTS `ecs_dev` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `ecs_dev`;


-- Dumping structure for table ecs_dev.answer
DROP TABLE IF EXISTS `answer`;
CREATE TABLE IF NOT EXISTS `answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sequence` int(11) DEFAULT NULL,
  `quiz_question_id` int(11) DEFAULT NULL,
  `content` text,
  `is_correct` bit(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table ecs_dev.answer_type
DROP TABLE IF EXISTS `answer_type`;
CREATE TABLE IF NOT EXISTS `answer_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table ecs_dev.attachment
DROP TABLE IF EXISTS `attachment`;
CREATE TABLE IF NOT EXISTS `attachment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `function_id` int(11) DEFAULT NULL,
  `record_id` int(11) DEFAULT NULL,
  `file_name` varchar(50) DEFAULT NULL,
  `file_type` varchar(50) DEFAULT NULL,
  `file_extention` varchar(50) DEFAULT NULL,
  `file_path` varchar(50) DEFAULT NULL,
  `description` text,
  `created_date` date DEFAULT NULL,
  `created_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table ecs_dev.attendance
DROP TABLE IF EXISTS `attendance`;
CREATE TABLE IF NOT EXISTS `attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` int(11) DEFAULT NULL,
  `webinar_id` int(11) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table ecs_dev.comment
DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `content` text,
  `created_date` date DEFAULT NULL,
  `created_user` varchar(50) DEFAULT NULL,
  `update_date` date DEFAULT NULL,
  `update_user` varchar(50) DEFAULT NULL,
  `forum_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table ecs_dev.course
DROP TABLE IF EXISTS `course`;
CREATE TABLE IF NOT EXISTS `course` (
  `code` varchar(50) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` text,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_user` varchar(50) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table ecs_dev.course_detail
DROP TABLE IF EXISTS `course_detail`;
CREATE TABLE IF NOT EXISTS `course_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identity_id` int(11) DEFAULT NULL,
  `course_code` int(11) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table ecs_dev.forum
DROP TABLE IF EXISTS `forum`;
CREATE TABLE IF NOT EXISTS `forum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `content` text,
  `created_date` date DEFAULT NULL,
  `created_user` varchar(50) DEFAULT NULL,
  `update_date` date DEFAULT NULL,
  `update_user` varchar(50) DEFAULT NULL,
  `course_code` int(11) DEFAULT NULL,
  `is_public` bit(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table ecs_dev.function_info
DROP TABLE IF EXISTS `function_info`;
CREATE TABLE IF NOT EXISTS `function_info` (
  `function_id` varchar(50) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `url` varchar(50) DEFAULT NULL,
  `is_active` bit(1) DEFAULT NULL,
  `is_show` bit(1) DEFAULT NULL,
  PRIMARY KEY (`function_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table ecs_dev.identity
DROP TABLE IF EXISTS `identity`;
CREATE TABLE IF NOT EXISTS `identity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identity_no` int(11) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `address` varchar(1000) DEFAULT NULL,
  `birth_place` varchar(100) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `handphone_no` int(11) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table ecs_dev.instructor
DROP TABLE IF EXISTS `instructor`;
CREATE TABLE IF NOT EXISTS `instructor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identity_id` int(11) DEFAULT NULL,
  `course_code` varchar(50) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `created_user` varchar(50) DEFAULT NULL,
  `is_active` bit(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table ecs_dev.privilege_info
DROP TABLE IF EXISTS `privilege_info`;
CREATE TABLE IF NOT EXISTS `privilege_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `function_id` varchar(50) DEFAULT NULL,
  `user_group_id` int(11) DEFAULT NULL,
  `is_allow_read` int(1) DEFAULT NULL,
  `is_allow_create` int(1) DEFAULT NULL,
  `is_allow_update` int(1) DEFAULT NULL,
  `is_allow_delete` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table ecs_dev.quiz
DROP TABLE IF EXISTS `quiz`;
CREATE TABLE IF NOT EXISTS `quiz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_name` varchar(50) DEFAULT NULL,
  `course_code` int(11) DEFAULT NULL,
  `quiz_type_id` int(11) DEFAULT NULL,
  `start_date_time` date DEFAULT NULL,
  `end_date_time` date DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `created_user` varchar(50) DEFAULT NULL,
  `update_date` date DEFAULT NULL,
  `update_user` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table ecs_dev.quiz_question
DROP TABLE IF EXISTS `quiz_question`;
CREATE TABLE IF NOT EXISTS `quiz_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_id` int(11) DEFAULT NULL,
  `question` varchar(1000) DEFAULT NULL,
  `answer_type_id` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table ecs_dev.quiz_type
DROP TABLE IF EXISTS `quiz_type`;
CREATE TABLE IF NOT EXISTS `quiz_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table ecs_dev.student_answer
DROP TABLE IF EXISTS `student_answer`;
CREATE TABLE IF NOT EXISTS `student_answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_quiz_id` int(11) DEFAULT NULL,
  `quiz_question_id` int(11) DEFAULT NULL,
  `student_answer` varchar(50) DEFAULT NULL,
  `score` float DEFAULT NULL,
  `is_correct` bit(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table ecs_dev.student_quiz
DROP TABLE IF EXISTS `student_quiz`;
CREATE TABLE IF NOT EXISTS `student_quiz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identity_id` int(11) DEFAULT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  `total_score` int(11) DEFAULT NULL,
  `start_date_time` date DEFAULT NULL,
  `end_date_time` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table ecs_dev.user_group
DROP TABLE IF EXISTS `user_group`;
CREATE TABLE IF NOT EXISTS `user_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table ecs_dev.user_info
DROP TABLE IF EXISTS `user_info`;
CREATE TABLE IF NOT EXISTS `user_info` (
  `user_name` varchar(50) NOT NULL,
  `identity_id` int(11) DEFAULT NULL,
  `password` varchar(1000) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL,
  `user_group_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table ecs_dev.webinar
DROP TABLE IF EXISTS `webinar`;
CREATE TABLE IF NOT EXISTS `webinar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `course_code` varchar(50) DEFAULT NULL,
  `created_user` varchar(50) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
