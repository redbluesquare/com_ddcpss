<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
jimport('joomla.installer.installer');
jimport('joomla.installer.helper');
jimport('joomla.filesystem.folder');

class com_DdcpssInstallerScript
{
	/**
	 * Method to install the component
	 *
	 * @param  mixed    $parent     The class calling this method
	 * @return void
	 */
	function install($parent)
	{
		$path = JPATH_ROOT."/media/ddcpss/docs";
		if(!JFolder::exists($path))
		{
			JFolder::create($path);
			echo JText::_('COM_DDC_FOLDER_CREATED');
		}
		echo JText::_('COM_DDCPSS_INSTALL_SUCCESSFULL');
	}
	/**
	 * Method to update the component
	 *
	 * @param  mixed  $parent   The class calling this method
	 * @return void
	 */
	function update($parent)
	{
		$path = JPATH_ROOT."/media/ddcpss/docs";
		if(!JFolder::exists($path))
		{
			JFolder::create($path);
			echo JText::_('COM_DDC_FOLDER_CREATED');
		}
		echo JText::_('COM_DDCPSS_UPDATE_SUCCESSFULL');
	}
	/**
	 * method to run before an install/update/uninstall method
	 *
	 * @param  mixed  $parent   The class calling this method
	 * @return void
	 */
	function preflight($type, $parent)
	{
	
	}
	
	function postflight($type, $parent)
	{
		$path = JPATH_ROOT."/media/ddcpss/docs";
		JFolder::create($path);
	}
}
