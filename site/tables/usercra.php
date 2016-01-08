<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class TableUsercra extends JTable
{                      
  /**
  * Constructor
  *
  * @param object Database connector object
  */
	var $ddc_user_cra_id 	= null;
	
	function __construct( &$db )
	{
    	parent::__construct('#__ddc_user_cra', 'ddc_user_cra_id', $db);
  	}
}