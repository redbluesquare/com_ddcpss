<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JLoader::register('JHtmlUsers', JPATH_COMPONENT . '/helpers/html/users.php');
JHtml::register('users.spacer', array('JHtmlUsers', 'spacer'));


$fieldsets = $this->fm->getFieldsets();
if (isset($fieldsets['core']))   unset($fieldsets['core']);
if (isset($fieldsets['params'])) unset($fieldsets['params']);

foreach ($fieldsets as $group => $fieldset): // Iterate through the form fieldsets
	$fields = $this->fm->getFieldset($group);
	if (count($fields)):
?>

<fieldset id="users-profile-custom" class="users-profile-custom-<?php echo $group; ?> showbtnup">
	<?php // If the fieldset has a label set, display it as the legend. ?>
	<?php if (isset($fieldset->label)): ?>
	
	<h3 style="color:grey;">
		<button class="btn pull-right btn-success" style="display:none;" data-toggle="modal" data-target="#userProfleModal" onclick="getUserProfile()"><i class="icon-pencil"></i></button>
		<?php echo JText::_($fieldset->label); ?>
	</h3>
	<hr/>
	<?php endif; ?>
	<dl class="dl-horizontal">
	<?php foreach ($fields as $field) :
		if (!$field->hidden && $field->type != 'Spacer') : ?>
		<dt><?php echo $field->title; ?></dt>
		<dd>
			<?php if (JHtml::isRegistered('users.' . $field->id)) : ?>
				<?php echo JHtml::_('users.' . $field->id, $field->value); ?>
			<?php elseif (JHtml::isRegistered('users.' . $field->fieldname)) : ?>
				<?php echo JHtml::_('users.' . $field->fieldname, $field->value); ?>
			<?php elseif (JHtml::isRegistered('users.' . $field->type)) : ?>
				<?php echo JHtml::_('users.' . $field->type, $field->value); ?>
			<?php else : ?>
				<?php echo JHtml::_('users.value', $field->value); ?>
			<?php endif; ?>
		</dd>
		<?php endif; ?>
	<?php endforeach; ?>
	</dl>
</fieldset>
	<?php endif; ?>
<?php endforeach; ?>
<script>
		jQuery(".showbtnup").hover(function(){
				jQuery(".showbtnup > h3 > .btn").css("display","block");
			},function(){
				jQuery(".showbtnup > h3 > .btn").css("display","none");
			})
	</script>
