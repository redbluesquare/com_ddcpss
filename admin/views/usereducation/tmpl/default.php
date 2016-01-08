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
				<th style="text-align:left;"><?php echo JText::_('COM_DDC_SCHOOL'); ?></th>
				<th style="text-align:left;"><?php echo JText::_('COM_DDC_TIME_PERIOD'); ?></th>
				<th style="text-align:left;"><?php echo JText::_('COM_DDC_DEGREE'); ?></th>
				<th style="text-align:left;"><?php echo JText::_('COM_DDC_FOS'); ?></th>
				<th style="text-align:left;"><?php echo JText::_('COM_DDC_GRADE'); ?></th>
				<th style="text-align:left;"><?php echo JText::_('COM_DDC_ACTIVITIES_AND_SOCIETIES'); ?></th>
				<th style="text-align:left;"><?php echo JText::_('COM_DDC_DESCRIPTION'); ?></th>
				<th style="text-align:left;"><?php echo JText::_('COM_DDC_USERNAME'); ?></th>
				<th style="text-align:left;"><?php echo JText::_('COM_DDC_STATE'); ?></th>
			</tr>
    	</thead>
        <tfoot>
			
        </tfoot>
        <tbody>
        <?php foreach($this->items as $i => $item): ?>
   			<tr>
   				<td style="text-align:center;">
   					<?php echo $item->ddc_user_education_id; ?>
   				</td>
           		<td style="text-align:left;">
           	        <?php echo $item->school; ?></a>
           		</td>
           		<td style="text-align:left;">
           			<?php echo $item->start_year." - ".$item->end_year; ?>
           		</td>
                		<td style="text-align:left;">
                			<?php echo $item->degree; ?>
                		</td>
                		<td style="text-align:left;">
                	        <?php echo $item->field_of_study; ?>
                		</td>
                		<td style="text-align:left;">
                	        <?php echo $item->grade; ?>
                		</td>
                		<td style="text-align:left;">
                			<?php echo $item->activities; ?>
                		</td>
                		<td style="text-align:left;">
                			<?php echo $item->education_description; ?>
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
                <input type="hidden" name="jform[table]" value="prices" />
                <input type="hidden" name="task" value="" />
                <input type="hidden" name="boxchecked" value="0" />
                <?php echo JHtml::_('form.token'); ?>
        </div>
</form>