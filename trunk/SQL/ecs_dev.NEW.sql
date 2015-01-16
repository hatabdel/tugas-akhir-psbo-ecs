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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table ecs_dev.answer_type: ~2 rows (approximately)
DELETE FROM `answer_type`;
/*!40000 ALTER TABLE `answer_type` DISABLE KEYS */;
INSERT INTO `answer_type` (`id`, `name`) VALUES
	(2, 'UAS');
/*!40000 ALTER TABLE `answer_type` ENABLE KEYS */;


-- Dumping structure for table ecs_dev.attachment
DROP TABLE IF EXISTS `attachment`;
CREATE TABLE IF NOT EXISTS `attachment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `function_id` int(11) DEFAULT NULL,
  `record_id` int(11) DEFAULT NULL,
  `file_name` varchar(50) DEFAULT NULL,
  `original_file_name` varchar(50) DEFAULT NULL,
  `file_type` varchar(50) DEFAULT NULL,
  `file_extention` varchar(50) DEFAULT NULL,
  `file_path` varchar(50) DEFAULT NULL,
  `description` text,
  `created_date` date DEFAULT NULL,
  `created_user` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Dumping data for table ecs_dev.attachment: ~0 rows (approximately)
DELETE FROM `attachment`;
/*!40000 ALTER TABLE `attachment` DISABLE KEYS */;
INSERT INTO `attachment` (`id`, `function_id`, `record_id`, `file_name`, `original_file_name`, `file_type`, `file_extention`, `file_path`, `description`, `created_date`, `created_user`) VALUES
	(15, NULL, NULL, 'dsdsa', '20150110_175817.jpg', 'image/jpeg', 'jpg', '/uploaded_data/20150115065209.jpg', 'asdasd', '2015-01-15', 'bayu');
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
  `route` varchar(50) DEFAULT NULL,
  `module_info_id` int(11) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL,
  `is_show` int(1) DEFAULT NULL,
  PRIMARY KEY (`function_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ecs_dev.function_info: ~18 rows (approximately)
DELETE FROM `function_info`;
/*!40000 ALTER TABLE `function_info` DISABLE KEYS */;
INSERT INTO `function_info` (`function_id`, `name`, `url`, `route`, `module_info_id`, `icon`, `is_active`, `is_show`) VALUES
	('answer', 'Answer', 'answer', 'Answer', 1, 'icon-glass', 1, 1),
	('answer_type', 'Answer Type', 'answertype', 'AnswerType', 1, 'icon-glass', 1, 1),
	('attachment', 'Attachment', 'attachment', 'Attachment', 1, 'icon-glass', 1, 1),
	('comment', 'Comment', 'comment', 'Comment', 1, NULL, 1, 1),
	('course', 'Course', 'course', 'Course', 1, NULL, 1, 1),
	('course_detail', 'Course Detail', 'coursedetail', 'CourseDetail', 1, NULL, 1, 1),
	('forum', 'Forum', 'forum', 'Forum', 2, NULL, 1, 1),
	('function_info', 'Function Info', 'functioninfo', 'FunctionInfo', 3, NULL, 1, 1),
	('home', 'Home', '/', 'Home', 1, 'icon-glass', 1, 0),
	('login', 'Login', 'login', 'Login', NULL, NULL, 1, 0),
	('module_info', 'Module Info', 'moduleinfo', 'ModuleInfo', 3, NULL, 1, 1),
	('privilege_info', 'Privilege Info', 'privilegeinfo', 'PrivilegeInfo', 3, NULL, 1, 1),
	('quiz', 'Quiz', 'quiz', 'Quiz', 2, NULL, 1, 1),
	('quiz_question', 'Quiz Question', 'quizquestion', 'QuizQuestion', 1, NULL, 1, 1),
	('quiz_type', 'Quiz Type', 'quiztype', 'QuizType', 1, NULL, 1, 1),
	('student_answer', 'Student Answer', 'studentanswer', 'StudentAnswer', 1, NULL, 1, 1),
	('student_quiz', 'Student Quiz', 'studentquiz', 'StudentQuiz', 1, NULL, 1, 1),
	('user_group', 'User Group', 'usergroup', 'UserGroup', 3, NULL, 1, 1),
	('user_info', 'User Info', 'userinfo', 'UserInfo', 3, NULL, 1, 1),
	('webinar', 'Webinar', 'webinar', 'Webinar', 2, NULL, 1, 1);
/*!40000 ALTER TABLE `function_info` ENABLE KEYS */;


