<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHTML::_('behavior.calendar');
?>
<?php 
$params = JComponentHelper::getParams('com_ddcpss');
$year = JHtml::date("","Y");
$year = (int)$year;
$progress = 0;
$education = false;
$experience = false;
$cra = false;

if(count($this->userexperiences)!=0){
	$experience = true;
	$progress +=33.33;

}
if(count($this->userschools)!=0){
	$education = true;
	$progress +=33.33;
}
if(isset($this->usercra)){
	$cra = true;
	$progress +=33.34;
}
$session = JFactory::getSession();
$check_progress=$session->get('check_progress',1);
if($session->get('check_progress',null)!=0)
{
	$check_progress = $session->set('check_progress', 2);
}
if($progress>=90)
{
	$check_progress = $session->set('check_progress', 1);
}
if($this->profile->userimg==null)
{
	$profileimg = JUri::root()."/media/ddcpss/images/pss_logo.jpeg";
}
else 
{
	$profileimg = JUri::root()."/media/ddcpss/images/".$this->profile->userimg;
}


?>
	<?php if(($check_progress==true) And ($progress<=90)){ ?>
	<div class="span12 <?php echo $params->get('pop_up_alert_class'); ?>" style="margin-top:5px;" onclick="disableAlert()">
	<a href="#" class="close" data-dismiss="alert">&times;</a>
	<?php echo $params->get('pop_up_alert'); ?>
	</div>
	<div class="clearfix"></div>
	<?php }
	if(($progress>=90) And ($this->profile->processcomplete==null)){ ?>
	<div class="span12 <?php echo $params->get('pop_up_alert_class'); ?>" style="margin-top:5px;" onclick="disablePostAlert()">
	<a href="#" class="close" data-dismiss="alert">&times;</a>
	<?php echo $params->get('post_pop_up_alert'); ?>
	</div>
	<div class="clearfix"></div>
	<?php } ?>
<div class="profile">
<?php if ($this->params->get('show_page_heading')) : ?>
<div class="">
	<h1>
		<?php echo $this->escape($this->params->get('page_heading')); ?>
	</h1>
</div>
<?php endif; ?>
<div class="row-fluid">
	<div class="span2">
		<div class="profile-image" style="height:160px;"  data-toggle="modal" data-target="#uploadPhotoModal">
		<img id="myprofilepic" alt="" src="<?php echo $profileimg; ?>" class="img-rounded img-polaroid profle_image" />
		<div class="caption-imgupload" id="img-upload"><span><?php echo JText::_('COM_DDC_CHANGE_IMAGE'); ?></span></div>
		</div>
		<button id="mycv" class="btn btn-success" data-toggle="modal" data-target="#uploadCVModal"><i class="icon-file icon-white"></i><?php echo JText::_('COM_DDC_UPDATE_CV'); ?></button>
	</div>
	<div class="span7">
		<?php 
		require_once JPATH_SITE.'/components/com_users/models/profile.php';
		require_once JPATH_SITE . '/components/com_ddcpss/views/profiles/tmpl/default_core.php'; ?>
	</div>
	<div class="span3">
		<h4><?php echo JText::_('COM_DDC_PROFILE_STATUS')?></h4>
		<div class="progress<?php if($progress<=90):?> progress-striped active<?php endif; ?>">
  			<div class="bar bar-success" style="width:<?php echo $progress; ?>%;"><?php if($progress > 90):
  					echo "<b>100% Complete</b>";
  				endif; ?>
  			</div>
  			
		</div>
		
	</div>
	<div class="clearfix"></div>
	<div class="span12 showbtns" style="margin-top:3px;">
		<button class="btn pull-right btn-success" style="display: none" onclick="getAboutme()" data-toggle="modal" data-target="#aboutmeModal"><i class="icon-pencil icon-black"></i></button>
		<h3 style="color: grey;"><?php echo JText::_('COM_DDC_ABOUT_ME_LABEL'); ?></h3>
		 <p id="aboutme"><?php echo $this->profile->misc; ?></p>
	</div>
	<script>
		jQuery(".showbtns").hover(function(){
			jQuery(".showbtns > .btn").css("display","block");
			
		},function(){
			jQuery(".showbtns > .btn").css("display","none");
		});
	</script>
