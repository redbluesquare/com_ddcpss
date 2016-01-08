<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 

// import Joomla controlleradmin library
jimport('joomla.application.component.controlleradmin');

class DdcpssControllersDefault extends JControllerBase
{
  public function execute()
  {
  	// Get the application
  	$app = JFactory::getApplication();
  	
  	$params = JComponentHelper::getParams('com_ddcpss');
  	if ($params->get('required_account')==1)
  	{
  		$user = JFactory::getUser();
  		if($user->get('guest'))
  		{
  			$app->redirect('index.php',JText::_('COM_ACCOUNT_REQUIRED_MSG'));
  		}
  		 
  	}
  	
  	// Get the document object.
  	$document     = JFactory::getDocument();
  	
  	$viewName     = $app->input->getWord('view', 'profiles');
  	$viewFormat   = $document->getType();
  	$layoutName   = $app->input->getWord('layout', 'default');
  	
  	$app->input->set('view', $viewName);
  	
  	// Register the layout paths for the view
  	$paths = new SplPriorityQueue;
  	$paths->insert(JPATH_COMPONENT . '/views/' . $viewName . '/tmpl', 'normal');
  	
  	$viewClass  = 'DdcpssViews' . ucfirst($viewName) . ucfirst($viewFormat);
  	$modelClass = 'DdcpssModels' . ucfirst($viewName);
  	
  	if (false === class_exists($modelClass))
  	{
  		$modelClass = 'DdcpssModelsDefault';
  	}
  	
  	$view = new $viewClass(new $modelClass, $paths);
  	
  	$view->setLayout($layoutName);
  	
  	// Render our view.
  	echo $view->render();
  	
  	return true;
  }

}