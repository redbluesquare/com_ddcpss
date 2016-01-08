<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

?>

<fieldset id="users-profile-core">

		<h2><?php echo JText::_('COM_USERS_PROFILE_CORE_LEGEND'); ?></h2>

	<table class="">
		<tbody>
		<tr>
			<th style="text-align:left;">
				<?php echo JText::_('COM_USERS_PROFILE_NAME_LABEL'); ?>
			</th>
			<td>
				<?php echo $this->profile->name; ?>
			</td>
		</tr>
		<tr>
			<th style="text-align:left;">
				<?php echo JText::_('COM_USERS_PROFILE_USERNAME_LABEL'); ?>
			</th>
			<td>
				<?php echo htmlspecialchars($this->profile->username); ?>
			</td>
		</tr>
		<tr>
			<th style="text-align:left;">
				<?php echo JText::_('COM_USERS_PROFILE_REGISTERED_DATE_LABEL'); ?>
			</th>
			<td>
				<?php echo JHtml::_('date', $this->profile->registerDate); ?>
			</td>
		</tr>
		
		<tr>
			<th style="text-align:left;padding-right:5px;">
				<?php echo JText::_('COM_USERS_PROFILE_LAST_VISITED_DATE_LABEL'); ?>
			</th>
			<?php if ($this->profile->lastvisitDate != '0000-00-00 00:00:00'){?>
			<td>
				<?php echo JHtml::_('date', $this->profile->lastvisitDate); ?>
			</td>
			<?php }
			else
			{?>
			<td>
				<?php echo JText::_('COM_USERS_PROFILE_NEVER_VISITED'); ?>
			</td>
			<?php } ?>
		</tr>
		</tbody>
	</table>
</fieldset>
