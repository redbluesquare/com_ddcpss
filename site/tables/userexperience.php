<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class TableUserexperience extends JTable
{                      
  /**
  * Constructor
  *
  * @param object Database connector object
  */
	var $ddc_user_experience_id 	= null;
	
	function __construct( &$db )
	{
    	parent::__construct('#__ddc_user_experience', 'ddc_user_experience_id', $db);
  	}
}