</div>
<?php require_once JPATH_SITE . '/components/com_ddcpss/views/profiles/tmpl/default_params.php'; ?>

<?php require_once JPATH_SITE . '/components/com_ddcpss/views/profiles/tmpl/default_custom.php'; ?>

</div>

<div class="row-fluid">
	<div id="user_membership" class="span12">
		<button class="btn btn-success pull-right" data-toggle="modal" data-target="#membershipModal" onclick="addMembership()"><i class="icon-plus icon-white"></i></button>
		<h3 style="color:grey"><?php echo JText::_('COM_DDC_MEMBERSHIP_PROFESSIONAL_BODIES'); ?></h3>
			<?php
			if(count($this->usermemberships)!=0)
			{ 
				for($i=0, $n = count($this->usermemberships);$i<$n;$i++) { 
		        	$this->_umembershipListView->usermem = $this->usermemberships[$i];
		        	$this->_umembershipListView->type = 'usermembership';
		        	echo $this->_umembershipListView->render();
				} 
			}else{?>
							<div class="norecord_membership">
							<?php echo JText::_('COM_DDC_NO_RECORDS_FOUND'); ?>
							</div>
						<?php }
						?>

	</div>
</div>
<div class="row-fluid">
	<div id="user_experience" class="span12">
		<button class="btn btn-success pull-right" data-toggle="modal" data-target="#userExpModal" onclick="addUserExperience()"><i class="icon-plus icon-white"></i></button>
		<h3 style="color:grey"><?php echo JText::_('COM_DDC_EXPERIENCE'); ?></h3>
			<?php
			if(count($this->userexperiences)!=0)
			{ 
				for($i=0, $n = count($this->userexperiences);$i<$n;$i++) { 
		        	$this->_uexpListView->userexp = $this->userexperiences[$i];
		        	$this->_uexpListView->type = 'userexperience';
		        	echo $this->_uexpListView->render();
				} 
			}else{?>
							<div class="norecord_exp">
							<?php echo JText::_('COM_DDC_NO_RECORDS_FOUND'); ?>
							</div>
						<?php }
						?>

	</div>
</div>

<div class="row-fluid">
<div id="user_education">
	<button class="btn btn-success pull-right" data-toggle="modal" data-target="#userEduModal" onclick="addUserEducation()"><i class="icon-plus icon-white"></i></button>
	<h3 style="color:grey"><?php echo JText::_('COM_DDC_EDUCATION'); ?></h3>

		<?php 
			if(count($this->userschools)!=0){
				for($i=0, $n = count($this->userschools);$i<$n;$i++) { 
			        $this->_ueduListView->useredu = $this->userschools[$i];
			        $this->_ueduListView->type = 'userschool';
			        echo $this->_ueduListView->render();
				} 
			}else{?>
				<div class="norecord_edu">
				<?php echo JText::_('COM_DDC_NO_RECORDS_FOUND'); ?>
				</div>
			<?php }
		?>

	</div>
</div>

<div class="row-fluid">
	<div id="references" class="span12">
		<button class="btn btn-success pull-right" data-toggle="modal" data-target="#ReferenceModal" onclick="addReference()"><i class="icon-plus icon-white"></i></button>
		<h3 style="color:grey"><?php echo JText::_('COM_DDC_REFERENCES'); ?></h3>
			<?php 
			if(count($this->references)!=0)
			{
				for($i=0, $n = count($this->references);$i<$n;$i++) { 
		    	    $this->_refListView->ref = $this->references[$i];
		    	    $this->_refListView->type = 'reference';
		    	    echo $this->_refListView->render();
				}
			}else{?>
				<div class="norecord_ref">
				<?php echo JText::_('COM_DDC_NO_RECORDS_FOUND'); ?>
				</div>
			<?php }
			?>
	</div>
