<?php // no direct access

defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class DdcpssModelsReferences extends DdcpssModelsDefault
{

  /**
  * Protected fields
  **/
  var $_reference_id	= null;
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
  	$this->_reference_id = $app->input->get('reference_id', null);
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

    $query->select('ref.ddc_reference_id');
    $query->select('ref.referee_name');
    $query->select('ref.organisation');
    $query->select('ref.address');
    $query->select('ref.position');
    $query->select('ref.contact_number');
    $query->select('ref.contact_email');
    $query->select('ref.relationship');
    $query->select('ref.timeframe');
    $query->select('ref.notes');
    $query->select('ref.contact_early');
    $query->select('ref.user_id');
    $query->from('#__ddc_references as ref');
    $query->select('u.id, u.name, u.username, u.email, u.registerDate');
    $query->leftjoin('#__users as u on ref.user_id = u.id');

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
  		$query->where('ref.state = "'.(int)$this->_published.'"');
  	}
  	if($this->_user_id!=null)
  	{
  		$query->where('ref.user_id = "'.(int)$this->_user_id.'"');
  	}
  	if($this->_reference_id!=null)
  	{
  		$query->where('ref.ddc_reference_id = "'.(int)$this->_reference_id.'"');
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
  		$pk = (!empty($pk)) ? $pk : (int)$this->_reference_id;
  		$db = JFactory::getDBO();
  
  		$db->setQuery(
  				'UPDATE #__ddc_references' .
  				' SET hits = hits + 1' .
  				' WHERE ddc_reference_id = '.(int) $pk
  		);
  
  		if (!$db->query()) {
  			$this->setError($db->getErrorMsg());
  			return false;
  		}
  	}
  
  	return true;
  }
  
   /**
  * Delete a reference record
  * @param int      ID of the reference to delete
  * @return boolean True if successfully deleted
  */
  public function delete($id = null)
  {
    $app  = JFactory::getApplication();
    $data = $app->input->get('jform', array(),'array');
    //$id   = $id ? $id : $app->input->get($data['ddc_reference_id']);
    $db = JFactory::getDBO();
    $db->setQuery(
  		'UPDATE #__ddc_references' .
  		' SET state = 0' .
  		' WHERE ddc_reference_id = '.(int) $id
  	);
  
  	if (!$db->query()) {
  		$this->setError($db->getErrorMsg());
  		return false;
  	}
  
  	return true;
  }
}