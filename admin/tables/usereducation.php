<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class TableUsereducation extends JTable
{                      
  /**
  * Constructor
  *
  * @param object Database connector object
  */
	var $ddc_user_education_id 	= null;
	
	function __construct( &$db )
	{
    	parent::__construct('#__ddc_user_education', 'ddc_user_education_id', $db);
  	}
}