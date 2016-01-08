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