-- Dumping structure for table ecs_dev.icon
DROP TABLE IF EXISTS `icon`;
CREATE TABLE IF NOT EXISTS `icon` (
  `id` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ecs_dev.icon: ~361 rows (approximately)
DELETE FROM `icon`;
/*!40000 ALTER TABLE `icon` DISABLE KEYS */;
INSERT INTO `icon` (`id`, `name`) VALUES
	('icon-glass', 'Icon Glass'),
	('icon-music', 'Icon Music'),
	('icon-search', 'Icon Search'),
	('icon-envelope-alt', 'Icon Envelope Alt'),
	('icon-heart', 'Icon Heart'),
	('icon-star', 'Icon Star'),
	('icon-star-empty', 'Icon Star Empty'),
	('icon-user', 'Icon User'),
	('icon-film', 'Icon Film'),
	('icon-th-large', 'Icon Th Large'),
	('icon-th', 'Icon Th'),
	('icon-th-list', 'Icon Th List'),
	('icon-ok', 'Icon Ok'),
	('icon-remove', 'Icon Remove'),
	('icon-zoom-in', 'Icon Zoom In'),
	('icon-zoom-out', 'Icon Zoom Out'),
	('icon-power-off', 'Icon Power Off'),
	('icon-signal', 'Icon Signal'),
	('icon-gear', 'Icon Gear'),
	('icon-trash', 'Icon Trash'),
	('icon-home', 'Icon Home'),
	('icon-file-alt', 'Icon File Alt'),
	('icon-time', 'Icon Time'),
	('icon-road', 'Icon Road'),
	('icon-download-alt', 'Icon Download Alt'),
	('icon-download', 'Icon Download'),
	('icon-upload', 'Icon Upload'),
	('icon-inbox', 'Icon Inbox'),
	('icon-play-circle', 'Icon Play Circle'),
	('icon-rotate-right', 'Icon Rotate Right'),
	('icon-refresh', 'Icon Refresh'),
	('icon-list-alt', 'Icon List Alt'),
	('icon-lock', 'Icon Lock'),
	('icon-flag', 'Icon Flag'),
	('icon-headphones', 'Icon Headphones'),
	('icon-volume-off', 'Icon Volume Off'),
	('icon-volume-down', 'Icon Volume Down'),
	('icon-volume-up', 'Icon Volume Up'),
	('icon-qrcode', 'Icon Qrcode'),
	('icon-barcode', 'Icon Barcode'),
	('icon-tag', 'Icon Tag'),
	('icon-tags', 'Icon Tags'),
	('icon-book', 'Icon Book'),
	('icon-bookmark', 'Icon Bookmark'),
	('icon-print', 'Icon Print'),
	('icon-camera', 'Icon Camera'),
	('icon-font', 'Icon Font'),
	('icon-bold', 'Icon Bold'),
	('icon-italic', 'Icon Italic'),
	('icon-text-height', 'Icon Text Height'),
	('icon-text-width', 'Icon Text Width'),
	('icon-align-left', 'Icon Align Left'),
	('icon-align-center', 'Icon Align Center'),
	('icon-align-right', 'Icon Align Right'),
	('icon-align-justify', 'Icon Align Justify'),
	('icon-list', 'Icon List'),
	('icon-indent-left', 'Icon Indent Left'),
	('icon-indent-right', 'Icon Indent Right'),
	('icon-facetime-video', 'Icon Facetime Video'),
	('icon-picture', 'Icon Picture'),
	('icon-pencil', 'Icon Pencil'),
	('icon-map-marker', 'Icon Map Marker'),
	('icon-adjust', 'Icon Adjust'),
	('icon-tint', 'Icon Tint'),
	('icon-edit', 'Icon Edit'),
	('icon-share', 'Icon Share'),
	('icon-check', 'Icon Check'),
	('icon-move', 'Icon Move'),
	('icon-step-backward', 'Icon Step Backward'),
	('icon-fast-backward', 'Icon Fast Backward'),
	('icon-backward', 'Icon Backward'),
	('icon-play', 'Icon Play'),
	('icon-pause', 'Icon Pause'),
	('icon-stop', 'Icon Stop'),
	('icon-forward', 'Icon Forward'),
	('icon-fast-forward', 'Icon Fast Forward'),
	('icon-step-forward', 'Icon Step Forward'),
	('icon-eject', 'Icon Eject'),
	('icon-chevron-left', 'Icon Chevron Left'),
	('icon-chevron-right', 'Icon Chevron Right'),
	('icon-plus-sign', 'Icon Plus Sign'),
	('icon-minus-sign', 'Icon Minus Sign'),
	('icon-remove-sign', 'Icon Remove Sign'),
	('icon-ok-sign', 'Icon Ok Sign'),
	('icon-question-sign', 'Icon Question Sign'),
	('icon-info-sign', 'Icon Info Sign'),
	('icon-screenshot', 'Icon Screenshot'),
	('icon-remove-circle', 'Icon Remove Circle'),
	('icon-ok-circle', 'Icon Ok Circle'),
	('icon-ban-circle', 'Icon Ban Circle'),
	('icon-arrow-left', 'Icon Arrow Left'),
	('icon-arrow-right', 'Icon Arrow Right'),
	('icon-arrow-up', 'Icon Arrow Up'),
	('icon-arrow-down', 'Icon Arrow Down'),
	('icon-mail-forward', 'Icon Mail Forward'),
	('icon-resize-full', 'Icon Resize Full'),
	('icon-resize-small', 'Icon Resize Small'),
	('icon-plus', 'Icon Plus'),
	('icon-minus', 'Icon Minus'),
	('icon-asterisk', 'Icon Asterisk'),
	('icon-exclamation-sign', 'Icon Exclamation Sign'),
	('icon-gift', 'Icon Gift'),
	('icon-leaf', 'Icon Leaf'),
	('icon-fire', 'Icon Fire'),
	('icon-eye-open', 'Icon Eye Open'),
	('icon-eye-close', 'Icon Eye Close'),
	('icon-warning-sign', 'Icon Warning Sign'),
	('icon-plane', 'Icon Plane'),
	('icon-calendar', 'Icon Calendar'),
	('icon-random', 'Icon Random'),
	('icon-comment', 'Icon Comment'),
	('icon-magnet', 'Icon Magnet'),
	('icon-chevron-up', 'Icon Chevron Up'),
	('icon-chevron-down', 'Icon Chevron Down'),
	('icon-retweet', 'Icon Retweet'),
	('icon-shopping-cart', 'Icon Shopping Cart'),
	('icon-folder-close', 'Icon Folder Close'),
	('icon-folder-open', 'Icon Folder Open'),
	('icon-resize-vertical', 'Icon Resize Vertical'),
	('icon-resize-horizontal', 'Icon Resize Horizontal'),
	('icon-bar-chart', 'Icon Bar Chart'),
	('icon-twitter-sign', 'Icon Twitter Sign'),
	('icon-facebook-sign', 'Icon Facebook Sign'),
	('icon-camera-retro', 'Icon Camera Retro'),
	('icon-key', 'Icon Key'),
	('icon-gears', 'Icon Gears'),
	('icon-comments', 'Icon Comments'),
	('icon-thumbs-up-alt', 'Icon Thumbs Up Alt'),
	('icon-thumbs-down-alt', 'Icon Thumbs Down Alt'),
	('icon-star-half', 'Icon Star Half'),
	('icon-heart-empty', 'Icon Heart Empty'),
	('icon-signout', 'Icon Signout'),
	('icon-linkedin-sign', 'Icon Linkedin Sign'),
	('icon-pushpin', 'Icon Pushpin'),
	('icon-external-link', 'Icon External Link'),
	('icon-signin', 'Icon Signin'),
	('icon-trophy', 'Icon Trophy'),
	('icon-github-sign', 'Icon Github Sign'),
	('icon-upload-alt', 'Icon Upload Alt'),
	('icon-lemon', 'Icon Lemon'),
	('icon-phone', 'Icon Phone'),
	('icon-unchecked', 'Icon Unchecked'),
	('icon-bookmark-empty', 'Icon Bookmark Empty'),
	('icon-phone-sign', 'Icon Phone Sign'),
	('icon-twitter', 'Icon Twitter'),
	('icon-facebook', 'Icon Facebook'),
	('icon-github', 'Icon Github'),
	('icon-unlock', 'Icon Unlock'),
	('icon-credit-card', 'Icon Credit Card'),
	('icon-rss', 'Icon Rss'),
	('icon-hdd', 'Icon Hdd'),
	('icon-bullhorn', 'Icon Bullhorn'),
	('icon-bell', 'Icon Bell'),
	('icon-certificate', 'Icon Certificate'),
	('icon-hand-right', 'Icon Hand Right'),
	('icon-hand-left', 'Icon Hand Left'),
	('icon-hand-up', 'Icon Hand Up'),
	('icon-hand-down', 'Icon Hand Down'),
	('icon-circle-arrow-left', 'Icon Circle Arrow Left'),
	('icon-circle-arrow-right', 'Icon Circle Arrow Right'),
	('icon-circle-arrow-up', 'Icon Circle Arrow Up'),
	('icon-circle-arrow-down', 'Icon Circle Arrow Down'),
	('icon-globe', 'Icon Globe'),
	('icon-wrench', 'Icon Wrench'),
	('icon-tasks', 'Icon Tasks'),
	('icon-filter', 'Icon Filter'),
	('icon-briefcase', 'Icon Briefcase'),
	('icon-fullscreen', 'Icon Fullscreen'),
	('icon-group', 'Icon Group'),
	('icon-link', 'Icon Link'),
	('icon-cloud', 'Icon Cloud'),
	('icon-beaker', 'Icon Beaker'),
	('icon-cut', 'Icon Cut'),
	('icon-copy', 'Icon Copy'),
	('icon-paperclip', 'Icon Paperclip'),
	('icon-save', 'Icon Save'),
	('icon-sign-blank', 'Icon Sign Blank'),
	('icon-reorder', 'Icon Reorder'),
	('icon-list-ul', 'Icon List Ul'),
	('icon-list-ol', 'Icon List Ol'),
	('icon-strikethrough', 'Icon Strikethrough'),
	('icon-underline', 'Icon Underline'),
	('icon-table', 'Icon Table'),
	('icon-magic', 'Icon Magic'),
	('icon-truck', 'Icon Truck'),
	('icon-pinterest', 'Icon Pinterest'),
	('icon-pinterest-sign', 'Icon Pinterest Sign'),
	('icon-google-plus-sign', 'Icon Google Plus Sign'),
	('icon-google-plus', 'Icon Google Plus'),
	('icon-money', 'Icon Money'),
	('icon-caret-down', 'Icon Caret Down'),
	('icon-caret-up', 'Icon Caret Up'),
	('icon-caret-left', 'Icon Caret Left'),
	('icon-caret-right', 'Icon Caret Right'),
	('icon-columns', 'Icon Columns'),
	('icon-sort', 'Icon Sort'),
	('icon-sort-down', 'Icon Sort Down'),
	('icon-sort-up', 'Icon Sort Up'),
	('icon-envelope', 'Icon Envelope'),
	('icon-linkedin', 'Icon Linkedin'),
	('icon-rotate-left', 'Icon Rotate Left'),
	('icon-legal', 'Icon Legal'),
	('icon-dashboard', 'Icon Dashboard'),
	('icon-comment-alt', 'Icon Comment Alt'),
	('icon-comments-alt', 'Icon Comments Alt'),
	('icon-bolt', 'Icon Bolt'),
	('icon-sitemap', 'Icon Sitemap'),
	('icon-umbrella', 'Icon Umbrella'),
	('icon-paste', 'Icon Paste'),
	('icon-lightbulb', 'Icon Lightbulb'),
	('icon-exchange', 'Icon Exchange'),
	('icon-cloud-download', 'Icon Cloud Download'),
	('icon-cloud-upload', 'Icon Cloud Upload'),
	('icon-user-md', 'Icon User Md'),
	('icon-stethoscope', 'Icon Stethoscope'),
	('icon-suitcase', 'Icon Suitcase'),
	('icon-bell-alt', 'Icon Bell Alt'),
	('icon-coffee', 'Icon Coffee'),
	('icon-food', 'Icon Food'),
	('icon-file-text-alt', 'Icon File Text Alt'),
	('icon-building', 'Icon Building'),
	('icon-hospital', 'Icon Hospital'),
	('icon-ambulance', 'Icon Ambulance'),
	('icon-medkit', 'Icon Medkit'),
	('icon-fighter-jet', 'Icon Fighter Jet'),
	('icon-beer', 'Icon Beer'),
	('icon-h-sign', 'Icon H Sign'),
	('icon-plus-sign-alt', 'Icon Plus Sign Alt'),
	('icon-double-angle-left', 'Icon Double Angle Left'),
	('icon-double-angle-right', 'Icon Double Angle Right'),
	('icon-double-angle-up', 'Icon Double Angle Up'),
	('icon-double-angle-down', 'Icon Double Angle Down'),
	('icon-angle-left', 'Icon Angle Left'),
	('icon-angle-right', 'Icon Angle Right'),
	('icon-angle-up', 'Icon Angle Up'),
	('icon-angle-down', 'Icon Angle Down'),
	('icon-desktop', 'Icon Desktop'),
	('icon-laptop', 'Icon Laptop'),
	('icon-tablet', 'Icon Tablet'),
	('icon-mobile-phone', 'Icon Mobile Phone'),
	('icon-circle-blank', 'Icon Circle Blank'),
	('icon-quote-left', 'Icon Quote Left'),
	('icon-quote-right', 'Icon Quote Right'),
	('icon-spinner', 'Icon Spinner'),
	('icon-circle', 'Icon Circle'),
	('icon-mail-reply', 'Icon Mail Reply'),
	('icon-github-alt', 'Icon Github Alt'),
	('icon-folder-close-alt', 'Icon Folder Close Alt'),
	('icon-folder-open-alt', 'Icon Folder Open Alt'),
	('icon-expand-alt', 'Icon Expand Alt'),
	('icon-collapse-alt', 'Icon Collapse Alt'),
	('icon-smile', 'Icon Smile'),
	('icon-frown', 'Icon Frown'),
	('icon-meh', 'Icon Meh'),
	('icon-gamepad', 'Icon Gamepad'),
	('icon-keyboard', 'Icon Keyboard'),
	('icon-flag-alt', 'Icon Flag Alt'),
	('icon-flag-checkered', 'Icon Flag Checkered'),
	('icon-terminal', 'Icon Terminal'),
	('icon-code', 'Icon Code'),
	('icon-reply-all', 'Icon Reply All'),
	('icon-mail-reply-all', 'Icon Mail Reply All'),
	('icon-star-half-full', 'Icon Star Half Full'),
	('icon-location-arrow', 'Icon Location Arrow'),
	('icon-crop', 'Icon Crop'),
	('icon-code-fork', 'Icon Code Fork'),
	('icon-unlink', 'Icon Unlink'),
	('icon-question', 'Icon Question'),
	('icon-info', 'Icon Info'),
	('icon-exclamation', 'Icon Exclamation'),
	('icon-superscript', 'Icon Superscript'),
	('icon-subscript', 'Icon Subscript'),
	('icon-eraser', 'Icon Eraser'),
	('icon-puzzle-piece', 'Icon Puzzle Piece'),
	('icon-microphone', 'Icon Microphone'),
	('icon-microphone-off', 'Icon Microphone Off'),
	('icon-shield', 'Icon Shield'),
	('icon-calendar-empty', 'Icon Calendar Empty'),
	('icon-fire-extinguisher', 'Icon Fire Extinguisher'),
	('icon-rocket', 'Icon Rocket'),
	('icon-maxcdn', 'Icon Maxcdn'),
	('icon-chevron-sign-left', 'Icon Chevron Sign Left'),
	('icon-chevron-sign-right', 'Icon Chevron Sign Right'),
	('icon-chevron-sign-up', 'Icon Chevron Sign Up'),
	('icon-chevron-sign-down', 'Icon Chevron Sign Down'),
	('icon-html5', 'Icon Html5'),
	('icon-css3', 'Icon Css3'),
	('icon-anchor', 'Icon Anchor'),
	('icon-unlock-alt', 'Icon Unlock Alt'),
	('icon-bullseye', 'Icon Bullseye'),
	('icon-ellipsis-horizontal', 'Icon Ellipsis Horizontal'),
	('icon-ellipsis-vertical', 'Icon Ellipsis Vertical'),
	('icon-rss-sign', 'Icon Rss Sign'),
	('icon-play-sign', 'Icon Play Sign'),
	('icon-ticket', 'Icon Ticket'),
	('icon-minus-sign-alt', 'Icon Minus Sign Alt'),
	('icon-check-minus', 'Icon Check Minus'),
	('icon-level-up', 'Icon Level Up'),
	('icon-level-down', 'Icon Level Down'),
	('icon-check-sign', 'Icon Check Sign'),
	('icon-edit-sign', 'Icon Edit Sign'),
	('icon-external-link-sign', 'Icon External Link Sign'),
	('icon-share-sign', 'Icon Share Sign'),
	('icon-compass', 'Icon Compass'),
	('icon-collapse', 'Icon Collapse'),
	('icon-collapse-top', 'Icon Collapse Top'),
	('icon-expand', 'Icon Expand'),
	('icon-euro', 'Icon Euro'),
	('icon-gbp', 'Icon Gbp'),
	('icon-dollar', 'Icon Dollar'),
	('icon-rupee', 'Icon Rupee'),
	('icon-yen', 'Icon Yen'),
	('icon-renminbi', 'Icon Renminbi'),
	('icon-won', 'Icon Won'),
	('icon-bitcoin', 'Icon Bitcoin'),
	('icon-file', 'Icon File'),
	('icon-file-text', 'Icon File Text'),
	('icon-sort-by-alphabet', 'Icon Sort By Alphabet'),
	('icon-sort-by-alphabet-alt', 'Icon Sort By Alphabet Alt'),
	('icon-sort-by-attributes', 'Icon Sort By Attributes'),
	('icon-sort-by-attributes-alt', 'Icon Sort By Attributes Alt'),
	('icon-sort-by-order', 'Icon Sort By Order'),
	('icon-sort-by-order-alt', 'Icon Sort By Order Alt'),
	('icon-thumbs-up', 'Icon Thumbs Up'),
	('icon-thumbs-down', 'Icon Thumbs Down'),
	('icon-youtube-sign', 'Icon Youtube Sign'),
	('icon-youtube', 'Icon Youtube'),
	('icon-xing', 'Icon Xing'),
	('icon-xing-sign', 'Icon Xing Sign'),
	('icon-youtube-play', 'Icon Youtube Play'),
	('icon-dropbox', 'Icon Dropbox'),
	('icon-stackexchange', 'Icon Stackexchange'),
	('icon-instagram', 'Icon Instagram'),
	('icon-flickr', 'Icon Flickr'),
	('icon-adn', 'Icon Adn'),
	('icon-bitbucket', 'Icon Bitbucket'),
	('icon-bitbucket-sign', 'Icon Bitbucket Sign'),
	('icon-tumblr', 'Icon Tumblr'),
	('icon-tumblr-sign', 'Icon Tumblr Sign'),
	('icon-long-arrow-down', 'Icon Long Arrow Down'),
	('icon-long-arrow-up', 'Icon Long Arrow Up'),
	('icon-long-arrow-left', 'Icon Long Arrow Left'),
	('icon-long-arrow-right', 'Icon Long Arrow Right'),
	('icon-apple', 'Icon Apple'),
	('icon-windows', 'Icon Windows'),
	('icon-android', 'Icon Android'),
	('icon-linux', 'Icon Linux'),
	('icon-dribbble', 'Icon Dribbble'),
	('icon-skype', 'Icon Skype'),
	('icon-foursquare', 'Icon Foursquare'),
	('icon-trello', 'Icon Trello'),
	('icon-female', 'Icon Female'),
	('icon-male', 'Icon Male'),
	('icon-gittip', 'Icon Gittip'),
	('icon-sun', 'Icon Sun'),
	('icon-moon', 'Icon Moon'),
	('icon-archive', 'Icon Archive'),
	('icon-bug', 'Icon Bug'),
	('icon-vk', 'Icon Vk'),
	('icon-weibo', 'Icon Weibo'),
	('icon-renren', 'Icon Renren');
/*!40000 ALTER TABLE `icon` ENABLE KEYS */;


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


-- Dumping structure for table ecs_dev.module_info
DROP TABLE IF EXISTS `module_info`;
CREATE TABLE IF NOT EXISTS `module_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table ecs_dev.module_info: ~2 rows (approximately)
DELETE FROM `module_info`;
/*!40000 ALTER TABLE `module_info` DISABLE KEYS */;
INSERT INTO `module_info` (`id`, `name`, `icon`) VALUES
	(1, 'Master Data', 'icon-edit'),
	(2, 'Transaction', 'icon-credit-card'),
	(3, 'Privilege Management', 'icon-user');
/*!40000 ALTER TABLE `module_info` ENABLE KEYS */;


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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

-- Dumping data for table ecs_dev.privilege_info: ~13 rows (approximately)
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
	(23, 'webinar', 3, 1, 1, 1, 1),
	(24, 'module_info', 3, 1, 1, 1, 1),
	(25, 'quiz_type', 3, 1, 1, 1, 1);
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

-- Dumping data for table ecs_dev.quiz_question: ~0 rows (approximately)
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table ecs_dev.quiz_type: ~2 rows (approximately)
DELETE FROM `quiz_type`;
/*!40000 ALTER TABLE `quiz_type` DISABLE KEYS */;
INSERT INTO `quiz_type` (`id`, `name`) VALUES
	(1, 'UTS');
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
