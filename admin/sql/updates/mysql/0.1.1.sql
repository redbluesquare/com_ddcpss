CREATE TABLE IF NOT EXISTS `#__ddc_references` (
	`ddc_reference_id` int(11) NOT NULL AUTO_INCREMENT,
  	`user_experience` varchar(100) NOT NULL,
  	`other_experience` varchar(100) NOT NULL,
  	`contact_name` varchar(100) NOT NULL,
  	`job_title` varchar(100) NOT NULL,
  	`contact_number` varchar(20) default NULL,
  	`contact_email` varchar(100) default NULL,
  	`notes` text default NULL,
  	`user_id` varchar(45) NOT NULL,
  	`state` tinyint(3) NOT NULL,
  	`created` DATETIME NOT NULL default '0000-00-00 00:00:00',
  	`modified` DATETIME NOT NULL default '0000-00-00 00:00:00',
  	PRIMARY KEY (`ddc_reference_id`),
  	KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;