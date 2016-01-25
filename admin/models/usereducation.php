<?php // no direct access

defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class DdcpssModelsUsereducation extends DdcpssModelsDefault
{

  /**
  * Protected fields
  **/
  var $_usereducation_id	= null;
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
  	$this->_usereducation_id = $app->input->get('user_education_id', null);
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

    $query->select('uedu.ddc_user_education_id');
    $query->select('uedu.school');
    $query->select('uedu.degree');
    $query->select('uedu.field_of_study');
    $query->select('uedu.grade');
    $query->select('uedu.start_year');
    $query->select('uedu.end_year');
    $query->select('uedu.activities');
    $query->select('uedu.education_description');
    $query->select('uedu.user_id');
    $query->select('uedu.state');
    $query->select('uedu.created');
    $query->select('uedu.modified');
    $query->from('#__ddc_user_education as uedu');
    $query->select('u.id, u.name, u.username, u.email, u.registerDate');
    $query->leftjoin('#__users as u on uedu.user_id = u.id');
    $query->order('uedu.start_year ASC');

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

  	if($this->_published!=null)
  	{
  		//$query->where('uedu.state = "'.(int)$this->_published.'"');
  	}
  	if($this->_user_id!=null)
  	{
  		$query->where('uedu.user_id = "'.(int)$this->_user_id.'"');
  	}
  	if($this->_usereducation_id!=null)
  	{
  		$query->where('uedu.ddc_user_education_id = "'.(int)$this->_usereducation_id.'"');
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
  		$pk = (!empty($pk)) ? $pk : (int)$this->_usereducation_id;
  		$db = JFactory::getDBO();
  
  		$db->setQuery(
  				'UPDATE #__ddc_user_education' .
  				' SET hits = hits + 1' .
  				' WHERE ddc_user_education_id = '.(int) $pk
  		);
  
  		if (!$db->query()) {
  			$this->setError($db->getErrorMsg());
  			return false;
  		}
  	}
  
  	return true;
  }
  
   /**
  * Delete a UserEducation record
  * @param int      ID of the UserExperience to delete
  * @return boolean True if successfully deleted
  */
  public function delete($id = null)
  {
    $app  = JFactory::getApplication();
    $id   = $id ? $id : $app->input->get('ddc_user_education_id');
    $useredu = JTable::getInstance('Usereducation','Table');
    $useredu->load($id);
    $useredu->state = 0;
  
    if($useredu->store())
    {
    	return true;
    }
    else 
    {
    	return false;
    }
  }
}