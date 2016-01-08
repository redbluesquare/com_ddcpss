<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

class DdcpssHelpersStyle
{
	public static function load()
	{
		$document = JFactory::getDocument();

		//stylesheets
		//$document->addStylesheet(JURI::base().'components/com_ddcpss/assets/css/style.css');

		//javascripts
		$document->addScript('https://ajax.googleapis.com/ajax/libs/angularjs/1.3.8/angular.min.js');

	}
}