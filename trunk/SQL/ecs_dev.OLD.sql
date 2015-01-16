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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table ecs_dev.answer: ~0 rows (approximately)
DELETE FROM `answer`;
/*!40000 ALTER TABLE `answer` DISABLE KEYS */;
INSERT INTO `answer` (`id`, `sequence`, `quiz_question_id`, `content`, `is_correct`) VALUES
	(1, 0, 0, 'adsasd', b'1');
/*!40000 ALTER TABLE `answer` ENABLE KEYS */;


-- Dumping structure for table ecs_dev.answer_type
DROP TABLE IF EXISTS `answer_type`;
CREATE TABLE IF NOT EXISTS `answer_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ecs_dev.answer_type: ~0 rows (approximately)
DELETE FROM `answer_type`;
/*!40000 ALTER TABLE `answer_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `answer_type` ENABLE KEYS */;


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

-- Dumping data for table ecs_dev.attachment: ~0 rows (approximately)
DELETE FROM `attachment`;
/*!40000 ALTER TABLE `attachment` DISABLE KEYS */;
/*!40000 ALTER TABLE `attachment` ENABLE KEYS */;


-- Dumping structure for table ecs_dev.attendance
DROP TABLE IF EXISTS `attendance`;
CREATE TABLE IF NOT EXISTS `attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` int(11) DEFAULT NULL,
  `webinar_id` int(11) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ecs_dev.attendance: ~0 rows (approximately)