</div>

<?php if(!isset($this->usercra)): ?>
<div id="user_cra">

<h3 style="color:grey"><?php echo JText::_('COM_DDC_CRA'); ?></h3>
<form id="ucraForm">
	<div class="row-fluid">
		<div class="span4"><?php echo JText::_('COM_DDC_TITLE'); ?></div><div class="span8"><input type="text" name="jform[user_title]" id="jform_user_title" class="required" /></div>
	</div>
	<div class="row-fluid">
		<div class="span4"><?php echo JText::_('COM_DDC_GENDER'); ?></div><div class="span8"><select name="jform[gender]" id="gender">
																								<option value=""> - Select - </option>
																								<option value="M"><?php echo JText::_('COM_DDC_MALE'); ?></option>
																								<option value="F"><?php echo JText::_('COM_DDC_FEMALE'); ?></option>
																							</select></div>
	</div>
	<div class="row-fluid">
		<div class="span4"><?php echo JText::_('COM_DDC_CURRENT_FORENAME'); ?></div><div class="span8"><input type="text" name="jform[current_forename]" id="jform_current_forename" /></div>
	</div>
	<div class="row-fluid">
		<div class="span4"><?php echo JText::_('COM_DDC_CURRENT_SURNAME'); ?></div><div class="span8"><input type="text" name="jform[current_surname]" id="jform_current_surname" /></div>
	</div>
	<div class="row-fluid">
		<div class="span4"><?php echo JText::_('COM_DDC_PREVIOUS_FORENAME'); ?></div><div class="span8"><input type="text" name="jform[previous_forename]" id="jform_previous_forename" /></div>
	</div>
	<div class="row-fluid">
		<div class="span4"><?php echo JText::_('COM_DDC_PREVIOUS_SURNAME'); ?></div><div class="span8"><input type="text" name="jform[previous_surname]" id="jform_previous_surname" /></div>
	</div>
	<div class="row-fluid">
		<div class="span4"><?php echo JText::_('COM_DDC_NI_NUMBER'); ?></div><div class="span8"><input type="text" name="jform[national_insurance_number]" id="jform_national_insurance_number" /></div>
	</div>
	<div class="row-fluid">
		<div class="span4"><?php echo JText::_('COM_DDC_POB_TOWN'); ?></div><div class="span8"><input type="text" name="jform[birth_town]" id="jform_birth_town" /></div>
	</div>
	<div class="row-fluid">
		<div class="span4"><?php echo JText::_('COM_DDC_BIRTH_COUNTY'); ?></div><div class="span8"><input type="text" name="jform[birth_county]" id="jform_birth_county" /></div>
	</div>
	<div class="row-fluid">
		<div class="span4"><?php echo JText::_('COM_DDC_BIRTH_COUNTRY'); ?></div><div class="span8"><input type="text" name="jform[birth_country]" id="jform_birth_country" /></div>
	</div>
	<div class="row-fluid">
		<div class="span4"><?php echo JText::_('COM_DDC_NATIONALITY'); ?></div><div class="span8"><input type="text" name="jform[nationality]" id="jform_nationality" /></div>
	</div>
	<div class="row-fluid">
		<div class="span4"><?php echo JText::_('COM_DDC_DBS_SUBSCRIPTION'); ?></div>
		<div class="span8 controls"><select name="jform[dbs_renewal_service]" id="jform_dbs_renewal_service">
																								<option value="1"><?php echo JText::_('COM_DDC_YES'); ?></option>
																								<option value="0"><?php echo JText::_('COM_DDC_NO'); ?></option>
																							</select>
		</div>
	</div>
	<div class="row-fluid subnumber">
		<div class="span4"><?php echo JText::_('COM_DDC_DBS_SUBSCRIPTION_NUMBER'); ?></div><div class="span8"><input type="text" name="jform[dbs_number]" id="jform_dbs_number" /></div>
	</div>
	<div class="row-fluid dbs_cert">
		<div class="span4"><?php echo JText::_('COM_DDC_DBS_CERTIFICATE'); ?></div>
		<div class="span8"><select name="jform[dbs_certificate]" id="jform_dbs_certificate">
																								<option value="1"><?php echo JText::_('COM_DDC_YES'); ?></option>
																								<option value="0"><?php echo JText::_('COM_DDC_NO'); ?></option>
																							</select></div>
	</div>
	<div class="row-fluid dbs_cert_number">
		<div class="span4"><?php echo JText::_('COM_DDC_DBS_CERTIFICATE_NUMBER'); ?><br><i><span class="dbs_cert_validity" style="display: none;"><?php echo JText::_('COM_DDC_DBS_SUBSCRIPTION_NUMBER_VALIDITY'); ?></span></i></div><div class="span8"><input type="text" name="jform[dbs_certificate_number]" id="jform_dbs_certificate_number" /></div>
	</div>
	<div class="row-fluid dbs_cert_no_number" style="display: none;">
		<div class="span12"><?php echo $params->get('dbs_info'); ?></div>
	</div>
	<?php  ?>
	<input type="hidden" name="jform[table]" value="usercra"/>
