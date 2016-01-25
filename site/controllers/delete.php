<?php
defined ( '_JEXEC' ) or die ( 'Restricted access' );

/**
 *
 * @author Darryl
 *        
 */
class DdcpssControllersDelete extends JControllerBase {
	
	private $data = Null;
	
	public function execute() {
		
		$app = JFactory::getApplication ();
		$return = array ("success" => false	);
		$table = $app->input->get('table');
		$data = $app->input->get('jform', array(),'array');
		if($data['table']!=null)
		{
			$table=$data['table'];
		}
		
		if($table=='userexperience')
		{
			$id = $app->input->get('ddc_user_experience_id');
			
			$modelName  = $app->input->get('models', 'userexperience');
			$view       = $app->input->get('view', 'profiles');
			$layout     = $app->input->get('layout', '_uexp');
			$item       = $app->input->get('item', 'userexp');
			$modelName  = 'DdcpssModels'.ucwords($modelName);
			
			$model = new $modelName();
			
			if ( $row = $model->delete() )
			{
				$return['success'] = true;
				$return['msg'] = JText::_('COM_DDC_SAVE_SUCCESS');
				if($id==null){
					$return['html'] = null;
				}
				else{
					$return['html'] = null;
				}
				}else{
					$return['msg'] = JText::_('COM_DDC_SAVE_FAILURE');
			}
		}
		if($table=='usereducation')
		{
			$id = $app->input->get('ddc_user_education_id');
			
			$modelName  = $app->input->get('models', 'usereducation');
			$view       = $app->input->get('view', 'profiles');
			$layout     = $app->input->get('layout', '_uedu');
			$item       = $app->input->get('item', 'useredu');
			$modelName  = 'DdcpssModels'.ucwords($modelName);
			
			$model = new $modelName();
			
			if ( $row = $model->delete() )
			{
				$return['success'] = true;
				$return['msg'] = JText::_('COM_DDC_SAVE_SUCCESS');
				if($id==null){
					$return['html'] = null;
				}
				else{
					$return['html'] = null;
				}
				}else{
					$return['msg'] = JText::_('COM_DDC_SAVE_FAILURE');
			}
		}
		
		if($table=='usermembership')
		{
			$id = $data['ddc_user_membership_id'];
				
			$modelName  = $app->input->get('models', 'usermembership');
			$view       = $app->input->get('view', 'profiles');
			$layout     = $app->input->get('layout', '_usermembership');
			$item       = $app->input->get('item', 'usermem');
			$modelName  = 'DdcpssModels'.ucwords($modelName);
				
			$model = new $modelName();
				
			if ( $row = $model->delete() )
			{
				$return['success'] = true;
				$return['msg'] = JText::_('COM_DDC_SAVE_SUCCESS');
				if($id==null){
					$return['html'] = null;
				}
				else{
					$return['html'] = null;
				}
			}else{
				$return['msg'] = JText::_('COM_DDC_SAVE_FAILURE');
			}
		}
		
		if($table=='references')
		{
			$id = $data['ddc_reference_id'];
				
			$modelName  = $app->input->get('models', 'references');
			$view       = $app->input->get('view', 'profiles');
			$layout     = $app->input->get('layout', '_reference');
			$item       = $app->input->get('item', 'ref');
			$modelName  = 'DdcpssModels'.ucwords($modelName);
				
			$model = new $modelName();
				
			if ( $row = $model->delete($id) )
			{
				$return['success'] = true;
				$return['msg'] = JText::_('COM_DDC_SAVE_SUCCESS');
				if($id!=null){
					$return['html'] = null;
				}
				else{
					$return['html'] = null;
				}
			}else{
				$return['msg'] = JText::_('COM_DDC_SAVE_FAILURE');
			}
		}
		echo json_encode($return);
	}
		
}
