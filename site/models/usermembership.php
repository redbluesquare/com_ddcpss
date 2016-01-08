<?php // no direct access

defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class DdcpssModelsUsermembership extends DdcpssModelsDefault
{

  /**
  * Protected fields
  **/
  var $_usermembership_id	= null;
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
  	$this->_usermembership_id = $app->input->get('user_membership_id', null);
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

    $query->select('umem.ddc_user_membership_id');
    $query->select('umem.title');
    $query->select('umem.alias');
    $query->select('DATE_FORMAT(umem.expiry_date, "%d/%m/%Y") as ed');
    $query->select('umem.expiry_date');
    $query->select('umem.membership_number');
    $query->select('umem.user_id');
    $query->select('umem.state');
    $query->select('umem.created');
    $query->select('umem.modified');
    $query->from('#__ddc_user_membership as umem');
    $query->order('umem.expiry_date ASC');

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
  		$query->where('umem.state = "'.(int)$this->_published.'"');
  	}
  	if($this->_user_id!=null)
  	{
  		$query->where('umem.user_id = "'.(int)$this->_user_id.'"');
  	}
  	if($this->_usermembership_id!=null)
  	{
  		$query->where('umem.ddc_user_membership_id = "'.(int)$this->_usermembership_id.'"');
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
  		$pk = (!empty($pk)) ? $pk : (int)$this->_usermembership_id;
  		$db = JFactory::getDBO();
  
  		$db->setQuery(
  				'UPDATE #__ddc_user_membership' .
  				' SET hits = hits + 1' .
  				' WHERE ddc_user_membership_id = '.(int) $pk
  		);
  
  		if (!$db->query()) {
  			$this->setError($db->getErrorMsg());
  			return false;
  		}
  	}
  
  	return true;
  }
  
   /**
  * Delete a User Membership record
  * @param int      ID of the User Membership to delete
  * @return boolean True if successfully deleted
  */
  public function delete($id = null)
  {
    $app  = JFactory::getApplication();
    $this->data = $app->input->get('jform', array(),'array');
    $id   = $id ? $id : $this->data['ddc_user_membership_id'];
    $db = JFactory::getDBO();
     $db->setQuery(
  		'UPDATE #__ddc_user_membership' .
  		' SET state = 0' .
  		' WHERE ddc_user_membership_id = '.(int) $id
  	);
  	if ($result =$db->execute()) {
  		return $result;
  	}
  	else 
  	{
  		$this->setError($db->getErrorMsg());
  		return false;
  	}
  
  	
  }
}