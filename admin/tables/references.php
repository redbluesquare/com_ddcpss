<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class TableReferences extends JTable
{                      
  /**
  * Constructor
  *
  * @param object Database connector object
  */
	var $ddc_reference_id 	= null;
	
	function __construct( &$db )
	{
    	parent::__construct('#__ddc_references', 'ddc_reference_id', $db);
  	}
}