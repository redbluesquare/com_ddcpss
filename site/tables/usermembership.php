<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class TableUsermembership extends JTable
{                      
  /**
  * Constructor
  *
  * @param object Database connector object
  */
	var $ddc_user_membership_id 	= null;
	
	function __construct( &$db )
	{
    	parent::__construct('#__ddc_user_membership', 'ddc_user_membership_id', $db);
  	}
}