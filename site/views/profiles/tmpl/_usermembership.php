<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

?>

<div class="row-fluid showedbtns<?php echo $this->usermem->ddc_user_membership_id; ?>">
	<button class="btn pull-right btn-success" style="display: none" data-toggle="modal" data-target="#membershipModal" onclick="updateUserMembership(<?php echo $this->usermem->ddc_user_membership_id; ?>,'usermembership')"><i class="icon-pencil"></i></button>
	<dl class="dl-horizontal">
		<dt><?php echo JText::_('COM_DDC_UNION_NAME'); ?></dt><dd><?php echo $this->usermem->title; ?></dd>
		<dt><?php echo JText::_('COM_DDC_MEMBERSHIP_NUMBER'); ?></dt><dd><?php echo $this->usermem->membership_number ?></dd>
		<dt><?php echo JText::_('COM_DDC_EXPIRY_DATE'); ?></dt><dd><?php echo $this->usermem->ed; ?></dd>
	</dl>
</div>

<script>
jQuery(".showedbtns<?php echo $this->usermem->ddc_user_membership_id; ?>").hover(function(){
	jQuery(".showedbtns<?php echo $this->usermem->ddc_user_membership_id; ?> > .btn").css("display","block");
	
},function(){
	jQuery(".showedbtns<?php echo $this->usermem->ddc_user_membership_id; ?> > .btn").css("display","none");
});
</script>
