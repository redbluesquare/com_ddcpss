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

<!-- Upload a file -->
<div class="modal fade" id="uploadFileModal" tabindex="-1" role="dialog" aria-labelledby="UploadFileModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content" style="padding:10px;">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
<h3><?php echo JText::_('COM_DDC_UPLOAD_FILE'); ?></h3>
      	<div class="modal-body">
			<form id="upload_file_form" enctype="multipart/form-data" method="post">
  				<input type="file" id="file_upload" name="file_upload" /><br>
  				<input type="text" placeholder="<?php echo JText::_('COM_DDC_ALIAS') ?>" id="jform_alias" name="jform[alias]" />
  				<input type="hidden" id="jform_table" name="jform[table]" value="user_images" /><br>
  				<progress id="progressFileBar" class="progress active" value="0" max="100" style="width:300px;"></progress>
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