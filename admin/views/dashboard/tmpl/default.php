<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 

$year = JHtml::date("","Y");
$year = (int)$year;
$progress = 0;
$education = false;
$experience = false;
$cra = false;
if(count($this->userexperiences)!=0){
	$experience = true;
	$progress +=33.33;
	
}
if(count($this->userschools)!=0){
	$education = true;
	$progress +=33.33;
}
if(isset($this->usercra)){
	$cra = true;
	$progress +=33.34;
}


?>
<div class="row-fluid">
	<a class="well span4" style="text-align: center" href="<?php echo JRoute::_('index.php?option=com_ddcpss&view=userexperience', false); ?>">
		<h3 style="text-align: center"><?php echo JText::_('COM_DDC_EXPERIENCE'); ?></h3>
		<p><?php echo JText::_('COM_DDC_NO_OF_RECORDS').": ".count($this->userexperiences); ?></p>
	</a>
	<a class="well span4" style="text-align: center" href="<?php echo JRoute::_('index.php?option=com_ddcpss&view=usereducation', false); ?>">
		<h3><?php echo JText::_('COM_DDC_EDUCATION'); ?></h3>
		<p><?php echo JText::_('COM_DDC_NO_OF_RECORDS').": ".count($this->userschools); ?></p>
	</a>
	<a class="well span4" style="text-align: center" href="<?php echo JRoute::_('index.php?option=com_ddcpss&view=usercra', false); ?>">
		<h3><?php echo JText::_('COM_DDC_CRA'); ?></h3>
		<p><?php echo JText::_('COM_DDC_NO_OF_RECORDS').": ".count($this->usercra); ?></p>
	</a>
</div>