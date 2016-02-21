<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_ddcpss
 *
 * @copyright   Copyright (C) 2005 - 2015 DiGi Dev Cloud, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<button id="doc_upload" class="btn btn-success pull-right" data-toggle="modal" data-target="#uploadFileModal"><i class="icon-file icon-white"></i><?php echo JText::_('COM_DDC_DOCUMENT_UPLOAD'); ?></button>
<br><br>
<div class="clearfix"></div>
<?php 
$total = count($this->images);
$image_item=0;
$row = 4;
$total_rows = ceil($total/$row);
for($i=0;$i<$total_rows;$i++):
?>

<div class="row-fluid">
<?php 
	for($j=0;$j<4;$j++): ?>
	<?php if($image_item<$total){
echo '<a class="span3 well" href="'.JRoute::_($this->images[$image_item]->filepath.$this->images[$image_item]->filename).'" target="_BLANK">';?>
<div class="span12" style="text-align: center;">
<?php 
$ext = explode(".", $this->images[$image_item]->filename);
$ext = $ext[1];
?>
<p style="text-decoration:none;color:#ccc;font-size:2em;font-weight:bold;"><?php echo $ext; ?></p>
<span><?php echo $this->images[$image_item]->alias; ?></span>
</div></a>
	<?php $image_item++;
	}?>
<?php endfor; ?>
</div>
<?php endfor; ?>



<!-- Upload a file -->
<div class="modal fade" id="uploadFileModal" tabindex="-1" role="dialog" aria-labelledby="UploadFileModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content" style="padding:10px;">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
<h3><?php echo JText::_('COM_DDC_UPLOAD_FILE'); ?></h3>
      	<div class="modal-body">
			<form id="upload_file_form" enctype="multipart/form-data" method="post">
  				<input type="file" id="file_upload" name="file_upload" /><br>
  				<input type="text" placeholder="<?php echo JText::_('COM_DDC_ALIAS_FILENAME') ?>" id="jform_alias" name="jform[alias]" />
  				<input type="hidden" id="jform_table" name="jform[table]" value="user_images" /><br>
  				<h3 id="file_status"></h3>
			</form>		
  		</div>
  		<div class="modal-footer">
  			<button class="btn" onclick=""  data-dismiss="modal" aria-hidden="true"><?php echo JText::_('COM_DDC_CANCEL'); ?></button>
			<button class="btn btn-primary" onclick="upload_file()"><?php echo JText::_('COM_DDC_SAVE'); ?></button>
  		</div>
	</div>
  </div>
</div>
