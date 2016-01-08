<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_ddcbookit
 */

defined('_JEXEC') or die;

/**
 * Ddcpss component helper.
 *
 * @package     Joomla.Administrator
 * @subpackage  com_ddcpss
 * @since       1.6
 */
class DdcpssHelpersDdcpss
{
	public static $extension = 'com_ddcpss';

	/**
	 * @return  JObject
	 */
	public static function getActions()
	{
		$user	= JFactory::getUser();
		$result	= new JObject;

		$assetName = 'com_ddcpss';
		$level = 'component';

		$actions = JAccess::getActions('com_ddcpss', $level);

		foreach ($actions as $action)
		{
			$result->set($action->name,	$user->authorise($action->name, $assetName));
		}

		return $result;
	}
	
	public static function addSubmenu($submenu)
	{
		JSubMenuHelper::addEntry(JText::_('COM_DDC_DASHBOARD'),
		'index.php?option=com_ddcpss&view=dashboard', $submenu == 'dashboard');
		JSubMenuHelper::addEntry(JText::_('COM_DDC_EXPERIENCE'),
		'index.php?option=com_ddcpss&view=userexperience', $submenu == 'userexperience');
		JSubMenuHelper::addEntry(JText::_('COM_DDC_EDUCATION'),
		'index.php?option=com_ddcpss&view=usereducation', $submenu == 'usereducation');
		JSubMenuHelper::addEntry(JText::_('COM_DDC_CRA'),
		'index.php?option=com_ddcpss&view=usercra', $submenu == 'usercra');
		
		// set some global property
		$document = JFactory::getDocument();

		if ($submenu == 'categories')
		{
			$document->setTitle(JText::_('COM_DDCPSS_ADMINISTRATION_CATEGORIES'));
		}
	}
}