<?php // No direct access


defined( '_JEXEC' ) or die( 'Restricted access' );

$lang = JFactory::getLanguage();
$extension = 'com_users';
$base_dir = JPATH_SITE;
$language_tag = 'en-GB';
$reload = true;
$lang->load($extension, $base_dir, $language_tag, $reload);


//sessions
jimport( 'joomla.session.session' );
 
//load tables
JTable::addIncludePath(JPATH_COMPONENT.'/tables');

//load classes
JLoader::registerPrefix('Ddcpss', JPATH_COMPONENT);

//Load plugins
//JPluginHelper::importPlugin('ddcpss');
 
//Load styles and javascripts
DdcpssHelpersStyle::load();

//application
$app = JFactory::getApplication();
 
// Require specific controller if requested
$controller = $app->input->get('controller','default');

// Create the controller
$classname  = 'DdcpssControllers'.ucwords($controller);
$controller = new $classname();
 
// Perform the Request task
$controller->execute();