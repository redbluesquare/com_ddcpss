ALTER TABLE `#__ddc_references` 
CHANGE COLUMN `contact_name` `referee_name` VARCHAR(100) NOT NULL AFTER `ddc_reference_id`,
CHANGE COLUMN `job_title` `position` VARCHAR(100) NOT NULL AFTER `referee_name`,
CHANGE COLUMN `user_experience` `organisation` VARCHAR(100) NULL ,
CHANGE COLUMN `other_experience` `address` VARCHAR(300) NULL ,
CHANGE COLUMN `contact_number` `contact_number` VARCHAR(20) NOT NULL ,
CHANGE COLUMN `contact_email` `contact_email` VARCHAR(100) NOT NULL ,
ADD COLUMN `relationship` VARCHAR(100) NULL AFTER `contact_email`,
ADD COLUMN `timeframe` VARCHAR(50) NULL AFTER `relationship`;