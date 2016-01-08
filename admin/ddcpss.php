<?php // No direct access

defined( '_JEXEC' ) or die( 'Restricted access' );

ini_set('display_errors',1);
error_reporting(E_ALL);

//sessions
jimport( 'joomla.session.session' );

//load tables
JTable::addIncludePath(JPATH_COMPONENT.'/tables');

//load classes
JLoader::registerPrefix('Ddcpss', JPATH_COMPONENT);

//Load plugins
//JPluginHelper::importPlugin('ddcbookit');
 
//application
$app = JFactory::getApplication();
 
// Require specific controller if requested
$controller = $app->input->get('controller','default');

// Create the controller
$classname  = 'DdcpssControllers'.ucwords($controller);
$controller = new $classname();

JHtml::_('bootstrap.framework');
//Load styles and javascripts
DdcpssHelpersStyle::load();

// Perform the Request task
$controller->execute();