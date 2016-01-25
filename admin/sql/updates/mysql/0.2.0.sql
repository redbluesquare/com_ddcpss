CREATE TABLE IF NOT EXISTS `#__ddc_user_images` (
	`ddc_user_image_id` int(11) NOT NULL AUTO_INCREMENT,
  	`linked_table` varchar(100) default NULL,
  	`linked_table_id` int(11) default NULL,
  	`catid` int(11) default NULL,
  	`filepath` varchar(255) NOT NULL,
  	`filename` varchar(255) NOT NULL,
  	`alias` varchar(255) NOT NULL,
  	`user_id` varchar(45) NOT NULL,
  	`state` tinyint(3) NOT NULL,
  	`created` DATETIME NOT NULL default '0000-00-00 00:00:00',
  	`modified` DATETIME NOT NULL default '0000-00-00 00:00:00',
  	PRIMARY KEY (`ddc_user_image_id`),
  	KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;