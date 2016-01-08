<?php defined( '_JEXEC' ) or die( 'Restricted access' );

$start_date = JHtml::date("01-".$this->userexp->start_month."-".$this->userexp->start_year,"M-Y");
if(($this->userexp->end_month != 0) Or ($this->userexp->end_year != 0)){
	$end_date = JHtml::date("01-".$this->userexp->end_month."-".$this->userexp->end_year,"M-Y");
}
else{
	$end_date = JText::_('COM_DDC_PRESENT');
}

?>
<div class="row-fluid showbtns<?php echo $this->userexp->ddc_user_experience_id; ?>">
	<button class="btn pull-right btn-success" style="display: none" data-toggle="modal" data-target="#userExpModal" onclick="updateUserExperience(<?php echo $this->userexp->ddc_user_experience_id; ?>,'userexperience')"><i class="icon-pencil"></i></button>
	<dl class="dl-horizontal">
		<dt><?php echo JText::_('COM_DDC_COMPANY_NAME'); ?></dt><dd><?php echo $this->userexp->company_name; ?></dd>
		<dt><?php echo JText::_('COM_DDC_JOB_TITLE'); ?></dt><dd><?php echo $this->userexp->job_title; ?></dd>
		<dt><?php echo JText::_('COM_DDC_LOCATION'); ?></dt><dd><?php echo $this->userexp->location; ?></dd>
		<dt><?php echo JText::_('COM_DDC_TIME_PERIOD'); ?></dt><dd><?php echo $start_date." ".JText::_('COM_DDC_TO')." ".$end_date; ?></dd>
		<dt><?php echo JText::_('COM_DDC_DESCRIPTION'); ?></dt><dd><?php echo $this->userexp->description; ?></dd>
	</dl>
</div>

<script>
jQuery(".showbtns<?php echo $this->userexp->ddc_user_experience_id; ?>").hover(function(){
	jQuery(".showbtns<?php echo $this->userexp->ddc_user_experience_id; ?> > .btn").css("display","block");
	
},function(){
	jQuery(".showbtns<?php echo $this->userexp->ddc_user_experience_id; ?> > .btn").css("display","none");
});
</script>