</form>
<div class="row-fluid" style="padding-bottom:20px;">
	<button class="btn btn-success" onclick="saveUserCRA()"><?php echo JText::_('COM_DDC_SAVE'); ?></button>
</div>
<script>
jQuery(document).ready(function(){
	jQuery("#jform_dbs_renewal_service").on("change",function(){
		if(jQuery("#jform_dbs_renewal_service").val()=="1"){
			jQuery(".subnumber").show();
		}else{
			jQuery(".subnumber").hide();
			jQuery(".dbs_cert_validity").show();
			
		}
	});
	jQuery("#jform_dbs_certificate").on("change",function(){
		if(jQuery("#jform_dbs_certificate").val()=="1"){
			jQuery(".dbs_cert_number").show();
			jQuery(".dbs_cert_no_number").hide();
		}else{
			jQuery(".dbs_cert_number").hide();
			jQuery(".dbs_cert_no_number").show();
		}
	});
});
</script>
</div>

<?php endif; ?>
<div class="clearfix" style="padding-bottom:50px;"></div>

		<!-- Modal -->
<div class="modal fade" id="userEduModal" tabindex="-1" role="dialog" aria-labelledby="userEduModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="padding:10px;height:520px">
       		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
      	<h3><?php echo JText::_('COM_DDC_EDUCATION'); ?></h3>
      	<div class="modal-body" style="overflow-y:hidden  ">
			<div class="span10">
			<form id="ueduForm">
				<input class="span12" placeholder="<?php echo JText::_('COM_DDC_SCHOOL'); ?>" type="text" name="jform[school]" id="jform_school" />
				<div class="span12">
				<select style="width:75px" placeholder="<?php echo JText::_('COM_DDC_START_YEAR'); ?>" name="jform[start_year]" id="jform_start_year">
				<option value=""><?php echo "YYYY"; ?></option>
					<?php 
					for($i=-20;$i<=0;$i++){
						echo '<option value="'.($i+$year).'">'.($i+$year).'</option>';
					}
					?>
					
				</select>
				<?php echo " ".JText::_('COM_DDC_TO')." "; ?>
				<select style="width:75px" placeholder="<?php echo JText::_('COM_DDC_END_YEAR'); ?>" name="jform[end_year]" id="jform_end_year">
				<option value=""><?php echo "YYYY"; ?></option>
					<?php 
					for($i=-20;$i<=0;$i++){
						echo '<option value="'.($i+$year).'">'.($i+$year).'</option>';
					}
					?>
					
				</select>	
				</div>
				<input class="span12" placeholder="<?php echo JText::_('COM_DDC_DEGREE'); ?>" type="text" name="jform[degree]" id="jform_degree" />
				<input class="span12" placeholder="<?php echo JText::_('COM_DDC_FOS'); ?>" type="text" name="jform[field_of_study]" id="jform_field_of_study" />
				<input class="span12" placeholder="<?php echo JText::_('COM_DDC_GRADE'); ?>" type="text" name="jform[grade]" id="jform_grade" />
				<textarea rows="5" class="span12" name="jform[education_description]" id="jform_education_description" placeholder="<?php echo JText::_('COM_DDC_EDUCATION_DESCRIPTION'); ?>"></textarea>
				<input type="hidden" name="jform[table]" value="usereducation" />
				<input type="hidden" name="jform[ddc_user_education_id]" id="jform_ddc_user_education_id" value="" />
			</form>
  			</div>
  		</div>
  		<div class="modal-footer">
  			<button class="btn btn-primary pull-right" onclick="saveUserEdu()"><?php echo JText::_('COM_DDC_SAVE'); ?></button>
			<button class="btn pull-right" onclick=""  data-dismiss="modal" aria-hidden="true"><?php echo JText::_('COM_DDC_CANCEL'); ?></button>
			<button class="btn btn-danger pull-right deletebtn" onclick="delUserEducation()" ><?php echo JText::_('COM_DDC_DELETE'); ?></button>
  		</div>
	</div>
  </div>
