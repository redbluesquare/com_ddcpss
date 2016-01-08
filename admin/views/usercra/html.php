<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 

class DdcpssViewsUsercraHtml extends JViewHtml
{
	protected $data;
	protected $form;
	protected $params;
	protected $state;

  function render()
  {
    $app = JFactory::getApplication();
    $layout = $this->getLayout();
    
    //retrieve task list from model
    $profileModel = new DdcpssModelsProfile();
    $userexpModel = new DdcpssModelsUserexperience();
    $usereduModel = new DdcpssModelsUsereducation();
    $usercraModel = new DdcpssModelsUsercra();

 
    switch($layout) {
    	case "default":
    		default:
    		$this->profile = $profileModel->getItem();
    		$this->items = $usercraModel->listItems();
    		$this->addToolbar();
    		// Set the submenu
    		DdcpssHelpersDdcpss::addSubmenu('usercra');
    	break;
    }
 
    //display
    return parent::render();
  }
  protected function addToolbar()
  {
  	$canDo  = DdcpssHelpersDdcpss::getActions();
  
  	// Get the toolbar object instance
  	$bar = JToolBar::getInstance('toolbar');
  
  	JToolBarHelper::title(JText::_('COM_DDC_CRA'));
  	
  
  	if ($canDo->get('core.admin'))
  	{
  		JToolbarHelper::preferences('com_ddcpss');
  	}
  }
}