<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

$start_date = JHtml::date("01-01-".$this->useredu->start_year,"Y");
$end_date = JHtml::date("01-01-".$this->useredu->end_year,"Y");

?>

<div class="row-fluid showedbtns<?php echo $this->useredu->ddc_user_education_id; ?>">
	<button class="btn pull-right btn-success" style="display: none" data-toggle="modal" data-target="#userEduModal" onclick="updateUserEducation(<?php echo $this->useredu->ddc_user_education_id; ?>,'usereducation')"><i class="icon-pencil"></i></button>
	<dl class="dl-horizontal">
		<dt><?php echo JText::_('COM_DDC_SCHOOL'); ?></dt><dd><?php echo $this->useredu->school; ?></dd>
		<dt><?php echo JText::_('COM_DDC_TIME_PERIOD'); ?></dt><dd><?php echo $start_date." ".JText::_('COM_DDC_TO')." ".$end_date; ?></dd>
		<dt><?php echo JText::_('COM_DDC_DEGREE'); ?></dt><dd><?php echo $this->useredu->degree; ?></dd>
		<dt><?php echo JText::_('COM_DDC_FOS'); ?></dt><dd><?php echo $this->useredu->field_of_study; ?></dd>
		<dt><?php echo JText::_('COM_DDC_GRADE'); ?></dt><dd><?php echo $this->useredu->grade; ?></dd>
		<dt><?php echo JText::_('COM_DDC_ACTIVITIES_AND_SOCIETIES'); ?></dt><dd><?php echo $this->useredu->activities; ?></dd>
		<dt><?php echo JText::_('COM_DDC_DESCRIPTION'); ?></dt><dd><?php echo $this->useredu->education_description; ?></dd>
	</dl>
</div>

<script>
jQuery(".showedbtns<?php echo $this->useredu->ddc_user_education_id; ?>").hover(function(){
	jQuery(".showedbtns<?php echo $this->useredu->ddc_user_education_id; ?> > .btn").css("display","block");
	
},function(){
	jQuery(".showedbtns<?php echo $this->useredu->ddc_user_education_id; ?> > .btn").css("display","none");
});
</script>