</div>


		<!-- Modal -->
<div class="modal fade" id="userExpModal" tabindex="-1" role="dialog" aria-labelledby="userExpModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="padding:10px;">
       		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
      	<h3><?php echo JText::_('COM_DDC_USER_EXPERIENCE'); ?></h3>
      	<div class="modal-body">
			<form id="uexpForm">
				<input class="span12" placeholder="<?php echo JText::_('COM_DDC_COMPANY_NAME'); ?>" type="text" name="jform[company_name]" id="jform_company_name" />
				<input class="span12" placeholder="<?php echo JText::_('COM_DDC_JOB_TITLE'); ?>" type="text" name="jform[job_title]" id="jform_job_title" />
				<input class="span12" placeholder="<?php echo JText::_('COM_DDC_LOCATION'); ?>" type="text" name="jform[location]" id="jform_location" />
				<div class="span12">
				<select style="width:60px" placeholder="<?php echo JText::_('COM_DDC_START_MONTH'); ?>" name="jform[start_month]" id="jform_start_month">
				<option value=""><?php echo "MM"; ?></option>
					<?php 
					for($i=0;$i<12;$i++){
						echo '<option value="'.($i+1).'">'.($i+1).'</option>';
					}
					?>
					
				</select>
				 - <select style="width:75px" placeholder="<?php echo JText::_('COM_DDC_START_YEAR'); ?>" name="jform[start_year]" id="jform_start_year">
				<option value=""><?php echo "YYYY"; ?></option>
					<?php 
					for($i=-20;$i<=0;$i++){
						echo '<option value="'.($i+$year).'">'.($i+$year).'</option>';
					}
					?>
					
				</select>
				<?php echo " ".JText::_('COM_DDC_TO')." "; ?>
				<select style="width:60px" placeholder="<?php echo JText::_('COM_DDC_END_MONTH'); ?>" name="jform[end_month]" id="jform_end_month">
				<option value=""><?php echo "MM"; ?></option>
					<?php 
					for($i=0;$i<12;$i++){
						echo '<option value="'.($i+1).'">'.($i+1).'</option>';
					}
					?>
					
				</select>
				 - <select style="width:75px" placeholder="<?php echo JText::_('COM_DDC_END_YEAR'); ?>" name="jform[end_year]" id="jform_end_year">
				<option value=""><?php echo "YYYY"; ?></option>
					<?php 
					for($i=-20;$i<=0;$i++){
						echo '<option value="'.($i+$year).'">'.($i+$year).'</option>';
					}
					?>
					
				</select>
				<span class="pull-right" style="margin-left:5px;">
					<input type="checkbox" value="1" default="0" name="jform[current_employer]" style="margin-right:5px;">
					<label for="jform_current_employer" style="font-size:0.5em;line-height:10px;width:100px;"><?php echo JText::_('COM_PRESENT_EMPLOYER')?></label>
				</span>
				</div>
				<textarea rows="5" class="span12" name="jform[description]" id="jform_description" placeholder="<?php echo JText::_('COM_DDC_EXPERIENCE_DESCRIPTION'); ?>"></textarea>
				<input class="span12" type="hidden" name="jform[table]" value="userexperience" />
				<input class="span12" type="hidden" name="jform[ddc_user_experience_id]" id="jform_ddc_user_experience_id" value="" />
			</form>
  		</div>
  		<div class="modal-footer">
  			<button class="btn btn-primary pull-right" onclick="saveUserExp()"><?php echo JText::_('COM_DDC_SAVE'); ?></button>
			<button class="btn pull-right" onclick=""  data-dismiss="modal" aria-hidden="true"><?php echo JText::_('COM_DDC_CANCEL'); ?></button>
			<button class="btn btn-danger pull-right deletebtn" onclick="delUserExperience()" ><?php echo JText::_('COM_DDC_DELETE'); ?></button>
  		</div>
	</div>
  </div>
