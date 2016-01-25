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
				<th style="text-align:left;"><?php echo JText::_('COM_DDC_COMPANY_NAME'); ?></th>
				<th style="text-align:left;"><?php echo JText::_('COM_DDC_JOB_TITLE'); ?></th>
				<th style="text-align:left;"><?php echo JText::_('COM_DDC_LOCATION'); ?></th>
				<th style="text-align:left;"><?php echo JText::_('COM_DDC_TIME_PERIOD'); ?></th>
				<th style="text-align:left;"><?php echo JText::_('COM_PRESENT_EMPLOYER'); ?></th>
				<th style="text-align:left;"><?php echo JText::_('COM_DDC_DESCRIPTION'); ?></th>
				<th style="text-align:left;"><?php echo JText::_('COM_DDC_USERNAME'); ?></th>
				<th style="text-align:left;"><?php echo JText::_('COM_DDC_STATE'); ?></th>
			</tr>
    	</thead>
        <tfoot>
			
        </tfoot>
        <tbody>
        <?php foreach($this->items as $i => $item): ?>
        	<?php if($item->end_year!=0){$end_date = JHtml::date($item->end_year."-".$item->end_month."-01","M-Y");}else{$end_date=JText::_('COM_DDC_PRESENT');}?>
        	<?php if($item->start_year!=0){$start_date = JHtml::date($item->start_year."-".$item->start_month."-01","M-Y");}else{$start_date=null;}?>
   			<tr>
   				<td style="text-align:center;">
   					<?php echo $item->ddc_user_experience_id; ?>
   				</td>
           		<td style="text-align:left;">
           	        <?php echo $item->company_name; ?></a>
           		</td>
           		<td style="text-align:left;">
                     <?php echo $item->job_title; ?>
                </td>
                <td style="text-align:left;">
                     <?php echo $item->location; ?>
                </td>
           		<td style="text-align:left;">
           			<?php echo $start_date." ".JText::_('COM_DDC_TO')." ".$end_date; ?>
           		</td>
                <td style="text-align:left;">
                	<?php echo $item->current_employer; ?>
                </td>
                <td style="text-align:left;max-width:200px;">
                    <?php echo $item->description; ?>
                </td>
                <td style="text-align:left;">
                	<?php echo $item->username; ?>
               	</td>
               	<td style="text-align:left;">
                	<?php echo $item->state; ?>
               	</td>
        	</tr>
			<?php endforeach; ?>
            </tbody>
        </table>
        <div>

                <?php echo JHtml::_('form.token'); ?>
        </div>
</form>