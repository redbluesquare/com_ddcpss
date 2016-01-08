<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 

class DdcpssModelsProfile extends DdcpssModelsDefault
{
 
    //Define class level variables
  	var $_user_id     = null;
  	var $_cat_id	  = null;
  	var $_published   = 1;
  	var $_app		  = null;
  	var $_data		  = null;

  function __construct()
  {

    $this->_app = JFactory::getApplication();

    //If no User ID is set to current logged in user
    $this->_user_id = $this->_app->input->get('profile_id', JFactory::getUser()->id);
    $this->_data = $this->_app->input->get('jform', array(),'array');

    parent::__construct();       
  }
 
function getMe()
  {

    $profile = JFactory::getUser($this->_user_id);
    $userDetails = JUserHelper::getProfile($this->_user_id);
    $profile->details =  isset($userDetails->profile) ? $userDetails->profile : array();

    $profile->isMine = JFactory::getUser()->id == $profile->id ? TRUE : FALSE;

    return $profile;
  }

  protected function _buildQuery()
  {
    $db = JFactory::getDBO();
    $query = $db->getQuery(TRUE);

    $query->select('u.id, u.name, u.username, u.email, u.registerDate, u.lastvisitDate');
    $query->from('#__users as u');

    $query->select('cd.address, cd.telephone, cd.suburb, cd.postcode, cd.id as contact_id, cd.misc');
    $query->select('up1.profile_value as cv');
    $query->select('up2.profile_value as userimg');
    $query->select('up3.profile_value as processcomplete');
    $query->leftjoin('#__user_profiles as up1 on ((up1.user_id = u.id) AND (up1.profile_key = "ddcpss.cv"))');
    $query->leftjoin('#__user_profiles as up2 on ((up2.user_id = u.id) AND (up2.profile_key = "ddcpss.userimg"))');
    $query->leftjoin('#__user_profiles as up3 on ((up1.user_id = u.id) AND (up3.profile_key = "ddcpss.processcomplete"))');
    $query->leftjoin('#__contact_details as cd on cd.user_id = u.id');
    $query->group("u.id");
    return $query;
  }

  protected function _buildWhere($query)
  {
   	$query->where('u.id = '. (int)$this->_user_id); 
        
    return $query;
  }

  /*
   * Function to get the user profile information from the user_profile table
   * @return boolean*/
  
  public function updateUserProfile()
  {
  	$up_data = array();
  	array_push($up_data, array('ddcuserprofile.firstname',$this->_data['firstname']));
  	array_push($up_data, array('ddcuserprofile.lastname',$this->_data['lastname']));
  	array_push($up_data, array('profile.address1',$this->_data['address1']));
  	array_push($up_data, array('profile.address2',$this->_data['address2']));
  	array_push($up_data, array('profile.city',$this->_data['city']));
  	array_push($up_data, array('profile.region',$this->_data['region']));
  	array_push($up_data, array('profile.country',$this->_data['country']));
  	array_push($up_data, array('profile.postal_code',$this->_data['postal_code']));
  	array_push($up_data, array('profile.phone',$this->_data['phone']));
  	
  	$db = JFactory::getDbo();
  	for($i=0;$i<count($up_data);$i++)
  	{
  		$query = $db->getQuery(true);
  		$fields = array($db->quoteName('profile_value') . ' = ' . $db->quote(json_encode($up_data[$i][1])));
  		// Conditions for which records should be updated.
  		$conditions = array(
  				$db->quoteName('user_id') . ' = '.$this->_user_id,
  				$db->quoteName('profile_key') . ' = ' . $db->quote($up_data[$i][0])
  		);
  		$query->update($db->quoteName('#__user_profiles'))->set($fields)->where($conditions);
  		$db->setQuery($query);
  		$result = $db->execute();
  	}
  	$db = JFactory::getDbo();
  	$query = $db->getQuery(true);
  	$fields = array($db->quoteName('name') . ' = ' . $db->quote($this->_data['firstname']." ".$this->_data['lastname']));
  	// Conditions for which records should be updated.
  	$conditions = array(
  			$db->quoteName('id') . ' = '.$this->_user_id
  	);
  	$query->update($db->quoteName('#__users'))->set($fields)->where($conditions);
  	$db->setQuery($query);
  	$result = $db->execute();
  	
  	return true;
  }

  public function updateprocessComplete()
  {
  	$db = JFactory::getDbo();
  	$query = $db->getQuery(true);
  	// Insert columns.
	$columns = array('user_id', 'profile_key', 'profile_value', 'ordering'); 
	// Insert values.
	$values = array($this->_user_id, $db->quote('ddcpss.processcomplete'), $db->quote('1'), 11);
	// Prepare the insert query.
	$query
    	->insert($db->quoteName('#__user_profiles'))
    	->columns($db->quoteName($columns))
    	->values(implode(',', $values));
  	$db->setQuery($query);
  	$result = $db->execute();
  	return true;
  }
  
  /*
   * Function to get the user profile information from the user_profile table
   * @return boolean*/
  