</div>

		<!-- Modal -->
<div class="modal fade" id="ReferenceModal" tabindex="-1" role="dialog" aria-labelledby="ReferenceModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="padding:10px;">
       		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
      	<h3><?php echo JText::_('COM_DDC_ADD_REFERENCE'); ?></h3>
      	<div class="modal-body" style="overflow-y:scroll;">
      		<div class="span12">
		<?php echo $params->get('reference_information'); ?>
		</div>
		<div class="clearfix"></div>
			<form id="referenceForm">
				<fieldset class="adminform">
					<?php foreach($this->form->getFieldset('reference') as $field): ?>
						<?php if ($field->hidden):// If the field is hidden, just display the input.?>
							<span style="display:none"><?php echo $field->input;?></span>
						<?php else:?>
						<div class="control-group">
							<div class="control-label span5">
							<?php echo $field->label; ?>
							</div>
							<div class="controls span7">
								<?php echo $field->input;?>
							</div>
						</div>
						<?php endif;?>
					<?php endforeach; ?>
					<div class="clearfix"></div>
        		</fieldset>
			</form>
  		</div>
  		<div class="modal-footer">
  			<button class="btn btn-primary pull-right" onclick="saveReference()"><?php echo JText::_('COM_DDC_SAVE'); ?></button>
			<button class="btn pull-right" onclick=""  data-dismiss="modal" aria-hidden="true"><?php echo JText::_('COM_DDC_CANCEL'); ?></button>
			<button class="btn btn-danger pull-right deletebtn" onclick="delReference()" ><?php echo JText::_('COM_DDC_DELETE'); ?></button>
  		</div>
	</div>
  </div>
</div>

<!-- Update Photo -->
<div class="modal fade" style="max-width:400px;" id="uploadPhotoModal" tabindex="-1" role="dialog" aria-labelledby="UploadPhotoModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="padding:10px;">
       		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
      	<h3><?php echo JText::_('COM_DDC_UPDATE_PHOTO'); ?></h3>
      	<div class="modal-body">
			<form id="upload_form" enctype="multipart/form-data" method="post">
  				<input type="file" id="upload_photo" name="upload_photo" accept="image/*" />				
  				<input type="hidden" id="jform_table" name="jform[table]" value="uploadphoto" />
  				<progress id="progressBar" class="progress active" value="0" max="100" style="width:300px;"></progress>
				<h3 id="status"></h3>
			</form>
  		</div>
  		<div class="modal-footer">
  			<button class="btn" onclick=""  data-dismiss="modal" aria-hidden="true"><?php echo JText::_('COM_DDC_CANCEL'); ?></button>
			<button class="btn btn-primary" onclick="uploadPhoto()"><?php echo JText::_('COM_DDC_SAVE'); ?></button>
  		</div>
	</div>
  </div>
</div>

