<?php
defined ( '_JEXEC' ) or die ( 'Restricted access' );
//not have the correct permissions
jimport('joomla.filesystem.file');
jimport('joomla.filesystem.folder');
/**
 *
 * @author Darryl
 *        
 */
class DdcpssControllersAdd extends JControllerBase {
	
	private $data = Null;
	
	public function execute() {
		$table = null;
		$app = JFactory::getApplication ();
		$return = array ("success" => false	);
		$helperview = new DdcpssHelpersView();
		$data = $app->input->get('jform', array(),'array');
		if($data!=null){$table=$data['table'];}
		
		if($table=='userexperience')
		{
			$id = $app->input->get('ddc_user_experience_id');
			
			$modelName  = $app->input->get('models', 'userexperience');
			$view       = $app->input->get('view', 'profiles');
			$layout     = $app->input->get('layout', '_uexp');
			$item       = $app->input->get('item', 'userexp');
			$modelName  = 'DdcpssModels'.ucwords($modelName);
			
			$model = new $modelName();
			
			if ( $row = $model->store() )
			{
				$return['success'] = true;
				$return['msg'] = JText::_('COM_DDC_SAVE_SUCCESS');
				if($id==null){
					$return['html'] = $helperview->getHtml($view, $layout, $item, $row);
				}
				else{
					$return['html'] = null;
				}
				}else{
					$return['msg'] = JText::_('COM_DDC_SAVE_FAILURE');
			}
			echo json_encode($return);
		}
		else if($table=='references')
		{
			$id = $app->input->get($data['ddc_reference_id']);
				
			$modelName  = $app->input->get('models', 'references');
			$view       = $app->input->get('view', 'profiles');
			$layout     = $app->input->get('layout', '_reference');
			$item       = $app->input->get('item', 'ref');
			$modelName  = 'DdcpssModels'.ucwords($modelName);
				
			$model = new $modelName();
				
			if ( $row = $model->store() )
			{
				$return['success'] = true;
				$return['msg'] = JText::_('COM_DDC_SAVE_SUCCESS');
				if($id==null){
					$return['html'] = $helperview->getHtml($view, $layout, $item, $row);
				}
				else{
					$return['html'] = null;
				}
			}else{
				$return['msg'] = JText::_('COM_DDC_SAVE_FAILURE');
			}
			echo json_encode($return);
		}
		
		else if($table=='usereducation')
		{
			$id = $app->input->get('ddc_user_education_id');
			
			$modelName  = $app->input->get('models', 'usereducation');
			$view       = $app->input->get('view', 'profiles');
			$layout     = $app->input->get('layout', '_uedu');
			$item       = $app->input->get('item', 'useredu');
			$modelName  = 'DdcpssModels'.ucwords($modelName);
			
			$model = new $modelName();
			
			if ( $row = $model->store() )
			{
				$return['success'] = true;
				$return['msg'] = JText::_('COM_DDC_SAVE_SUCCESS');
				if($id==null){
					$return['html'] = $helperview->getHtml($view, $layout, $item, $row);
				}
				else{
					$return['html'] = null;
				}
				}else{
					$return['msg'] = JText::_('COM_DDC_SAVE_FAILURE');
			}
			echo json_encode($return);
		}
		else if($table=='usermembership')
		{
							
			$modelName  = $app->input->get('models', 'usermembership');
			$view       = $app->input->get('view', 'profiles');
			$layout     = $app->input->get('layout', '_usermembership');
			$item       = $app->input->get('item', 'usermem');
			$modelName  = 'DdcpssModels'.ucwords($modelName);
				
			$model = new $modelName();
				
			if ( $row = $model->store() )
			{
				$return['success'] = true;
				$return['msg'] = JText::_('COM_DDC_SAVE_SUCCESS');
				$return['html'] = $helperview->getHtml($view, $layout, $item, $row);

			}else{
				$return['msg'] = JText::_('COM_DDC_SAVE_FAILURE');
			}
			echo json_encode($return);
		}
		else if($table=='usercra')
		{
			$id = $app->input->get('ddc_user_cra_id');
				
			$modelName  = $app->input->get('models', 'usercra');
			$view       = $app->input->get('view', 'profiles');
			$modelName  = 'DdcpssModels'.ucwords($modelName);
				
			$model = new $modelName();
				
			if ( $row = $model->store() )
			{
				$return['success'] = true;
				$return['msg'] = JText::_('COM_DDC_SAVE_SUCCESS');
				if($id==null){
					$return['html'] = $row;
				}
				else{
					$return['html'] = null;
				}
			}else{
				$return['msg'] = JText::_('COM_DDC_SAVE_FAILURE');
			}
			echo json_encode($return);
		}
		else if($table=='aboutme')
		{
			$abtme = $data['aboutme'];		
			$modelName  = $app->input->get('models', 'profile');
			$view       = $app->input->get('view', 'profiles');
			$modelName  = 'DdcpssModels'.ucwords($modelName);
		
			$model = new $modelName();
		
			if ( $row = $model->updateAboutMe($abtme) )
			{
				$return['html'] = $row;
				$return['success'] = true;
				$return['msg'] = JText::_('COM_DDC_SAVE_SUCCESS');
				
			}else{
				$return['msg'] = JText::_('COM_DDC_SAVE_FAILURE');
			}
			echo json_encode($return);
		}
		else if($table=='userprofiledetails')
		{
			$modelName  = $app->input->get('models', 'profile');
			$view       = $app->input->get('view', 'profiles');
			$modelName  = 'DdcpssModels'.ucwords($modelName);
		
			$model = new $modelName();
		
			if ( $row = $model->updateUserProfile() )
			{
				$row = $model->getuserProfile();
				$return['html'] = $row;
				$return['success'] = true;
				$return['msg'] = JText::_('COM_DDC_SAVE_SUCCESS');
		
			}else{
				$return['msg'] = JText::_('COM_DDC_SAVE_FAILURE');
			}
			echo json_encode($return);
		}
		else if($table=='progress')
		{
			$session = JFactory::getSession();
			$session->set('check_progress', 0);
		}
		else if($table=='progressComplete')
		{
			$modelName  = $app->input->get('models', 'profile');
			$view       = $app->input->get('view', 'profiles');
			$modelName  = 'DdcpssModels'.ucwords($modelName);
			$model = new $modelName();
			if ( $row = $model->updateprocessComplete() )
			{
				$row = $model->getuserProfile();
				$return['html'] = $row;
				$return['success'] = true;
				$return['msg'] = JText::_('COM_DDC_SAVE_SUCCESS');
			
			}else{
				$return['msg'] = JText::_('COM_DDC_SAVE_FAILURE');
			}
		}
		else if($table=='updatephoto')
		{
			if($_FILES["upload_photo"]["error"] == 0)
			{
				$db = JFactory::getDbo();
				$query = $db->getQuery(true);
				$query->select('profile_value');
				$query->from($db->quoteName('#__user_profiles'));
				$query->where($db->quoteName('user_id')." = ".JFactory::getUser()->id);
				$query->where($db->quoteName('profile_key')." = 'ddcpss.photo'");
				$db->setQuery($query);
				$result = $db->loadResult();
		
				unlink("/media/ddcpss/images/".$result);
				
				$user = JFactory::getUser()->username;
				$modelName  = $app->input->get('models', 'profile');
				$modelName  = 'DdcpssModels'.ucwords($modelName);
				$model = new $modelName();
			
				$fileName = $_FILES["upload_photo"]["name"];
				$fileTmpLoc = $_FILES["upload_photo"]["tmp_name"];
				$fileType = $_FILES["upload_photo"]["type"];
				$fileSize = $_FILES["upload_photo"]["size"];
				$fileErrorMsg = $_FILES["upload_photo"]["error"];
				$ext = explode(".", $fileName);
				$ext = $ext[1];
				$fname = date("Ymdhhiiss").$user."_temp.".$ext;
				$newName = date("Ymdhhiiss").$user.".".$ext;
				$dest = $fname;
				$dest1 = $newName;
					
				if(!$fileTmpLoc)
				{
					$return["html"] = "Error, please first select a file!";
					exit();
				}
				else if($fileSize > 5242880)
				{ // if file size is larger than 5 Megabytes
					$return["html"] = "ERROR: Your file was larger than 5 Megabytes in size.";
					unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
					exit();
				}
				else if (!preg_match("/.(gif|jpg|png)$/i", $fileName) )
				{
					// This condition is only if you wish to allow uploading of specific file types
					$return["html"] = "ERROR: Your image was not .gif, .jpg, or .png.";
					unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
					exit();
				}
				else if ($fileErrorMsg == 1)
				{ // if file upload error key is equal to 1
					$return["html"] = "ERROR: An error occured while processing the file. Try again.";
					exit();
				}
				// Place it into your "uploads" folder mow using the move_uploaded_file() function
				$moveResult = move_uploaded_file($fileTmpLoc, JPATH_ROOT."/media/ddcpss/images/".$dest);
				// Check to make sure the move result is true before continuing
				if ($moveResult != true)
				{
					echo "ERROR: File not uploaded. Try again.";
					unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
					exit();
				}
				//unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
				// ---------- Include Universal Image Resizing Function --------
			
				$target_file = JPATH_ROOT."/media/ddcpss/images/".$dest;
				$resized_file = JPATH_ROOT."/media/ddcpss/images/".$dest1;
				$wmax = 200;
				$hmax = 150;
				$model->profile_img_resize($target_file, $resized_file, $wmax, $hmax, $ext);
				unlink(JPATH_ROOT."/media/ddcpss/images/".$dest);
				// ----------- End Universal Image Resizing Function -----------
				if ( $row = $model->uploadPhoto($dest1) )
				{
					$return['success'] = true;
					$return['msg'] = JText::_('COM_DDC_SAVE_SUCCESS');
					$return['html'] = JUri::root()."/media/ddcpss/images/".$dest1;
						
				}else{
					$return['html'] = JText::_('COM_DDC_SAVE_FAILURE');
				}	
			}
			echo $return["html"];
		}
		else if($table=='mycv')
		{
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query->select('profile_value');
			$query->from($db->quoteName('#__user_profiles'));
			$query->where($db->quoteName('user_id')." = '".JFactory::getUser()->id."'");
			$query->where($db->quoteName('profile_key')." = 'ddcpss.cv'");
			$db->setQuery($query);
			$result = $db->loadResult();
			unlink(JPATH_ROOT."/media/ddcpss/cv_lib/".$result);
			
			$user = JFactory::getUser()->username;
			$modelName  = $app->input->get('models', 'profile');
			$modelName  = 'DdcpssModels'.ucwords($modelName);
			$model = new $modelName();
				
			$fileName = $_FILES["upload_cv"]["name"];
			$fileTmpLoc = $_FILES["upload_cv"]["tmp_name"];
			$fileType = $_FILES["upload_cv"]["type"];
			$fileSize = $_FILES["upload_cv"]["size"];
			$fileErrorMsg = $_FILES["upload_cv"]["error"];
			$ext = explode(".", $fileName);
			$ext = $ext[1];
			$fname = date("Ymdhhiiss").$user."_temp.".$ext;
			$newName = date("Ymdhhiiss").$user.".".$ext;
			$dest = $newName;
				
			if(!$fileTmpLoc)
			{
				echo $return["html"] = "Error, please first select a file!";
				exit();
			}
			else if($fileSize > 5242880)
			{ // if file size is larger than 5 Megabytes
				echo $return["html"] = "ERROR: Your file was larger than 5 Megabytes in size.";
				unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
				exit();
			}
			else if (!preg_match("/.(doc|pdf|docx)$/i", $fileName) )
			{
				// This condition is only if you wish to allow uploading of specific file types
				echo $return["html"] = "ERROR: Your image was not .doc, .docx, or .pdf.";
				unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
				exit();
			}
			else if ($fileErrorMsg == 1)
			{ // if file upload error key is equal to 1
				echo $return["html"] = "ERROR: An error occured while processing the file. Try again.";
				exit();
			}
			// Place it into your "uploads" folder mow using the move_uploaded_file() function
			$moveResult = move_uploaded_file($fileTmpLoc, JPATH_ROOT."/media/ddcpss/cv_lib/".$dest);
			// Check to make sure the move result is true before continuing
			if ($moveResult != true)
			{
				echo $return['html'] = "ERROR: File not uploaded. Try again.";
				unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
				exit();
			}
			//unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
			if ( $row = $model->uploadCV($dest) )
			{
				$return['success'] = true;
				$return['msg'] = JText::_('COM_DDC_SAVE_SUCCESS');
				$return['html'] = JUri::root()."/media/ddcpss/cv_lib/".$dest;
		
			}else{
				$return['html'] = JText::_('COM_DDC_SAVE_FAILURE');
			}
			echo $return['html'];
		}
		else if($table=='user_images')
		{
			$user = JFactory::getUser()->username;
			$modelName  = $app->input->get('models', 'profile');
			$modelName  = 'DdcpssModels'.ucwords($modelName);
			$model = new $modelName();
			
			$fileName = $_FILES["file_upload"]["name"];
			$fileTmpLoc = $_FILES["file_upload"]["tmp_name"];
			$fileType = $_FILES["file_upload"]["type"];
			$fileSize = $_FILES["file_upload"]["size"];
			$fileErrorMsg = $_FILES["file_upload"]["error"];
			$ext = explode(".", $fileName);
			$ext = $ext[1];
			$fname = date("Ymdhhiiss").$user."_temp.".$ext;
			$newName = date("Ymdhhiiss").$user.".".$ext;
			$filepath = JPATH_ROOT."/media/ddcpss/docs/";
			$filepathuri = "media/ddcpss/docs/";
			$filename = $newName;
			
			if(!$fileTmpLoc)
			{
				echo $return["html"] = "Error, please first select a file!";
				exit();
			}
			else if($fileSize > 5242880)
			{ // if file size is larger than 5 Megabytes
			echo $return["html"] = "ERROR: Your file was larger than 5 Megabytes in size.";
			unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
			exit();
			}
			else if (!preg_match("/.(doc|pdf|docx|jpg|png|bmp|gif)$/i", $fileName) )
			{
				// This condition is only if you wish to allow uploading of specific file types
				$return['msg'] = "ERROR: Your file was not .jpg, .gif, .png, .bmp, .doc, .docx, or .pdf.";
				$return['success'] = false;
				echo json_encode($return);
				unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
				exit();
			}
			else if ($fileErrorMsg == 1)
			{ // if file upload error key is equal to 1
				$return["msg"] = "ERROR: An error occured while processing the file. Try again.";
				$return['success'] = false;
				echo json_encode($return);			
			exit();
			}
			
			// Place it into your "uploads" folder mow using the move_uploaded_file() function
			$moveResult = move_uploaded_file($fileTmpLoc, $filepath.$filename);
			// Check to make sure the move result is true before continuing
			if ($moveResult != true)
			{
				$return['msg'] = "ERROR: File not uploaded. Try again.";
				$return['success'] = false;
				echo json_encode($return);
				
				unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
				exit();
			}
			if($data['alias']==null)
			{
				$data['alias'] = $fileName;
			}
			$data['filename'] = $filename;
			$data['filepath'] = $filepathuri;
			//unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
			if ( $row = $model->uploadFile($data) )
			{
				$return['success'] = true;
				$return['msg'] = JText::_('COM_DDC_SAVE_SUCCESS');
				$return['html'] = JUri::root()."/media/ddcpss/docs/".$filename;
			
			}else{
				$return['html'] = JText::_('COM_DDC_SAVE_FAILURE');
			}
			
			$return['table'] = $table;
			
			
			echo json_encode($return);
		}
		
	}
		
}