  public function getuserProfile()
  {
  	$db = JFactory::getDbo();
  	$db->setQuery(
						'SELECT profile_key, profile_value FROM #__user_profiles' .
						' WHERE user_id = ' . (int) $this->_user_id . " AND profile_key LIKE 'profile.%'" .
						' ORDER BY ordering'
				);
	$results = $db->loadRowList();

	// Merge the profile data.
	$profile = array();
	foreach ($results as $v)
	{
		$k = str_replace('profile.', '', $v[0]);
		$profile[$k] = json_decode($v[1], true);
		if ($profile[$k] === null)
		{
			$profile[$k] = $v[1];
		}
	}
	$db = JFactory::getDbo();
	$db->setQuery(
			'SELECT profile_key, profile_value FROM #__user_profiles' .
			' WHERE user_id = ' . (int) $this->_user_id . " AND profile_key LIKE 'ddcuserprofile.%'" .
			' ORDER BY ordering'
	);
	$results = $db->loadRowList();
	
	// Merge the profile data.
	foreach ($results as $v)
	{
		$k = str_replace('ddcuserprofile.', '', $v[0]);
		$profile[$k] = json_decode($v[1], true);
		if ($profile[$k] === null)
		{
			$profile[$k] = $v[1];
		}
	}
	return $profile;  	
  }
  
  
  /*
   * Function to save the user profile image to the contact_details table 
   * @param String $dest
   * @return boolean*/
  
  public function uploadPhoto($dest)
  {
  	$user = JFactory::getUser()->id;
  	if($user!=0)
  	{
  		$db = JFactory::getDbo();
  		$query = $db->getQuery(TRUE);
  		// delete all custom keys for user 1001.
  		$conditions = array(
  				$db->quoteName('user_id') . ' = '.(int)$user,
  				$db->quoteName('profile_key') . ' = ' . $db->quote('ddcpss.photo')
  		);
  		
  		$query->delete($db->quoteName('#__user_profiles'));
  		$query->where($conditions);
  		
  		$db->setQuery($query);
  		$db->execute();
  		
  		$db = JFactory::getDbo();
  		$query = $db->getQuery(TRUE);
  		// Insert columns.
  		$columns = array('user_id', 'profile_key', 'profile_value', 'ordering');
  		
  		// Insert values.
  		$values = array($user, $db->quote('ddcpss.photo'), $db->quote($dest), 10);
  		
  		// Prepare the insert query.
		$query
    		->insert($db->quoteName('#__user_profiles'))
    		->columns($db->quoteName($columns))
    		->values(implode(',', $values));
  		$db->setQuery($query);
  		$result = $db->execute();
		
		return true;
  	}
    return false;	
  }
  public function uploadCV($dest)
  {
  	$user = JFactory::getUser()->id;
  	if($user!=0)
  	{
  		$db = JFactory::getDbo();
  		$query = $db->getQuery(TRUE);
  		// delete all custom keys for user 1001.
  		$conditions = array(
  				$db->quoteName('user_id') . ' = '.(int)$user,
  				$db->quoteName('profile_key') . ' = ' . $db->quote('ddcpss.cv')
  		);
  		
  		$query->delete($db->quoteName('#__user_profiles'));
  		$query->where($conditions);
  		$db->setQuery($query);
  		$db->execute();
  		
  		$db = JFactory::getDbo();
  		$query = $db->getQuery(TRUE);
  		// Insert columns.
  		$columns = array('user_id', 'profile_key', 'profile_value', 'ordering');
  		
  		// Insert values.
  		$values = array($user, $db->quote('ddcpss.cv'), $db->quote($dest), 11);
  		
  		// Prepare the insert query.
		$query
    		->insert($db->quoteName('#__user_profiles'))
    		->columns($db->quoteName($columns))
    		->values(implode(',', $values));
  		$db->setQuery($query);
  		$result = $db->execute();
  
  		return true;
  	}
  	return false;
  }
  
  // Function for resizing jpg, gif, or png image files
  public function profile_img_resize($target, $newcopy, $w, $h, $ext) {
  	list($w_orig, $h_orig) = getimagesize($target);
  	$scale_ratio = $w_orig / $h_orig;
  	if (($w / $h) > $scale_ratio) {
  		$w = $h * $scale_ratio;
  	} else {
  		$h = $w / $scale_ratio;
  	}
  	$img = "";
  	$ext = strtolower($ext);
  	if ($ext == "gif"){
  		$img = imagecreatefromgif($target);
  	} else if($ext =="png"){
  		$img = imagecreatefrompng($target);
  	} else {
  		$img = imagecreatefromjpeg($target);
  	}
  	$tci = imagecreatetruecolor($w, $h);
  	// imagecopyresampled(dst_img, src_img, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h)
  	imagecopyresampled($tci, $img, 0, 0, 0, 0, $w, $h, $w_orig, $h_orig);
  	imagejpeg($tci, $newcopy, 80);
  }
  
  /*
   * Function to save the user "About Me" information to the contact_details table
   * @param String $abtme
   * @return boolean*/
  
  public function updateAboutMe($abtme)
  {
  	$user = JFactory::getUser()->id;
  	if($user!=0)
  	{
  		$db = JFactory::getDbo();
  		$query = $db->getQuery(TRUE);
  		// Fields to update.
  		$fields = array($db->quoteName('misc') . ' = ' . $db->quote($abtme));
  		// Conditions for which records should be updated.
  		$conditions = array($db->quoteName('user_id') . ' = '.$user);
  		$query->update($db->quoteName('#__contact_details'))->set($fields)->where($conditions);
  		$db->setQuery($query);
  		$result = $db->execute();
  
  		return array(true,$abtme);
  	}
  	return false;
  }

}