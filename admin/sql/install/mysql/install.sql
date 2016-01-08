CREATE TABLE IF NOT EXISTS `#__ddc_user_cra` (
	`ddc_user_cra_id` int(11) NOT NULL AUTO_INCREMENT,
  	`user_title` tinyint(3) NOT NULL,
  	`gender` varchar(3) NOT NULL,
  	`current_forename` varchar(100) NOT NULL,
  	`current_surname` varchar(100) NOT NULL,
  	`previous_forename` varchar(100) default NULL,
  	`previous_surname` varchar(100) default NULL,
  	`national_insurance_number` varchar(30) default NULL,
  	`birth_town` text NOT NULL,
  	`birth_county` varchar(45) NOT NULL,
  	`birth_country` varchar(45) NOT NULL,
  	`nationality` varchar(45) NOT NULL,
  	`dbs_certificate` tinyint(3) default NULL,
  	`dbs_certificate_number` varchar(50) default NULL,
  	`dbs_renewal_service` tinyint(3) NOT NULL,
  	`dbs_number` varchar(50) NOT NULL,
  	`user_id` int(11) NOT NULL,
  	`state` tinyint(3) NOT NULL,
  	`created` DATETIME NOT NULL default '0000-00-00 00:00:00',
  	`modified` DATETIME NOT NULL default '0000-00-00 00:00:00',
  	PRIMARY KEY (`ddc_user_cra_id`),
  	KEY `post_code` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `#__ddc_user_experience` (
	`ddc_user_experience_id` int(11) NOT NULL AUTO_INCREMENT,
  	`company_name` varchar(100) NOT NULL,
  	`job_title` varchar(100) NOT NULL,
  	`location` varchar(100) NOT NULL,
  	`start_month` int(2) default NULL,
  	`start_year` int(4) default NULL,
  	`end_month` int(2) default NULL,
  	`end_year` int(4) default NULL,
  	`current_employer` tinyint(3) NOT NULL Default '0',
  	`description` text NOT NULL,
  	`user_id` varchar(45) NOT NULL,
  	`state` tinyint(3) NOT NULL,
  	`created` DATETIME NOT NULL default '0000-00-00 00:00:00',
  	`modified` DATETIME NOT NULL default '0000-00-00 00:00:00',
  	PRIMARY KEY (`ddc_user_experience_id`),
  	KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `#__ddc_user_education` (
	`ddc_user_education_id` int(11) NOT NULL AUTO_INCREMENT,
  	`school` varchar(100) NOT NULL,
  	`start_year` int(4) default NULL,
  	`end_year` int(4) default NULL,
  	`degree` varchar(100) default NULL,
  	`field_of_study` varchar(100) default NULL,
  	`grade` varchar(100) default NULL,
  	`activities` varchar(100) default NULL,
  	`education_description` text NOT NULL,
  	`user_id` varchar(45) NOT NULL,
  	`state` tinyint(3) NOT NULL,
  	`created` DATETIME NOT NULL default '0000-00-00 00:00:00',
  	`modified` DATETIME NOT NULL default '0000-00-00 00:00:00',
  	PRIMARY KEY (`ddc_user_education_id`),
  	KEY `post_code` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `#__ddc_references` (
	`ddc_reference_id` int(11) NOT NULL AUTO_INCREMENT,
	`referee_name` varchar(100) NOT NULL,
	`job_title` varchar(100) NOT NULL,
	`organisation` varchar(100) NULL,
	`address` varchar(300) default NULL,
  	`contact_number` varchar(20) NOT NULL,
  	`contact_email` varchar(100) default NULL,
  	`relationship` varchar(100) ,
  	`timeframe` varchar(50) NULL,
  	`contact_early` tinyint(3) Not NULL default '1',
  	`notes` text default NULL,
  	`user_id` int(11) NOT NULL,
  	`state` tinyint(3) NOT NULL,
  	`created` DATETIME NOT NULL default '0000-00-00 00:00:00',
  	`modified` DATETIME NOT NULL default '0000-00-00 00:00:00',
  	PRIMARY KEY (`ddc_reference_id`),
  	KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `#__ddc_user_membership` (
	`ddc_user_membership_id` int(11) NOT NULL AUTO_INCREMENT,
  	`title` varchar(100) NOT NULL,
  	`alias` varchar(100) NOT NULL,
  	`membership_number` varchar(100) default NULL,
  	`expiry_date` DATETIME NOT NULL default '0000-00-00 00:00:00',
  	`user_id` varchar(45) NOT NULL,
  	`state` tinyint(3) NOT NULL,
  	`created` DATETIME NOT NULL default '0000-00-00 00:00:00',
  	`modified` DATETIME NOT NULL default '0000-00-00 00:00:00',
  	PRIMARY KEY (`ddc_user_membership_id`),
  	KEY `post_code` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;