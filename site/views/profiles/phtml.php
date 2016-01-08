<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
//Display partial views
class DdcpssViewsProfilesPhtml extends JViewHTML
{
    function render()
    {
    	$this->params = JComponentHelper::getParams('com_ddcpss');
    	
    	return parent::render();
 	}
}