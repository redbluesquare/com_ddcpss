<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

class DdcpssHelpersStyle
{
	public static function load()
	{
		$document = JFactory::getDocument();

		//stylesheets
		$document->addStylesheet(JURI::base().'components/com_ddcpss/assets/css/style.css');

		//javascripts
		$document->addScript(JURI::base().'components/com_ddcpss/assets/js/ddcpss.js');

	}
}