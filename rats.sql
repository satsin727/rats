-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2019 at 07:47 PM
-- Server version: 5.7.9
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rats`
--

-- --------------------------------------------------------

--
-- Table structure for table `assigned`
--

DROP TABLE IF EXISTS `assigned`;
CREATE TABLE IF NOT EXISTS `assigned` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `cid` bigint(20) NOT NULL,
  `uid` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assigned`
--

INSERT INTO `assigned` (`id`, `cid`, `uid`) VALUES
(1, 2, 1),
(2, 4, 1),
(3, 3, 1),
(4, 3, 29),
(5, 4, 31);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `lid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `companyname` varchar(60) NOT NULL,
  `rname` varchar(30) NOT NULL,
  `rfname` varchar(30) NOT NULL,
  `remail` varchar(50) NOT NULL,
  `rphone` bigint(10) NOT NULL,
  `rlocation` varchar(50) NOT NULL,
  `rtimezon` varchar(3) NOT NULL,
  `tier` varchar(23) NOT NULL,
  `status` int(11) NOT NULL,
  `filetarget` longtext NOT NULL,
  PRIMARY KEY (`cid`),
  UNIQUE KEY `cid` (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=21938 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`cid`, `lid`, `uid`, `companyname`, `rname`, `rfname`, `remail`, `rphone`, `rlocation`, `rtimezon`, `tier`, `status`, `filetarget`) VALUES
(2, 2, 1, 'a tech', 'recruiter name', 'name', 's@s.com', 123456789, 'location', 'tim', '0', 1, '0'),
(21933, 4, 1, 'IDC', 'sataus', 'sats', 'sat@idc.com', 2149359809, 'gygy', 'pst', 'Tier 1', 1, 'files/lists/4-09-01-2018-759729-sasa.csv'),
(21932, 5, 1, 'IDC', 'sataus', 'sats', 'sat@idc.com', 2149359809, 'gygy', 'pst', 'Tier 1', 1, 'files/lists/5-09-01-2018-789776-sasa.csv'),
(21931, 2, 2, 'IDC', 'sataus', 'sats', 'sat@idc.com', 2149359809, 'gygy', 'pst', 'Tier 1', 1, 'files/lists/2-09-01-2018-922518-sasa.csv'),
(21935, 2, 1, 'Metahorizon Inc.', 'Mike Street', 'Mike', 'mike@judge.com', 9785421631, 'Dallas, TX', '1', '1', 1, 'manual'),
(21936, 2, 1, 'Adbakx', 'Mike Street', 'Mike', 'mikestreet@judge.com', 7841595956, 'PA', '1', '1', 1, 'manual'),
(21937, 2, 1, 'Xcelent Tech', 'Raj Malhotra', 'Raj', 'raju@xclenttech.com', 2143659868, 'Irving, TX', 'EST', 'Tier 2', 1, 'manual');

-- --------------------------------------------------------

--
-- Table structure for table `consultants`
--

DROP TABLE IF EXISTS `consultants`;
CREATE TABLE IF NOT EXISTS `consultants` (
  `cid` int(3) NOT NULL AUTO_INCREMENT,
  `status` int(1) NOT NULL,
  `cfname` varchar(40) NOT NULL,
  `cmname` varchar(40) NOT NULL,
  `clname` varchar(40) NOT NULL,
  `skill` varchar(50) NOT NULL,
  `co_email` varchar(50) NOT NULL,
  `cm_email` varchar(100) NOT NULL,
  `cm_password` varchar(500) NOT NULL,
  `cp_email` varchar(100) NOT NULL,
  `cp_password` varchar(500) NOT NULL,
  `colocation` varchar(100) NOT NULL,
  `cmlocation` varchar(100) NOT NULL,
  `co_phonenumber` varchar(12) NOT NULL,
  `cm_phonenumber` varchar(12) NOT NULL,
  `covisa` varchar(10) NOT NULL,
  `cmvisa` varchar(20) NOT NULL,
  `relocation` varchar(60) NOT NULL,
  `resume` varchar(100) DEFAULT NULL,
  `visacopy` varchar(100) DEFAULT NULL,
  `dlcopy` varchar(100) DEFAULT NULL,
  `stateid` varchar(100) DEFAULT NULL,
  `lastssn` bigint(5) NOT NULL,
  `passportcopy` varchar(100) DEFAULT NULL,
  `passportnumber` varchar(15) NOT NULL,
  `passportcountry` varchar(50) NOT NULL,
  `bachelordegree` varchar(50) NOT NULL,
  `buniversity` varchar(60) NOT NULL,
  `byear` int(4) NOT NULL,
  `masterdegree` varchar(50) NOT NULL,
  `muniversity` varchar(60) NOT NULL,
  `myear` int(4) NOT NULL,
  `dateadded` datetime NOT NULL,
  `nda` varchar(15) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `consultants`
--

INSERT INTO `consultants` (`cid`, `status`, `cfname`, `cmname`, `clname`, `skill`, `co_email`, `cm_email`, `cm_password`, `cp_email`, `cp_password`, `colocation`, `cmlocation`, `co_phonenumber`, `cm_phonenumber`, `covisa`, `cmvisa`, `relocation`, `resume`, `visacopy`, `dlcopy`, `stateid`, `lastssn`, `passportcopy`, `passportnumber`, `passportcountry`, `bachelordegree`, `buniversity`, `byear`, `masterdegree`, `muniversity`, `myear`, `dateadded`, `nda`) VALUES
(2, 1, 'fnam', 'mnam', 'lnam', '1', 'oemail', 'asas', 'asasas', 'sasasas', 'sasasa', 'olocat', 'dsd', 'ophone', 'sasas', 'ovisa', 'sasas', 'relo', '4349699a992accd3bc9c2773bfb15a58.docx', '60ed9d760af38eafeb28dc1068098fe7.jpg', 'e85213a48b35c9066bef7ed3b893b058.jpg', '219a8718a4a844450c1871ed42a9427b.jpg', 85958, 'ea832e242a6b566cb38d47779dc56efa.jpg', '98989898989', 'coutry', 'sfsdfs', 'fj', 2312, 'sdfsdfs', 'sdfsdfsf', 1232, '2017-10-22 00:00:00', 'nda'),
(3, 1, 'a', 'ss', 'ik', '2', 'hgjk', 'rfad', 'dsds', 'asdas', 'asdasd', 'gh', '2ewds', '9876523', '2w', 'uh', '2w', 'ijh', '429ce50e46d1d1e2a7ebd2e8ca86fad6.docx', '0', '0', '0', 9876, '0', 'ft789', 'in', 'casc', 'ascasc', 2008, 'ssq', 'ws', 2010, '2017-10-22 00:40:45', 'Yes'),
(4, 1, 'Jvasjh', 'jh', 'jjh', '1', 'mbn', '0', '0', '0', '0', 'jhjklk', '0', 'jhkl', '0', 'jlkopijk', '0', 'jgvjhjkojkhb', '0', '0', '0', '0', 875466, '0', 'jfhgjk', 'jhg', '0', '0', 0, '0', '0', 0, '2017-10-30 02:12:32', 'Yes'),
(5, 1, 'ravi', 'r', 'mudda', '4', 'ravi@gmail.com', '0', '0', '0', '0', 'CO', '0', '987543210', '0', 'GC', '0', 'WA', '0', '0', '0', '0', 98765, '0', 'D987654321', 'India', '0', '0', 0, '0', '0', 0, '2018-09-19 00:00:00', 'Yes'),
(6, 1, 'bhaskar', 'reddy', 'Mudugala', '2', 'bhaskar@gmail.com', 'BASKAER@YAHOO.COM', '9875656', 'BHASKEAR@AOL.COM', '980099', 'TX', 'tx', '2149359809', '987654321', 'USC', 'opt', 'TX', '0', '0', '0', '0', 87654, '0', 'DSPPPLLLLA', 'iNDIA', 'DSDS', 'DS', 2051, 'UJK', 'IKL', 2015, '2018-09-01 09:30:27', 'Yes'),
(7, 1, 'SA', 'TH', 'OK', '3', 'RAT@GMAIL.COM', '0', '0', '0', '0', 'ma', '0', '2149359809', '0', 'H1B', '0', 'Open', 'faf012d0464aa6ecd6b36329b0dd8dec.docx', '7ddfc044a82eb57561693b7439d033ec.jpg', 'cd5f8e001b1e72bcae1884c8b6a51b7e.jpg', 'cb5a0c9ade9aec277ca40e7eff974e79.jpg', 98756, '7ddfc044a82eb57561693b7439d033ec.jpg', 'okokokoko', 'india', '0', '0', 0, '0', '0', 0, '2018-09-01 09:51:55', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `lists`
--

DROP TABLE IF EXISTS `lists`;
CREATE TABLE IF NOT EXISTS `lists` (
  `listid` int(11) NOT NULL AUTO_INCREMENT,
  `listname` varchar(20) NOT NULL,
  `uid` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` int(11) NOT NULL,
  `total` bigint(20) NOT NULL,
  PRIMARY KEY (`listid`),
  UNIQUE KEY `listid` (`listid`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lists`
--

INSERT INTO `lists` (`listid`, `listname`, `uid`, `date`, `status`, `total`) VALUES
(2, 'a', 1, '2018-02-04', 1, 7),
(4, 'java consultants', 1, '2018-09-01', 1, 2),
(5, 'java', 1, '2018-09-04', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `req`
--

DROP TABLE IF EXISTS `req`;
CREATE TABLE IF NOT EXISTS `req` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `duration` varchar(15) NOT NULL,
  `contract_type` int(11) NOT NULL,
  `visa` varchar(40) NOT NULL,
  `local` int(11) NOT NULL,
  `interview` varchar(30) NOT NULL,
  `sub_rate` int(11) DEFAULT NULL,
  `buy_rate` varchar(30) NOT NULL,
  `referral` int(11) DEFAULT NULL,
  `salary` varchar(40) DEFAULT NULL,
  `end_client` varchar(30) DEFAULT NULL,
  `tier1_ip` varchar(30) NOT NULL,
  `needonw2` int(11) NOT NULL,
  `description` longtext,
  `add_notes` varchar(50) DEFAULT NULL,
  `sm` varchar(15) NOT NULL,
  `number_of_subs` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `req`
--

INSERT INTO `req` (`id`, `title`, `location`, `duration`, `contract_type`, `visa`, `local`, `interview`, `sub_rate`, `buy_rate`, `referral`, `salary`, `end_client`, `tier1_ip`, `needonw2`, `description`, `add_notes`, `sm`, `number_of_subs`, `status`, `date`) VALUES
(1, 'Java Developer', 'Atlanta, GA', '6 months', 1, 'USC only', 1, 'F2F', 65, '', NULL, NULL, 'Delta Airlines', 'Datum Soft', 2, NULL, 'Backfill', 'Rahul', 0, 1, '2019-04-08 00:00:00'),
(2, 'Websphere Admin', 'Redmond, WA', '12+ Months', 1, 'No H1B', 1, 'Phone', 65, '50', 0, '0', 'Microsoft', 'Randstad', 1, 'Web Admin Middleware\r\nWashington, DC\r\nLong term Contract \r\nNO H1B\r\n\r\nPosition Overview:\r\nThe position is for maintenance and support of the F5 load balancing platform, JBoss EAS/EWS server, IBM WebSphere Application Server and IBM WebSphere Portal administrator in the Enterprise Services (EN) unit of ITS. The candidate will be responsible for the setup, configuration, administration, and maintenance of these application server platforms.\r\n\r\nEssential Job Functions:\r\n•	Hands on experience with F5 BIG-IP LTM, GTM and ASM modules\r\n•	Experience in deploying and maintaining F5 VIPRION and VCMP guests\r\n•	Create and maintain new F5 APM iRules in a modular fashion that can be easily extended\r\n•	Extensive experience in troubleshooting through use of tools such as Fiddler, HTTPWatch etc., is required\r\n•	Install, configure, and maintain JBoss EAS/EWS and Apache web servers, WebSphere Application server, WebSphere Portal server 7.x and IBM HTTP server\r\n•	Tune application server parameters for optimal system performance\r\n•	Install, configure, and maintain IBM MQ series queues for business application use\r\n•	Ensure proper setting of system memory and system parameters in consultation with system administrators\r\n•	Create and maintain application servers with optimal configurations and data source\r\n•	Aid developers in detecting performance problems and resolve application related issues\r\n•	Provide continuous monitoring, troubleshooting, and historical and real time performance monitoring of the application server environments\r\n•	Participate in "On Call” weekly shift supporting off hours and weekend activity (this is a rotating assignment shared with other members of the team, as necessary)\r\n•	Manage fully redundant load balanced WebSphere and JBoss services using F5 Load Balancer\r\n•	Develop and maintain Unix scripts supporting the web administration function\r\n•	Manage and setup JBoss and WebSphere services for Disaster Recovery\r\n•	Manage Production JBoss, WebSphere and Portal systems for mission critical applications in a complex environment with minimum supervision\r\n•	Follow ITIL process in the system maintenance including up-to-date documentation\r\n\r\nEducational Qualifications and Experience:\r\n•	Education: Bachelor''s degree in Engineering or Computer Science\r\n•	Role Specific Experience: 2+ years of experience directly related to web administration\r\n•	Experience in the management of JBoss Enterprise Application Servers, WebSphere, WebSphere Portal servers and web administration tasks in Red Hat Linux and IBM AIX environment\r\n•	Experience with Apache/web server/IBM HTTP server installation, configuration, and troubleshooting\r\n•	Hands on experience with F5 BIG-IP LTM, GTM and ASM modules\r\n•	Relevant experience with system backup and recovery\r\n•	Strong production experience in managing JBoss/WebSphere clustered load balanced environment for mission critical system\r\n\r\nCertification Requirements:\r\nF5/ RedHat JBoss/WebSphere certification\r\n\r\nRequired Skills/Abilities:\r\n•	Knowledge of Oracle and MS SQL database systems as backend to web applications\r\n•	Knowledge of web single sign-on using Azure AD, CA Site Minder and Federated services\r\n•	Good knowledge of Linux and AIX operating system\r\n•	Ability to diagnose and resolve web problems independently, as well as in collaboration with a team\r\n•	Excellent interpersonal skills\r\n\r\nDesired Skills/Abilities (not required but a plus):\r\n•	Familiarity with networking devices, protocols (TCP/IP), and corresponding access-related problems\r\n\r\nPluses for Levels: (for level II, III):\r\n•	Experience on AWS and Azure Cloud infrastructures\r\n•	DevOps experience\r\n•	Experience in developing Chef cookbook\r\n\r\nExperience Matrix for Levels: Level II - 5+ years of experience\r\n', 'Need local - F2F required', 'Rahul', 0, 1, '2019-04-11 00:00:00'),
(3, 'hjghjg', 'ssss', '3', 1, 'only USC', 3, 'phone', 65, '50', 0, '0', 'Vantic', 'Jonah', 1, 'fully remote', 'f2f hire', 'rahul', 0, 1, '2019-04-11 15:12:45'),
(4, 'SDET', 'Raleigh, NC ', '12-18 months+', 3, 'No H1B', 2, 'Phone and Skype', 65, '$45-55/hr', 0, '0', 'Ankur Chakraborty', 'Disys', 2, 'PHA+YWFzYXNhczwvcD4NCg==', 'asas', '1', 0, 1, '2019-04-12 09:12:31');

-- --------------------------------------------------------

--
-- Table structure for table `skill`
--

DROP TABLE IF EXISTS `skill`;
CREATE TABLE IF NOT EXISTS `skill` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `skillname` varchar(20) NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `skill`
--

INSERT INTO `skill` (`sid`, `skillname`) VALUES
(1, 'Java'),
(2, 'Network Engineer'),
(3, 'qa'),
(4, 'ba');

-- --------------------------------------------------------

--
-- Table structure for table `ulevel`
--

DROP TABLE IF EXISTS `ulevel`;
CREATE TABLE IF NOT EXISTS `ulevel` (
  `id` int(2) NOT NULL,
  `name` varchar(20) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ulevel`
--

INSERT INTO `ulevel` (`id`, `name`) VALUES
(1, 'Administrator'),
(2, 'Team Lead'),
(3, 'Recruiter');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(70) NOT NULL,
  `name` varchar(50) NOT NULL,
  `uhash` varchar(50) NOT NULL,
  `companyname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `sess` varchar(100) NOT NULL,
  `level` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  `ptext` varchar(500) NOT NULL,
  `lastloginip` varchar(15) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `name`, `uhash`, `companyname`, `email`, `password`, `sess`, `level`, `status`, `ptext`, `lastloginip`, `date`) VALUES
(1, 'admin@metahorizon.com', 'Satish', '41bc9d9d24d6ca5d7c66cc45a47996c3', 'metahorizon', 'admin@metahorizon.com', '89c20c70744598cd7a5a6e56d22f9c63', '0', 1, 1, 'YldWMFlXaHZjbWw2YjI0PQ==', '::1', '2019-06-29 16:55:08'),
(29, 'manoj@metahorizon.com', 'Manoj', 'acecf3231d1a3267ec40c61dfe20b5f9', 'Metahorizon Inc.', 'manoj@metahorizon.com', '98aaa910f7e758e24199c2c544b8fa34', '0', 2, 1, 'VFdGdWIyb3g=', '0.0.0.0', '2018-09-01 08:47:01'),
(30, 'raj@metahorizon.com', 'Raj', '48d6c5e472382147422811349afddb70', 'Metahorizon Inc.', 'raj@metahorizon.com', '378681381a18ae3a561d72096034cdca', '0', 2, 1, 'VW1GcU1RPT0=', '0.0.0.0', '2018-09-01 08:47:31'),
(31, 'santosh@metahorizon.com', 'Santosh', 'c935725b42675450d1887a0e9d75545b', 'Metahorizon Inc.', 'santosh@metahorizon.com', 'd48b1498acb61a5aaf0f0243d46f4502', '0', 3, 1, 'VTJGdWRHOXphREU9', '0.0.0.0', '2018-09-01 08:47:54');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
