<?php // no direct access

defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class DdcpssModelsUsercra extends DdcpssModelsDefault
{

  /**
  * Protected fields
  **/
  var $_usercra_id	= null;
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
  	$this->_usercra_id = $app->input->get('user_cra_id', null);
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

    $query->select('ucra.ddc_user_cra_id');
    $query->select('ucra.user_title');
    $query->select('ucra.gender');
    $query->select('ucra.current_forename');
    $query->select('ucra.current_surname');
    $query->select('ucra.previous_forename');
    $query->select('ucra.previous_surname');
    $query->select('ucra.national_insurance_number');
    $query->select('ucra.birth_town');
    $query->select('ucra.birth_county');
    $query->select('ucra.birth_country');
    $query->select('ucra.nationality');
    $query->select('ucra.dbs_certificate');
    $query->select('ucra.dbs_certificate_number');
    $query->select('ucra.dbs_renewal_service');
    $query->select('ucra.dbs_number');
    $query->select('ucra.created');
    $query->select('ucra.modified');
    $query->select('ucra.user_id');
    $query->from('#__ddc_user_cra as ucra');
    $query->select('u.id, u.name, u.username, u.email, u.registerDate');
    $query->leftjoin('#__users as u on ucra.user_id = u.id');

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
  		$query->where('ucra.state = "'.(int)$this->_published.'"');
  	}
  	if($this->_user_id!=null)
  	{
  		$query->where('ucra.user_id = "'.(int)$this->_user_id.'"');
  	}
  	if($this->_usercra_id!=null)
  	{
  		$query->where('ucra.ddc_user_cra_id = "'.(int)$this->_usercra_id.'"');
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
  		$pk = (!empty($pk)) ? $pk : (int)$this->_usercra_id;
  		$db = JFactory::getDBO();
  
  		$db->setQuery(
  				'UPDATE #__ddc_user_cra' .
  				' SET hits = hits + 1' .
  				' WHERE ddc_user_cra_id = '.(int) $pk
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
    $id   = $id ? $id : $app->input->get('ddc_user_cra_id');
    $useredu = JTable::getInstance('Usercra','Table');
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