DELETE FROM `attendance`;
/*!40000 ALTER TABLE `attendance` DISABLE KEYS */;
/*!40000 ALTER TABLE `attendance` ENABLE KEYS */;


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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table ecs_dev.comment: ~0 rows (approximately)
DELETE FROM `comment`;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` (`id`, `title`, `content`, `created_date`, `created_user`, `update_date`, `update_user`, `forum_id`) VALUES
	(1, 'dsa', 'da', '0000-00-00', 'bayu', NULL, NULL, NULL);
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;


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

-- Dumping data for table ecs_dev.course: ~6 rows (approximately)
DELETE FROM `course`;
/*!40000 ALTER TABLE `course` DISABLE KEYS */;
INSERT INTO `course` (`code`, `name`, `description`, `start_date`, `end_date`, `created_date`, `created_user`, `is_active`) VALUES
	('0312321', 'bayu', 'dsadsa', '2014-01-19', '2014-01-23', NULL, NULL, 1),
	('4234234', 'dasdsa', 'dsadsa', '2014-01-19', '2014-01-23', NULL, NULL, 1),
	('K0Z-12', 'MATEMATIKA', 'AAA', '2014-01-01', '2014-01-31', NULL, NULL, 1),
	('K0Z-124', 'DASDSA', 'DA', '2014-01-01', '2014-01-31', NULL, 'bayu', 1),
	('K0Z-124sad', 'dsa', 'das', '2014-01-01', '2014-01-31', '2015-01-03 09:30:03', 'bayu', 0),
	('MTK', 'MATEMATIKA', 'dasds', '2014-01-01', '2014-01-31', '2015-01-03 09:32:51', 'bayu', 0);
/*!40000 ALTER TABLE `course` ENABLE KEYS */;


-- Dumping structure for table ecs_dev.course_detail
DROP TABLE IF EXISTS `course_detail`;
CREATE TABLE IF NOT EXISTS `course_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identity_id` int(11) DEFAULT NULL,
  `course_code` int(11) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ecs_dev.course_detail: ~0 rows (approximately)
DELETE FROM `course_detail`;
/*!40000 ALTER TABLE `course_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_detail` ENABLE KEYS */;


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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table ecs_dev.forum: ~0 rows (approximately)
DELETE FROM `forum`;
/*!40000 ALTER TABLE `forum` DISABLE KEYS */;
INSERT INTO `forum` (`id`, `title`, `content`, `created_date`, `created_user`, `update_date`, `update_user`, `course_code`, `is_public`) VALUES
	(1, 'dsa', 'sadasd', '2015-01-10', NULL, '2015-01-10', NULL, NULL, b'1');
/*!40000 ALTER TABLE `forum` ENABLE KEYS */;


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

-- Dumping data for table ecs_dev.function_info: ~15 rows (approximately)
DELETE FROM `function_info`;
/*!40000 ALTER TABLE `function_info` DISABLE KEYS */;
INSERT INTO `function_info` (`function_id`, `name`, `url`, `is_active`, `is_show`) VALUES
	('answer', 'Answer', 'answer', b'1', b'1'),
	('answer_type', 'Answer Type', 'answertype', b'1', b'1'),
	('attachment', 'Attachment', 'attachment', b'1', b'1'),
	('comment', 'Comment', 'comment', b'1', b'1'),
	('course', 'Course', 'course', b'1', b'1'),
	('course_detail', 'Course Detail', 'coursedetail', b'1', b'1'),
	('forum', 'Forum', 'forum', b'1', b'1'),
	('function_info', 'Function Info', 'functioninfo', b'1', b'1'),
	('privilege_info', 'Privilege Info', 'privilegeinfo', b'1', b'1'),
	('quiz', 'Quiz', 'quiz', b'1', b'1'),
	('quiz_question', 'Quiz Question', 'quizquestion', b'1', b'1'),
	('quiz_type', 'Quiz Type', 'quiztype', b'1', b'1'),
	('student_answer', 'Student Answer', 'studentanswer', b'1', b'1'),
	('student_quiz', 'Student Quiz', 'studentquiz', b'1', b'1'),
	('user_group', 'User Group', 'usergroup', b'1', b'1'),
	('user_info', 'User Info', 'userinfo', b'1', b'1'),
	('webinar', 'Webinar', 'webinar', b'1', b'1');
/*!40000 ALTER TABLE `function_info` ENABLE KEYS */;


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

-- Dumping data for table ecs_dev.identity: ~0 rows (approximately)
DELETE FROM `identity`;
/*!40000 ALTER TABLE `identity` DISABLE KEYS */;
/*!40000 ALTER TABLE `identity` ENABLE KEYS */;


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

-- Dumping data for table ecs_dev.instructor: ~0 rows (approximately)
DELETE FROM `instructor`;
/*!40000 ALTER TABLE `instructor` DISABLE KEYS */;
/*!40000 ALTER TABLE `instructor` ENABLE KEYS */;


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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- Dumping data for table ecs_dev.privilege_info: ~14 rows (approximately)
DELETE FROM `privilege_info`;
/*!40000 ALTER TABLE `privilege_info` DISABLE KEYS */;
INSERT INTO `privilege_info` (`id`, `function_id`, `user_group_id`, `is_allow_read`, `is_allow_create`, `is_allow_update`, `is_allow_delete`) VALUES
	(9, 'function_info', 3, 1, 1, 1, 1),
	(10, 'privilege_info', 3, 1, 1, 1, 1),
	(11, 'user_group', 3, 1, 1, 1, 1),
	(13, 'user_info', 3, 1, 0, 0, 0),
	(14, 'answer', 3, 1, 1, 1, 1),
	(15, 'answer_type', 3, 1, 1, 1, 1),
	(16, 'attachment', 3, 1, 1, 1, 1),
	(17, 'comment', 3, 1, 1, 1, 1),
	(18, 'course', 3, 1, 1, 1, 1),
	(19, 'course_detail', 3, 1, 1, 1, 1),
	(20, 'forum', 3, 1, 1, 1, 1),
	(21, 'quiz', 3, 1, 1, 1, 1),
	(22, 'quiz_question', 3, 1, 1, 1, 1),
	(23, 'webinar', 3, 1, 1, 1, 1);
/*!40000 ALTER TABLE `privilege_info` ENABLE KEYS */;


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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table ecs_dev.quiz: ~0 rows (approximately)
DELETE FROM `quiz`;
/*!40000 ALTER TABLE `quiz` DISABLE KEYS */;
INSERT INTO `quiz` (`id`, `quiz_name`, `course_code`, `quiz_type_id`, `start_date_time`, `end_date_time`, `created_date`, `created_user`, `update_date`, `update_user`) VALUES
	(1, 'dsa', 0, 0, '0000-00-00', '0000-00-00', '0000-00-00', 'ads', '0000-00-00', 'das');
/*!40000 ALTER TABLE `quiz` ENABLE KEYS */;


-- Dumping structure for table ecs_dev.quiz_question
DROP TABLE IF EXISTS `quiz_question`;
CREATE TABLE IF NOT EXISTS `quiz_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_id` int(11) DEFAULT NULL,
  `question` varchar(1000) DEFAULT NULL,
  `answer_type_id` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table ecs_dev.quiz_question: ~1 rows (approximately)
DELETE FROM `quiz_question`;
/*!40000 ALTER TABLE `quiz_question` DISABLE KEYS */;
INSERT INTO `quiz_question` (`id`, `quiz_id`, `question`, `answer_type_id`, `score`) VALUES
	(1, 0, 'das', 0, 0);
/*!40000 ALTER TABLE `quiz_question` ENABLE KEYS */;


-- Dumping structure for table ecs_dev.quiz_type
DROP TABLE IF EXISTS `quiz_type`;
CREATE TABLE IF NOT EXISTS `quiz_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ecs_dev.quiz_type: ~0 rows (approximately)
DELETE FROM `quiz_type`;
/*!40000 ALTER TABLE `quiz_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `quiz_type` ENABLE KEYS */;


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