<!-- Update CV -->
<div class="modal fade" style="max-width:400px;" id="uploadCVModal" tabindex="-1" role="dialog" aria-labelledby="UploadCVModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="padding:10px;">
       		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
      	<h3><?php echo JText::_('COM_DDC_UPLOAD_CV'); ?></h3>
      	<div class="modal-body">
			<form id="upload_cv_form" enctype="multipart/form-data" method="post">
  				<input type="file" id="upload_cv" name="upload_cv" />				
  				<input type="hidden" id="jform_table" name="jform[table]" value="uploadcv" />
  				<progress id="progresscvBar" class="progress active" value="0" max="100" style="width:300px;"></progress>
				<h3 id="statuscv"></h3>
			</form>
				
  		</div>
  		<div class="modal-footer">
  			<button class="btn" onclick=""  data-dismiss="modal" aria-hidden="true"><?php echo JText::_('COM_DDC_CANCEL'); ?></button>
			<button class="btn btn-primary" onclick="uploadCV()"><?php echo JText::_('COM_DDC_SAVE'); ?></button>
  		</div>
	</div>
  </div>
</div>

<!-- Update About Me -->
<div class="modal fade" style="max-width:600px;" id="aboutmeModal" tabindex="-1" role="dialog" aria-labelledby="UploadPhotoModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="padding:10px;">
       		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
      	<h3><?php echo JText::_('COM_DDC_ABOUT_ME'); ?></h3>
      	<div class="modal-body">
			<form id="aboutmeForm">
  				<?php foreach($this->form->getFieldset('aboutme') as $field): ?>
						<?php if ($field->hidden):// If the field is hidden, just display the input.?>
							<span style="display:none"><?php echo $field->input;?></span>
						<?php else:?>
						<div class="control-group">
							<div class="controls">
								<?php echo $field->input;?>
							</div>
							<div id="textarea_feedback" class="pull-right clearfix"></div>
						</div>
						<?php endif;?>
					<?php endforeach; ?>
					
			</form>
				
  		</div>
  		<div class="modal-footer">
  			<button class="btn" onclick=""  data-dismiss="modal" aria-hidden="true"><?php echo JText::_('COM_DDC_CANCEL'); ?></button>
			<button class="btn btn-primary" onclick="updateAboutMe()"><?php echo JText::_('COM_DDC_SAVE'); ?></button>
  		</div>
  		<script>
  		jQuery(document).ready(function() {
  			var text_length = jQuery('#jform_aboutme').val().length;
  			var text_max = 7000;
  			var text_remaining = text_max - text_length;
  			jQuery('#textarea_feedback').html(text_remaining + ' characters remaining');
  			jQuery('#jform_aboutme').keyup(function() {
  				text_length = jQuery('#jform_aboutme').val().length;  		        
  		        text_remaining = text_max - text_length;

  		        jQuery('#textarea_feedback').html(text_remaining + ' characters remaining');
  		    });
  		});
  		</script>
	</div>
  </div>
</div>


		<!-- Modal for Membership to Professional Bodies -->
<div class="modal fade" style="max-width:400px" id="membershipModal" tabindex="-1" role="dialog" aria-labelledby="membershipModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="padding:10px;">
       		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
      	<h3><?php echo JText::_('COM_DDC_PROFESSIONAL_UNION_MEMBERSHIP'); ?></h3>
      	<div class="modal-body" style="overflow-y:hidden  ">
			<div class="span10">
			<form id="membershipForm">
				<input class="span12" placeholder="<?php echo JText::_('COM_DDC_UNION_NAME'); ?>" type="text" name="jform[title]" id="jform_title" />
				<input class="span12" placeholder="<?php echo JText::_('COM_DDC_MEMBERSHIP_NUMBER'); ?>" type="text" name="jform[membership_number]" id="jform_membership_number" />
				<input class="span12" placeholder="<?php echo JText::_('COM_DDC_EXPIRY_DATE_LABEL'); ?>" type="text" name="jform[expiry_date]" id="jform_expiry_date" />
				<input type="hidden" name="jform[table]" value="usermembership" />
				<input placeholder="<?php echo JText::_('COM_DDC_UNION_NAME'); ?>" type="hidden" name="jform[alias]" id="jform_alias" />
				<input type="hidden" name="jform[ddc_user_membership_id]" id="jform_ddc_user_membership_id" value="" />
			</form>
				<button class="btn btn-primary pull-right" onclick="saveUserMembership()"><?php echo JText::_('COM_DDC_SAVE'); ?></button>
				<button class="btn pull-right" onclick=""  data-dismiss="modal" aria-hidden="true"><?php echo JText::_('COM_DDC_CANCEL'); ?></button>
				<button class="btn btn-danger pull-right deletebtn" onclick="delUserMembership()" ><?php echo JText::_('COM_DDC_DELETE'); ?></button>
  			</div>
  		</div>
	</div>
  </div>
