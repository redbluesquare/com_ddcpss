<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
// load tooltip behavior
JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHTML::_('behavior.calendar');

?>

<form action="<?php echo JRoute::_('index.php?option=com_ddcpss&controller=get'); ?>" method="get" name="adminForm" id="adminForm">
	<table class="adminlist table" data-ng-app="">
    	<thead>

           	<tr>
           		<th><?php echo JText::_('COM_DDC_ID'); ?></th>
				<th style="text-align:left;"><?php echo JText::_('COM_DDC_CURRENT_NAME'); ?></th>
				<th style="text-align:left;"><?php echo JText::_('COM_DDC_PREVIOUS_NAME'); ?></th>
				<th style="text-align:left;"><?php echo JText::_('COM_DDC_BIRTH_DETAILS'); ?></th>
				<th style="text-align:left;"><?php echo JText::_('COM_DDC_NATIONALITY'); ?></th>
				<th style="text-align:left;"><?php echo JText::_('COM_DDC_NI_DETAILS'); ?></th>
				<th style="text-align:left;"><?php echo JText::_('COM_DDC_DBS_CERTIFICATE'); ?></th>
				<th style="text-align:left;"><?php echo JText::_('COM_DDC_DBS_CERTIFICATE_NUMBER'); ?></th>
				<th style="text-align:left;"><?php echo JText::_('COM_DDC_DBS_RENEWAL_SERVICE'); ?></th>
				<th style="text-align:left;"><?php echo JText::_('COM_DDC_DBS_SUBSCRIPTION_NUMBER'); ?></th>
				<th style="text-align:left;"><?php echo JText::_('COM_DDC_USERNAME'); ?></th>
			</tr>
    	</thead>
        <tfoot>
			
        </tfoot>
        <tbody>
        <?php foreach($this->items as $i => $item): ?>
   			<tr>
   				<td style="text-align:center;">
   					<?php echo $item->ddc_user_cra_id; ?>
   				</td>
           		<td style="text-align:left;">
           	        <?php echo $item->user_title.', '.$item->current_forename.', '.$item->current_surname; ?></a>
           		</td>
           		<td style="text-align:left;">
           			<?php echo $item->previous_forename.", ".$item->previous_surname; ?>
           		</td>
                		<td style="text-align:left;">
                			<?php echo $item->birth_town.", ".$item->birth_county.", ".$item->birth_country; ?>
                		</td>
                		<td style="text-align:left;">
                	        <?php echo $item->nationality; ?>
                		</td>
                		<td style="text-align:left;">
                	        <?php echo $item->national_insurance_number; ?>
                		</td>
                		<td style="text-align:center;">
                			<?php echo $item->dbs_certificate; ?>
                		</td>
                		<td style="text-align:center;">
                			<?php echo $item->dbs_certificate_number; ?>
                		</td>
                		<td style="text-align:center;">
                			<?php echo $item->dbs_renewal_service; ?>
                		</td>
                		<td style="text-align:center;">
                			<?php echo $item->dbs_number; ?>
                		</td>
                		<td style="text-align:left;">
                			<?php echo $item->username; ?>
                		</td>
        			</tr>
				<?php endforeach; ?>
                </tbody>
        </table>
        <div>
                <input type="hidden" name="jform[table]" value="prices" />
                <input type="hidden" name="task" value="" />
                <input type="hidden" name="boxchecked" value="0" />
                <?php echo JHtml::_('form.token'); ?>
        </div>
</form>