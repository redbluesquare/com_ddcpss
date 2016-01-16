<?php // no direct access

defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class DdcpssModelsUserexperience extends DdcpssModelsDefault
{

  /**
  * Protected fields
  **/
  var $_userexperience_id	= null;
  var $_cat_id		    	= null;
  var $_pagination  		= null;
  var $_published   		= 1;
  var $_formdata			= null;
  protected $messages;

  
  function __construct()
  {
  	$app = JFactory::getApplication();
  	//If no User ID is set to current logged in user
  	$this->_user_id = $app->input->get('profile_id', JFactory::getUser()->id);
  	$app = JFactory::getApplication();
  	$this->_cat_id = $app->input->get('id', null);
  	$this->_userexperience_id = $app->input->get('user_experience_id', null);
	$this->_formdata    = $app->input->get('jform', array(),'array');	
	
    parent::__construct();       
  }
    
	
  /**
  * Builds the query to be used by the product model
  * @return   object  Query object
  *
  *
  */
  protected function _buildQuery()
  {
 	
    $db = JFactory::getDBO();
    $query = $db->getQuery(TRUE);

    $query->select('uexp.ddc_user_experience_id');
    $query->select('uexp.company_name');
    $query->select('uexp.job_title');
    $query->select('uexp.location');
    $query->select('uexp.start_month');
    $query->select('uexp.start_year');
    $query->select('uexp.end_month');
    $query->select('uexp.end_year');
    $query->select('uexp.current_employer');
    $query->select('uexp.description');
    $query->select('uexp.user_id');
    $query->select('uexp.state');
    $query->from('#__ddc_user_experience as uexp');
    $query->select('u.id, u.name, u.username, u.email, u.registerDate');
    $query->leftjoin('#__users as u on uexp.user_id = u.id');
    $query->order('uexp.start_year ASC');
    $query->order('uexp.start_month ASC');

    return $query;
    
  }

  /**
  * Builds the filter for the query
  * @param    object  Query object
  * @return   object  Query object
  *
  */
  protected function _buildWhere(&$query)
  {

  	if($this->_userexperience_id!=null)
  	{
  		$query->where('uexp.ddc_user_experience_id = "'.(int)$this->_userexperience_id.'"');
  	}

   return $query;
  }
  
  
  //Add a hit when ever a user gets to the booking stage
  public function hit($pk = 0)
  {
  	$input = JFactory::getApplication()->input;
    $hitcount = $input->getInt('hitcount', 1);
  	if ($hitcount)
  	{
  		// Initialise variables.
  		$pk = (!empty($pk)) ? $pk : (int)$this->_user_experience_id;
  		$db = JFactory::getDBO();
  
  		$db->setQuery(
  				'UPDATE #__ddc_user_experience' .
  				' SET hits = hits + 1' .
  				' WHERE ddc_user_experience_id = '.(int) $pk
  		);
  
  		if (!$db->query()) {
  			$this->setError($db->getErrorMsg());
  			return false;
  		}
  	}
  
  	return true;
  }
  
   /**
  * Delete a UserExperience record
  * @param int      ID of the UserExperience to delete
  * @return boolean True if successfully deleted
  */
  public function delete($id = null)
  {
    $app  = JFactory::getApplication();
    $id   = $id ? $id : $app->input->get('ddc_user_experience_id');
    $userexp = JTable::getInstance('Userexperience','Table');
    $userexp->load($id);
    $userexp->state = 0;
  
    if($userexp->store())
    {
    	return true;
    }
    else 
    {
    	return false;
    }
  }
}