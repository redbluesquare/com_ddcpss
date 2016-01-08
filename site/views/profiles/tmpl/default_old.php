<?php 

defined( '_JEXEC' ) or die( 'Restricted access' ); 
JHTML::_('behavior.tooltip');

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


?>
<div class="row-fluid">
	<div class="span8">
		<dl class="dl-horizontal">
			<dt><?php echo JText::_('COM_DDC_NAME'); ?></dt><dd><?php echo $this->profile->name; ?></dd>
			<dt><?php echo JText::_('COM_DDC_USERNAME'); ?></dt><dd><?php echo $this->profile->username; ?></dd>
			<dt><?php echo JText::_('COM_DDC_EMAIL'); ?></dt><dd><?php echo $this->profile->email; ?></dd>
		</dl>
	</div>
	<div class="span4">
		<h4><?php echo JText::_('COM_DDC_PROFILE_STATUS')?></h4>
		<div class="progress<?php if($progress<=90):?> progress-striped active<?php endif; ?>">
  			<div class="bar bar-success" style="width:<?php echo $progress; ?>%;"><?php if($progress > 90):
  					echo "<b>100% Complete</b>";
  				endif; ?>
  			</div>
  			
		</div>
		<?php 
		if(count($this->userexperiences)==0){
		?>
		<button class="btn" data-toggle="modal" data-target="#userExpModal" onclick="addUserExperience()"><i class="icon-plus"></i><?php echo JText::_('COM_DDC_EXPERIENCE'); ?></button>
		<?php 
		}elseif(count($this->userschools)==0){
		?>
		<button class="btn" data-toggle="modal" data-target="#userEduModal" onclick="addUserEducation()"><i class="icon-plus"></i><?php echo JText::_('COM_DDC_EDUCATION'); ?></button>
		<?php 
		}elseif(!isset($this->usercra)){
		?>
		<a class="btn" href="#user_cra" style="font-size:10px;" ><i class="icon-plus"></i><?php echo JText::_('COM_DDC_CRA'); ?></a>
		<?php 
		}
		?>
	</div>
</div>
<hr>
<div class="row-fluid">
	<div id="user_experience" class="span12">
		<button class="btn pull-right" data-toggle="modal" data-target="#userExpModal" onclick="addUserExperience()"><i class="icon-plus"></i></button>
		<h3 style="color:gray"><?php echo JText::_('COM_DDC_EXPERIENCE'); ?></h3>
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
							<?php echo JText::_('COM_NO_RECORDS_FOUND'); ?>
							</div>
						<?php }
						?>

	</div>
</div>

<div class="row-fluid">
<div id="user_education">
	<button class="btn pull-right" data-toggle="modal" data-target="#userEduModal" onclick="addUserEducation()"><i class="icon-plus"></i></button>
	<h3 style="color:gray"><?php echo JText::_('COM_DDC_EDUCATION'); ?></h3>

		<?php 
			if(count($this->userschools)!=0){
				for($i=0, $n = count($this->userschools);$i<$n;$i++) { 
			        $this->_ueduListView->useredu = $this->userschools[$i];
			        $this->_ueduListView->type = 'userschool';
			        echo $this->_ueduListView->render();
				} 
			}else{?>
				<div class="norecord_edu">
				<?php echo JText::_('COM_NO_RECORDS_FOUND'); ?>
				</div>
			<?php }
		?>

	</div>
</div>

<div class="row-fluid">
	<div id="references" class="span12">
		<button class="btn pull-right" data-toggle="modal" data-target="#ReferenceModal" onclick="addReference()"><i class="icon-plus"></i></button>
		<h3 style="color:gray"><?php echo JText::_('COM_DDC_REFERENCES'); ?></h3>
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
				<?php echo JText::_('COM_NO_RECORDS_FOUND'); ?>
				</div>
			<?php }
			?>
	</div>
</div>

<?php if(!isset($this->usercra)): ?>
<div id="user_cra">

<h3 style="color:gray"><?php echo JText::_('COM_DDC_CRA'); ?></h3>
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
	<input type="hidden" name="table" value="usercra"/>
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
<div class="clearfix"></div>

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
				<input class="span12" placeholder="<?php echo JText::_('COM_DDC_ACTIVITIES_AND_SOCIETIES'); ?>" type="text" name="jform[activities]" id="jform_activities" />
				
				<textarea rows="5" class="span12" name="jform[education_description]" id="jform_education_description"><?php echo JText::_('COM_DDC_DESCRIPTION'); ?></textarea>
				<input type="hidden" name="jform[table]" value="usereducation" />
				<input type="hidden" name="jform[ddc_user_education_id]" id="jform_ddc_user_education_id" value="" />
			</form>
				<button class="btn btn-primary pull-right" onclick="saveUserEdu()"><?php echo JText::_('COM_DDC_SAVE'); ?></button>
				<button class="btn pull-right" onclick=""  data-dismiss="modal" aria-hidden="true"><?php echo JText::_('COM_DDC_CANCEL'); ?></button>
				<button class="btn btn-danger pull-right deletebtn" onclick="delUserEducation()" ><?php echo JText::_('COM_DDC_DELETE'); ?></button>
  			</div>
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
			<div class="span10">
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
				<textarea rows="5" class="span12" name="jform[description]" id="description"><?php echo JText::_('COM_DDC_DESCRIPTION'); ?></textarea>
				<input class="span12" type="hidden" name="jform[table]" value="userexperience" />
				<input class="span12" type="hidden" name="jform[ddc_user_experience_id]" id="jform_ddc_user_experience_id" value="" />
			</form>
				<button class="btn btn-primary pull-right" onclick="saveUserExp()"><?php echo JText::_('COM_DDC_SAVE'); ?></button>
				<button class="btn pull-right" onclick=""  data-dismiss="modal" aria-hidden="true"><?php echo JText::_('COM_DDC_CANCEL'); ?></button>
				<button class="btn btn-danger pull-right deletebtn" onclick="delUserExperience()" ><?php echo JText::_('COM_DDC_DELETE'); ?></button>
  			</div>
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
      	<div class="modal-body">
			<div class="span10">
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
				<button class="btn btn-primary pull-right" onclick="saveReference()"><?php echo JText::_('COM_DDC_SAVE'); ?></button>
				<button class="btn pull-right" onclick=""  data-dismiss="modal" aria-hidden="true"><?php echo JText::_('COM_DDC_CANCEL'); ?></button>
				<button class="btn btn-danger pull-right deletebtn" onclick="delReference()" ><?php echo JText::_('COM_DDC_DELETE'); ?></button>
  			</div>
  		</div>
	</div>
  </div>
</div>