-- Dumping data for table ecs_dev.student_answer: ~0 rows (approximately)
DELETE FROM `student_answer`;
/*!40000 ALTER TABLE `student_answer` DISABLE KEYS */;
/*!40000 ALTER TABLE `student_answer` ENABLE KEYS */;


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

-- Dumping data for table ecs_dev.student_quiz: ~0 rows (approximately)
DELETE FROM `student_quiz`;
/*!40000 ALTER TABLE `student_quiz` DISABLE KEYS */;
/*!40000 ALTER TABLE `student_quiz` ENABLE KEYS */;


-- Dumping structure for table ecs_dev.user_group
DROP TABLE IF EXISTS `user_group`;
CREATE TABLE IF NOT EXISTS `user_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table ecs_dev.user_group: ~1 rows (approximately)
DELETE FROM `user_group`;
/*!40000 ALTER TABLE `user_group` DISABLE KEYS */;
INSERT INTO `user_group` (`id`, `name`) VALUES
	(3, 'Admin');
/*!40000 ALTER TABLE `user_group` ENABLE KEYS */;


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

-- Dumping data for table ecs_dev.user_info: ~1 rows (approximately)
DELETE FROM `user_info`;
/*!40000 ALTER TABLE `user_info` DISABLE KEYS */;
INSERT INTO `user_info` (`user_name`, `identity_id`, `password`, `created_date`, `updated_date`, `is_active`, `user_group_id`) VALUES
	('bayu', NULL, 'a430e06de5ce438d499c2e4063d60fd6', '2015-01-10 05:59:17', NULL, 1, 3);
/*!40000 ALTER TABLE `user_info` ENABLE KEYS */;


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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table ecs_dev.webinar: ~2 rows (approximately)
DELETE FROM `webinar`;
/*!40000 ALTER TABLE `webinar` DISABLE KEYS */;
INSERT INTO `webinar` (`id`, `title`, `course_code`, `created_user`, `created_date`, `start_date`, `end_date`) VALUES
	(1, 'Limit', '0', 'bayu', '2015-01-10', '2014-01-19 10:30:00', '2014-01-19 11:30:00'),
	(2, 'Limit', 'K0Z-12', 'bayu', '2015-01-10', '2014-01-19 10:30:00', '2014-01-19 11:30:00');
/*!40000 ALTER TABLE `webinar` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
