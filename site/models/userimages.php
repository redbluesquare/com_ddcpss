<?php // no direct access

defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class DdcpssModelsUserimages extends DdcpssModelsDefault
{

  /**
  * Protected fields
  **/
  var $_userimage_id	= null;
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
  	$this->_userimage_id = $app->input->get('user_image_id', null);
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

    $query->select('ui.ddc_user_image_id');
    $query->select('ui.linked_table');
    $query->select('ui.linked_table_id');
    $query->select('ui.catid');
    $query->select('ui.filepath');
    $query->select('ui.filename');
    $query->select('ui.alias');
    $query->select('ui.user_id');
    $query->select('ui.state');
    $query->select('ui.created');
    $query->select('ui.modified');
    $query->from('#__ddc_user_images as ui');
    $query->order('ui.ddc_user_image_id ASC');

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
  		$query->where('ui.state = "'.(int)$this->_published.'"');
  	}
  	if($this->_user_id!=null)
  	{
  		$query->where('ui.user_id = "'.(int)$this->_user_id.'"');
  	}
  	if($this->_userimage_id!=null)
  	{
  		$query->where('ui.ddc_user_image_id = "'.(int)$this->_userimage_id.'"');
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
  		$pk = (!empty($pk)) ? $pk : (int)$this->_userimage_id;
  		$db = JFactory::getDBO();
  
  		$db->setQuery(
  				'UPDATE #__ddc_user_images' .
  				' SET hits = hits + 1' .
  				' WHERE ddc_user_images_id = '.(int) $pk
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
    $this->data = $app->input->get('jform', array(),'array');
    $id   = $id ? $id : $this->data['ddc_user_image_id'];
    $db = JFactory::getDBO();
    $db->setQuery(
  		'UPDATE #__ddc_user_images' .
  		' SET state = 0' .
  		' WHERE ddc_user_image_id = '.(int) $id
  	);
  
  	if (!$db->query()) {
  		$this->setError($db->getErrorMsg());
  		return false;
  	}
  
  	return true;
  }
}