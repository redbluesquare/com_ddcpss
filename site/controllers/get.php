<?php
defined ( '_JEXEC' ) or die ( 'Restricted access' );

/**
 *
 * @author Darryl
 *        
 */
class DdcpssControllersGet extends JControllerBase {
	
	private $data = Null;
	
	public function execute() {
		
		$app = JFactory::getApplication ();
		$return = array ("success" => false	);
		$table = $app->input->get('table');
		
		if($table=='userexperience')
		{
			$modelName  = $app->input->get('models', 'userexperience');
			$view       = $app->input->get('view', 'profiles');
			$layout     = $app->input->get('layout', 'default');
			$item       = $app->input->get('item', 'userexperience');
			$modelName  = 'DdcpssModels'.ucwords($modelName);
			
			$model = new $modelName();
			
			if ( $row = $model->getItem() )
			{
				$return['success'] = true;
				$return['msg'] = JText::_('COM_DDC_SAVE_SUCCESS');
				$return['html'] = $row;
			}else{
				$return['msg'] = JText::_('COM_DDC_SAVE_FAILURE');
			}
		}
		if($table=='usereducation')
		{
			$modelName  = $app->input->get('models', 'usereducation');
			$view       = $app->input->get('view', 'profiles');
			$layout     = $app->input->get('layout', 'default');
			$item       = $app->input->get('item', 'usereducation');
			$modelName  = 'DdcpssModels'.ucwords($modelName);
			
			$model = new $modelName();
			
			if ( $row = $model->getItem() )
			{
				$return['success'] = true;
				$return['msg'] = JText::_('COM_DDC_SAVE_SUCCESS');
				$return['html'] = $row;
			}else{
				$return['msg'] = JText::_('COM_DDC_SAVE_FAILURE');
			}
		}
		if($table=='references')
		{
			$modelName  = $app->input->get('models', 'references');
			$view       = $app->input->get('view', 'profiles');
			$layout     = $app->input->get('layout', 'default');
			$item       = $app->input->get('item', 'ref');
			$modelName  = 'DdcpssModels'.ucwords($modelName);
				
			$model = new $modelName();
				
			if ( $row = $model->getItem() )
			{
				$return['success'] = true;
				$return['msg'] = JText::_('COM_DDC_SAVE_SUCCESS');
				$return['html'] = $row;
			}else{
				$return['msg'] = JText::_('COM_DDC_SAVE_FAILURE');
			}
		}
		if($table=='profiles')
		{
			$modelName  = $app->input->get('models', 'profile');
			$view       = $app->input->get('view', 'profiles');
			$layout     = $app->input->get('layout', 'default');
			$item       = $app->input->get('item', 'aboutus');
			$modelName  = 'DdcpssModels'.ucwords($modelName);
			$model = new $modelName();
		
			if ( $row = $model->getItem() )
			{
				$return['success'] = true;
				$return['html'] = $row;
			}else{
				$return['msg'] = JText::_('COM_DDC_SAVE_FAILURE');
			}
		}
		
		if($table=='userprofiledetails')
		{
			$modelName  = $app->input->get('models', 'profile');
			$view       = $app->input->get('view', 'profiles');
			$layout     = $app->input->get('layout', 'default');
			$item       = $app->input->get('item', 'userprofile');
			$modelName  = 'DdcpssModels'.ucwords($modelName);
			$model = new $modelName();
			
			if ( $row = $model->getuserProfile() )
			{
				$return['success'] = true;
				$return['html'] = $row;
			}else{
				$return['success'] = false;
				$return['msg'] = JText::_('COM_DDC_SAVE_FAILURE');
			}
		}
		
		if($table=='usermembership')
		{
			$modelName  = $app->input->get('models', 'usermembership');
			$view       = $app->input->get('view', 'profiles');
			$layout     = $app->input->get('layout', 'default');
			$item       = $app->input->get('item', 'usermem');
			$modelName  = 'DdcpssModels'.ucwords($modelName);
		
			$model = new $modelName();
		
			if ( $row = $model->getItem() )
			{
				$return['success'] = true;
				$return['msg'] = JText::_('COM_DDC_SAVE_SUCCESS');
				$return['html'] = $row;
			}else{
				$return['msg'] = JText::_('COM_DDC_SAVE_FAILURE');
			}
		}
		echo json_encode($return);
	}
		
}
