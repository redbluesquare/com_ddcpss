<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 



class DdcpssViewsProfilesHtml extends JViewHtml
{
	protected $data;
	protected $form;
	protected $params;
	protected $state;
	
	
	
  function render()
  {
  	require_once JPATH_SITE.'/components/com_users/models/profile.php';
    $app = JFactory::getApplication();
    $layout = $this->getLayout();
    
    //retrieve task list from model
    $profileModel = new DdcpssModelsProfile();
    $userexpModel = new DdcpssModelsUserexperience();
    $usermemModel = new DdcpssModelsUsermembership();
    $usereduModel = new DdcpssModelsUsereducation();
    $usercraModel = new DdcpssModelsUsercra();
    $referencesModel = new DdcpssModelsReferences();
    $modelReference = new DdcpssModelsReference();
    $profModel = new UsersModelProfile();
    $helper = new DdcpssHelpersView();
    
 
    switch($layout) {
    	case "profiles":
    		default:
    		$this->params = JComponentHelper::getParams('com_users');
    		$this->profile = $profileModel->getItem();
    		$this->usercra = $usercraModel->getItem();
    		$this->references = $referencesModel->listItems();
    		$this->userschools = $usereduModel->listItems();
    		$this->userexperiences = $userexpModel->listItems();
    		$this->usermemberships = $usermemModel->listItems();
    		$this->_refListView = $helper->load('Profiles','_reference','phtml');
    		$this->_uexpListView = $helper->load('Profiles','_uexp','phtml');
    		$this->_umembershipListView = $helper->load('Profiles','_usermembership','phtml');
    		$this->_ueduListView = $helper->load('Profiles','_uedu','phtml');
    		$this->fm = $profModel->getForm();
    		$this->form = $modelReference->getForm();
    	break;
    }
 
    //display
    return parent::render();
  } 
}