</div>

		<!-- Modal for User Profile -->
<div class="modal fade" id="userProfleModal" tabindex="-1" role="dialog" aria-labelledby="membershipModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="padding:10px;">
       		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
      	<h3><?php echo JText::_('COM_DDC_UPDATE_PERSONAL_DETAILS'); ?></h3>
      	<div class="modal-body" style="overflow-y:scroll;">
			<div class="span10">
			<form id="userProfileForm" class="form-validate form-horizontal">
				<div class="control-group span6">
					<label id="jform_lastname-lbl" for="jform_firstname"><?php echo JText::_('COM_DDC_FIRST_NAME'); ?></label>
					<input type="text" name="jform[firstname]" id="jform_firstname" class="required" value="" />
				</div>
				<div class="control-group span6">
					<label id="jform_lastname-lbl" for="jform_lastname"><?php echo JText::_('COM_DDC_LAST_NAME'); ?></label>
					<input type="text" name="jform[lastname]" id="jform_lastname" class="required" value="" />
				</div>
				<div class="control-group">
					<div class="control-label">
						<label id="jform_address1-lbl" for="jform_address1"><?php echo JText::_('COM_DDC_ADDRESS1'); ?></label>
					</div>
					<div class="controls">
						<input type="text" name="jform[address1]" id="jform_address1" class="required" value="" />
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<label id="jform_address2-lbl" for="jform_address2"><?php echo JText::_('COM_DDC_ADDRESS2'); ?></label>
					</div>
					<div class="controls">
						<input type="text" name="jform[address2]" id="jform_address2" value="" />
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<label id="jform_city-lbl" for="jform_city"><?php echo JText::_('COM_DDC_CITY'); ?></label>
					</div>
					<div class="controls">
						<input type="text" name="jform[city]" id="jform_city" class="required" value="" />
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<label id="jform_region-lbl" for="jform_region"><?php echo JText::_('COM_DDC_REGION'); ?></label>
					</div>
					<div class="controls">
						<input type="text" name="jform[region]" id="jform_region" class="required" value="" />
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<label id="jform_country-lbl" for="jform_country"><?php echo JText::_('COM_DDC_COUNTRY'); ?></label>
					</div>
					<div class="controls">
						<input type="text" name="jform[country]" id="jform_country" class="required" value="" />
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<label id="jform_postal_code-lbl" for="jform_postal_code"><?php echo JText::_('COM_DDC_POSTAL_CODE'); ?></label>
					</div>
					<div class="controls">
						<input type="text" name="jform[postal_code]" id="jform_postal_code" class="required" value="" />
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<label id="jform_phone-lbl" for="jform_phone"><?php echo JText::_('COM_DDC_PHONE'); ?></label>
					</div>
					<div class="controls">
						<input type="text" name="jform[phone]" id="jform_phone" class="required" value="" />
					</div>
				</div>
				<input type="hidden" name="jform[table]" value="userprofiledetails" />
			</form>
				<button class="btn btn-primary pull-right" onclick="saveUserProfile()"><?php echo JText::_('COM_DDC_SAVE'); ?></button>
				<button class="btn pull-right" onclick=""  data-dismiss="modal" aria-hidden="true"><?php echo JText::_('COM_DDC_CANCEL'); ?></button>
  			</div>
  		</div>
	</div>
  </div>
</div>
