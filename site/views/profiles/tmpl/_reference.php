<?php defined( '_JEXEC' ) or die( 'Restricted access' );

?>
<div class="row-fluid showbtns<?php echo $this->ref->ddc_reference_id; ?>">
	<button class="btn pull-right btn-success" style="display: none"  data-toggle="modal" data-target="#ReferenceModal" onclick="updateReference(<?php echo $this->ref->ddc_reference_id; ?>,'references')"><i class="icon-pencil"></i></button>
	<table>
		<tr><td><b><?php echo JText::_('COM_DDC_REFEREE_NAME'); ?></b></td><td><?php echo $this->ref->referee_name; ?></td></tr>
		<tr><td><b><?php echo JText::_('COM_DDC_ORGANISATION'); ?></b></td><td><?php echo $this->ref->organisation; ?></td></tr>
		<tr><td><b><?php echo JText::_('COM_DDC_POSITION'); ?></b></td><td><?php echo $this->ref->position; ?></td></tr>
		<tr><td><b><?php echo JText::_('COM_DDC_CONTACT_NUMBER'); ?></b></td><td><?php echo $this->ref->contact_number; ?></td></tr>
		<tr><td><b><?php echo JText::_('COM_DDC_CONTACT_EMAIL'); ?></b></td><td><?php echo $this->ref->contact_email; ?></td></tr>
		<tr><td><b><?php echo JText::_('COM_DDC_ADDRESS'); ?></b></td><td><?php echo $this->ref->address; ?></td></tr>
		<tr><td><b><?php echo JText::_('COM_DDC_RELATIONSHIP'); ?></b></td><td><?php echo $this->ref->relationship; ?></td></tr>
		<tr><td><b><?php echo JText::_('COM_DDC_TIMEFRAME'); ?></b></td><td><?php echo $this->ref->timeframe; ?></td></tr>
		<tr><td><b><?php echo JText::_('COM_DDC_NOTES'); ?></b></td><td><?php echo $this->ref->notes; ?></td></tr>
	</table>
</div>

<script>
jQuery(".showbtns<?php echo $this->ref->ddc_reference_id; ?>").hover(function(){
	jQuery(".showbtns<?php echo $this->ref->ddc_reference_id; ?> > .btn").css("display","block");
	
},function(){
	jQuery(".showbtns<?php echo $this->ref->ddc_reference_id; ?> > .btn").css("display","none");
});
</script>