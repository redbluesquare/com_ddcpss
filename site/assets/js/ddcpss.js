function saveUserExp(){
	var userexpInfo = {};
	jQuery("#uexpForm :input").each(function(idx,ele){
		userexpInfo[jQuery(ele).attr('name')] = jQuery(ele).val();
	});

	jQuery.ajax({
		url:'index.php?option=com_ddcpss&controller=add&format=raw&tmpl=component',
		type:'POST',
		data:userexpInfo,
		dataType:'JSON',
		beforeSend:function(){
			console.log("...saving...");
			jQuery("#modal_update").css("display","inline");
			jQuery("#modal_update > #status").html("...saving...");
		},
		complete:function(){

		},
		success:function(data)
		{
			if ( data.success == true ){
				setTimeout(
		    	    	function() 
		    	      {
		    	      	location.reload();
		    	      }, 0800);
			}else{

			}
		}
	});
	
}


function addUserExperience(){
	jQuery("#jform_company_name").val("");
	jQuery("#jform_job_title").val("");
	jQuery("#jform_location").val("");
	jQuery("#jform_start_month").val("");
	jQuery("#jform_start_year").val("");
	jQuery("#jform_end_month").val("");
	jQuery("#jform_end_year").val("");
	jQuery("#jform_description").val("");
	jQuery("#jform_ddc_user_experience_id").val("");
	jQuery(".deletebtn").hide();
	
}
function updateUserExperience(userexp, tableval){


	jQuery.ajax({
		url:'index.php?option=com_ddcpss&controller=get&format=raw&tmpl=component&table='+tableval+'&user_experience_id='+userexp,
		type:'get',
		dataType:'JSON',
		success:function(data)
		{
			if ( data.success ){
				jQuery("#jform_company_name").val(data.html.company_name);
				jQuery("#jform_job_title").val(data.html.job_title);
				jQuery("#jform_location").val(data.html.location);
				jQuery("#uexpForm #jform_start_month").val(data.html.start_month);
				jQuery("#uexpForm #jform_start_year").val(data.html.start_year);
				if(data.html.end_month != 0){
					jQuery("#uexpForm #jform_end_month").val(data.html.end_month);
				}
				if(data.html.end_year != 0){
					jQuery("#uexpForm #jform_end_year").val(data.html.end_year);
				}
				if( data.html.current_employer == "1" ){
					jQuery("#jform_current_employer").attr( "checked", true );
				}
				
				jQuery("#jform_description").val(data.html.description);
				jQuery("#jform_ddc_user_experience_id").val(data.html.ddc_user_experience_id);
				jQuery(".deletebtn").show();
			}else{

			}
		}
	});
	
}
function delUserExperience() {
    if (confirm("Are you sure you want to delete this entry?") == true) {
    	var userexpInfo = {};
    	jQuery("#uexpForm :input").each(function(idx,ele){
    		userexpInfo[jQuery(ele).attr('name')] = jQuery(ele).val();
    	});

    	jQuery.ajax({
    		url:'index.php?option=com_ddcpss&controller=delete&format=raw&tmpl=component',
    		type:'POST',
    		data:userexpInfo,
    		beforeSend:function(){
    			jQuery("#modal_update").css("display","inline");
    			jQuery("#modal_update > #status").html("...deleting...");
    		},
    		complete:function(){

    		},
    		dataType:'JSON',
    		success:function(data)
    		{
    			if ( data.success == true ){
    				setTimeout(
    		    	    	function() 
    		    	      {
    		    	      	location.reload();
    		    	      }, 0800);
    			}else{
    				
    			}
    		}
    	});

    } else {
        //show box as normal
    }
    
}

function saveUserEdu(){
	var usereduInfo = {};
	jQuery("#ueduForm :input").each(function(idx,ele){
		usereduInfo[jQuery(ele).attr('name')] = jQuery(ele).val();
	});

	jQuery.ajax({
		url:'index.php?option=com_ddcpss&controller=add&format=raw&tmpl=component',
		type:'POST',
		data:usereduInfo,
		beforeSend:function(){
			jQuery("#modal_update").css("display","inline");
			jQuery("#modal_update > #status").html("...saving...");
		},
		complete:function(){

		},
		dataType:'JSON',
		success:function(data)
		{
			if ( data.success == true ){
				setTimeout(
		    	    	function() 
		    	      {
		    	      	location.reload();
		    	      }, 0800);
			}else{

			}
		}
	});
	
}


function addUserEducation(){
	jQuery("#jform_school").val("");
	jQuery("#jform_degree").val("");
	jQuery("#jform_grade").val("");
	jQuery("#jform_field_of_study").val("");
	jQuery("#jform_start_year").val("");
	jQuery("#jform_end_year").val("");
	jQuery("#jform_education_description").val("");
	jQuery("#jform_ddc_user_education_id").val("");
	jQuery(".deletebtn").hide();
	
}
function updateUserEducation(useredu, tableval){


	jQuery.ajax({
		url:'index.php?option=com_ddcpss&controller=get&format=raw&tmpl=component&table='+tableval+'&user_education_id='+useredu,
		type:'get',
		dataType:'JSON',
		success:function(data)
		{
			if ( data.success ){
				jQuery("#jform_school").val(data.html.school);
				jQuery("#jform_degree").val(data.html.degree);
				jQuery("#jform_grade").val(data.html.grade);
				jQuery("#jform_field_of_study").val(data.html.field_of_study);
				jQuery("#jform_start_year").val(data.html.start_year);
				jQuery("#jform_end_year").val(data.html.end_year);
				jQuery("#jform_education_description").val(data.html.education_description);
				jQuery("#jform_ddc_user_education_id").val(data.html.ddc_user_education_id);
				jQuery(".deletebtn").show();
			}else{

			}
		}
	});
	
}
function delUserEducation() {
    if (confirm("Are you sure you want to delete this entry?") == true) {
    	var usereduInfo = {};
    	jQuery("#ueduForm :input").each(function(idx,ele){
    		usereduInfo[jQuery(ele).attr('name')] = jQuery(ele).val();
    	});

    	jQuery.ajax({
    		url:'index.php?option=com_ddcpss&controller=delete&format=raw&tmpl=component',
    		type:'POST',
    		data:usereduInfo,
    		beforeSend:function(){
    			jQuery("#modal_update").css("display","inline");
    			jQuery("#modal_update > #status").html("...deleting...");
    		},
    		complete:function(){

    		},
    		dataType:'JSON',
    		success:function(data)
    		{
    			if ( data.success == true ){
    				setTimeout(
    		    	    	function() 
    		    	      {
    		    	      	location.reload();
    		    	      }, 0800);
    			}else{

    			}
    		}
    	});
    } else {
        //show box as normal
    }
    
}

function saveUserCRA(){
	var usercraInfo = {};
	jQuery("#ucraForm :input").each(function(idx,ele){
		usercraInfo[jQuery(ele).attr('name')] = jQuery(ele).val();
	});

	jQuery.ajax({
		url:'index.php?option=com_ddcpss&controller=add&format=raw&tmpl=component',
		type:'POST',
		data:usercraInfo,
		dataType:'JSON',
		beforeSend:function(){
			jQuery("#modal_update").css("display","inline");
			jQuery("#modal_update > #status").html("...saving...");
		},
		complete:function(){

		},
		success:function(data)
		{
			if ( data.success == true ){
				setTimeout(
		    	    	function() 
		    	      {
		    	      	location.reload();
		    	      }, 0800);
			}else{

			}
		}
	});
	
}

function addReference(){
	jQuery("#jform_referee_name").val("");
	jQuery("#jform_position").val("");
	jQuery("#jform_organisation").val("");
	jQuery("#jform_address").val("");
	jQuery("#jform_contact_email").val("");
	jQuery("#jform_contact_number").val("");
	jQuery("#jform_notes").val("");
	jQuery("#jform_relationship").val("");
	jQuery("#jform_timeframe").val("");
	jQuery("#jform_contact_early").val("");
	jQuery("#ddc_reference_id").val("");
	jQuery(".deletebtn").hide();
	
}

function saveReference(){
	var referenceInfo = {};
	jQuery("#referenceForm :input").each(function(idx,ele){
		referenceInfo[jQuery(ele).attr('name')] = jQuery(ele).val();
	});

	jQuery.ajax({
		url:'index.php?option=com_ddcpss&controller=add&format=raw&tmpl=component',
		type:'POST',
		data:referenceInfo,
		dataType:'JSON',
		beforeSend:function(){
			jQuery("#modal_update").css("display","inline");
			jQuery("#modal_update > #status").html("...saving...");
		},
		complete:function(){

		},
		success:function(data)
		{
			if ( data.success == true ){
				setTimeout(
		    	    	function() 
		    	      {
		    	      	location.reload();
		    	      }, 0800);
			}else{

			}
		}
	});
	
}

function updateReference(reference, tableval){


	jQuery.ajax({
		url:'index.php?option=com_ddcpss&controller=get&format=raw&tmpl=component&table='+tableval+'&reference_id='+reference,
		type:'get',
		dataType:'JSON',
		success:function(data)
		{
			if ( data.success ){
				jQuery("#jform_referee_name").val(data.html.referee_name);
				jQuery("#jform_position").val(data.html.position);
				jQuery("#jform_organisation").val(data.html.organisation);
				jQuery("#jform_address").val(data.html.address);
				jQuery("#jform_contact_number").val(data.html.contact_number);
				jQuery("#jform_contact_email").val(data.html.contact_email);
				jQuery("#jform_relationship").val(data.html.relationship);
				jQuery("#jform_timeframe").val(data.html.timeframe);
				jQuery("#jform_notes").val(data.html.notes);
				jQuery("#jform_contact_early").val(data.html.contact_early);
				jQuery("#jform_ddc_reference_id").val(data.html.ddc_reference_id);
				jQuery(".deletebtn").show();
			}else{

			}
		}
	});
	
}
function delReference() {
    if (confirm("Are you sure you want to delete this entry?") == true) {
    	var referenceInfo = {};
    	jQuery("#referenceForm :input").each(function(idx,ele){
    		referenceInfo[jQuery(ele).attr('name')] = jQuery(ele).val();
    	});

    	jQuery.ajax({
    		url:'index.php?option=com_ddcpss&controller=delete&format=raw&tmpl=component',
    		type:'POST',
    		data:referenceInfo,
    		dataType:'JSON',
    		beforeSend:function(){
    			jQuery("#modal_update").css("display","inline");
    			jQuery("#modal_update > #status").html("...deleting...");
    		},
    		complete:function(){

    		},
    		success:function(data)
    		{
    			if ( data.success == true ){
    				setTimeout(
    		    	    	function() 
    		    	      {
    		    	      	location.reload();
    		    	      }, 0800);
    			}else{

    			}
    		}
    	});

    } else {
        //show box as normal
    }
    
}
jQuery(document).ready(function()
	{
	jQuery(".profile-image").hover(
		function(){jQuery(".caption-imgupload").fadeIn( 500 )},
		function(){jQuery(".caption-imgupload").fadeOut( 500 )}
	);
	}
);

function addMembership(){
	jQuery("#jform_title").val("");
	jQuery("#jform_membership_number").val("");
	jQuery("#jform_expiry_date").val("");
	jQuery("#jform_alias").val("");
	jQuery(".deletebtn").hide();
	
}

function saveUserMembership(){
	var membershipInfo = {};
	jQuery("#membershipForm :input").each(function(idx,ele){
		membershipInfo[jQuery(ele).attr('name')] = jQuery(ele).val();
	});

	jQuery.ajax({
		url:'index.php?option=com_ddcpss&controller=add&format=raw&tmpl=component',
		type:'POST',
		data:membershipInfo,
		dataType:'JSON',
		beforeSend:function(){
			jQuery("#modal_update").css("display","inline");
			jQuery("#modal_update > #status").html("...saving...");
		},
		complete:function(){

		},
		success:function(data)
		{
			if ( data.success == true ){
				setTimeout(
				    	function() 
				      {
				      	location.reload();
				      }, 0800);
	
			}else{

			}
		}
	});
	
}
function disableAlert(){
	var progressAlert = {"jform[table]":"progress"};

	jQuery.ajax({
		url:'index.php?option=com_ddcpss&controller=add&format=raw&tmpl=component',
		type:'POST',
		data:progressAlert,
		dataType:'JSON',
		success:function(data)
		{
			if ( data.success == true ){
				
			}else{

			}
		}
	});
}
function disablePostAlert(){
	var progressAlert = {"jform[table]":"progressComplete"};

	jQuery.ajax({
		url:'index.php?option=com_ddcpss&controller=add&format=raw&tmpl=component',
		type:'POST',
		data:progressAlert,
		dataType:'JSON',
		success:function(data)
		{
			if ( data.success == true ){
				
			}else{

			}
		}
	});
}

function updateUserMembership(usermem, tableval){


	jQuery.ajax({
		url:'index.php?option=com_ddcpss&controller=get&format=raw&tmpl=component&table='+tableval+'&user_membership_id='+usermem,
		type:'get',
		dataType:'JSON',
		success:function(data)
		{
			if ( data.success ){
				jQuery("#jform_title").val(data.html.title);
				jQuery("#jform_alias").val(data.html.alias);
				jQuery("#jform_membership_number").val(data.html.membership_number);
				jQuery("#jform_expiry_date").val(data.html.ed);
				jQuery("#jform_ddc_user_membership_id").val(data.html.ddc_user_membership_id);
				jQuery(".deletebtn").show();
			}else{

			}
		}
	});
	
}
function delUserMembership() {
    if (confirm("Are you sure you want to delete this entry?") == true) {
    	var userMembershipInfo = {};
    	jQuery("#membershipForm :input").each(function(idx,ele){
    		userMembershipInfo[jQuery(ele).attr('name')] = jQuery(ele).val();
    	});

    	jQuery.ajax({
    		url:'index.php?option=com_ddcpss&controller=delete&format=raw&tmpl=component',
    		type:'POST',
    		data:userMembershipInfo,
    		dataType:'JSON',
    		beforeSend:function(){
    			jQuery("#modal_update").css("display","inline");
    			jQuery("#modal_update > #status").html("...deleting...");
    		},
    		complete:function(){

    		},
    		success:function(data)
    		{
    			if ( data.success == true ){
    				setTimeout(
    		    	    	function() 
    		    	      {
    		    	      	location.reload();
    		    	      }, 0800);
    			}else{

    			}
    		}
    	});
    } else {
        //show box as normal
    }
    
}

function _(el){
	return document.getElementById(el);
}
function updateAboutMe(){
	
	var aboutmeInfo = {};
	jQuery("#aboutmeForm :input").each(function(idx,ele){
		aboutmeInfo[jQuery(ele).attr('name')] = jQuery(ele).val();
	});
	jQuery.ajax({
		url:'index.php?option=com_ddcpss&controller=add&format=raw&tmpl=component',
		type:'POST',
		data:aboutmeInfo,
		dataType:'JSON',
		success:function(data)
		{
			if ( data.success == true ){
				jQuery("#aboutme").html(data.html.misc);
				jQuery("#aboutmeModal").modal('hide');
			}else{

			}
		}
	});

}
function getAboutme(){


	jQuery.ajax({
		url:'index.php?option=com_ddcpss&controller=get&format=raw&tmpl=component&table=profiles',
		type:'get',
		dataType:'JSON',
		success:function(data)
		{
			if ( data.success ){
				jQuery("#jform_aboutme").val(data.html.misc);
				var text_length = jQuery('#jform_aboutme').val().length;
	  			var text_max = 7000;
	  			var text_remaining = text_max - text_length;
	  			jQuery('#textarea_feedback').html(text_remaining + ' characters remaining');
			}else{
			}
		}
	});
	
}

function saveUserProfile(){
	var userProfileInfo = {};
	jQuery("#userProfileForm :input").each(function(idx,ele){
		userProfileInfo[jQuery(ele).attr('name')] = jQuery(ele).val();
	});
	jQuery.ajax({
		url:'index.php?option=com_ddcpss&controller=add&format=raw&tmpl=component',
		type:'POST',
		data:userProfileInfo,
		dataType:'JSON',
		beforeSend:function(){
			jQuery("#modal_update").css("display","inline");
			jQuery("#modal_update > #status").html("...saving...");
		},
		complete:function(){

		},
		success:function(data)
		{
			if ( data.success == true ){

				setTimeout(
		    	    	function() 
		    	      {
		    	      	location.reload();
		    	      }, 0800);
			}else{

			}
		}
	});
}
function getUserProfile(){
	jQuery.ajax({
		url:'index.php?option=com_ddcpss&controller=get&format=raw&tmpl=component&table=userprofiledetails',
		type:'get',
		dataType:'JSON',
		success:function(data)
		{
			if ( data.success ){
				jQuery("#jform_firstname").val(data.html.firstname);
				jQuery("#jform_lastname").val(data.html.lastname);
				jQuery("#jform_address1").val(data.html.address1);
				jQuery("#jform_address2").val(data.html.address2);
				jQuery("#jform_city").val(data.html.city);
				jQuery("#jform_region").val(data.html.region);
				jQuery("#jform_country").val(data.html.country);
				jQuery("#jform_postal_code").val(data.html.postal_code);
				jQuery("#jform_phone").val(data.html.phone);
			}else{
			}
		}
	});	
}


function _(el){
    return document.getElementById(el);
}
function uploadPhoto(){
    

	var file = _("upload_photo").files[0];
    var formdata = new FormData();
    formdata.append("upload_photo", file);
    var ajax = new XMLHttpRequest();
    ajax.upload.addEventListener("progress", progressHandler, false);
    ajax.addEventListener("load", completeHandler, false);
    ajax.addEventListener("error", errorHandler, false);
    ajax.addEventListener("abort", abortHandler, false);
    ajax.open("POST", "index.php?option=com_ddcpss&controller=add&format=raw&tmpl=component&jform[table]=updatephoto");
    ajax.send(formdata);
}
function progressHandler(event){
    var percent = (event.loaded / event.total) * 100;
    _("progressBar").value = Math.round(percent);
    _("status").innerHTML = Math.round(percent)+"% uploaded... please wait";
}
function completeHandler(event){
    _("status").innerHTML = "";
    _("progressBar").value = 0;
    _("myprofilepic").src = event.target.responseText;
    jQuery("#uploadPhotoModal").modal('hide');
    _("upload_photo").value = "";
}
function errorHandler(event){
    _("status").innerHTML = event.responseText;
}
function abortHandler(event){
    _("status").innerHTML = "Upload Aborted";
}

function uploadCV(){
    

	var file = _("upload_cv").files[0];
    var formdata = new FormData();
    formdata.append("upload_cv", file);
    var ajax = new XMLHttpRequest();
    ajax.upload.addEventListener("progress", progressCVHandler, false);
    ajax.addEventListener("load", completeCVHandler, false);
    ajax.addEventListener("error", errorCVHandler, false);
    ajax.addEventListener("abort", abortCVHandler, false);
    ajax.open("POST", "index.php?option=com_ddcpss&controller=add&format=raw&tmpl=component&jform[table]=mycv");
    ajax.send(formdata);
}

function progressCVHandler(event){
    var percent = (event.loaded / event.total) * 100;
    _("progresscvBar").value = Math.round(percent);
    _("statuscv").innerHTML = Math.round(percent)+"% uploaded... please wait";
}
function completeCVHandler(event){
    _("statuscv").innerHTML = "";
    _("progresscvBar").value = 0;
    _("mycv").src = event.target.responseText;
    jQuery("#uploadCVModal").modal('hide');
    _("upload_cv").value = "";
}
function errorCVHandler(event){
    _("statuscv").innerHTML = event.responseText;
}
function abortCVHandler(event){
    _("statuscv").innerHTML = "Upload Aborted";
}

function upload_file(){
    
	var userImage = {};
	//jQuery("#upload_file_form :input").each(function(idx,ele){
	//	userImage[jQuery(ele).attr('name')] = jQuery(ele).val();
	//});
	var formData = new FormData(jQuery("#upload_file_form")[0]);

	jQuery.ajax({
	     url: "index.php?option=com_ddcpss&controller=add&format=raw&tmpl=component",
	     type: 'POST',
	     data: formData,
	     async: false,
	     success: function (data) {
	         alert(data)
	     },
	     cache: false,
	     contentType: false,
	     processData: false
	 });

	
//	var userImage = {};
//	jQuery("#upload_file_form :input").each(function(idx,ele){
//		userImage[jQuery(ele).attr('name')] = jQuery(ele).val();
//	});
//	var file = _("file_upload").files[0];
//    var formdata = new FormData();
//    formdata.append("file_upload", file);
//    var ajax = new XMLHttpRequest();
//    ajax.upload.addEventListener("progress", progressFileHandler, false);
//    ajax.addEventListener("load", completeFileHandler, false);
//    ajax.addEventListener("error", errorFileHandler, false);
//    ajax.addEventListener("abort", abortFileHandler, false);
//    ajax.open("POST", "index.php?option=com_ddcpss&controller=add&format=raw&tmpl=component");
//    ajax.send(formdata);
//    ajax.send(userImage);
}

function progressFileHandler(event){
    var percent = (event.loaded / event.total) * 100;
    _("progressFileBar").value = Math.round(percent);
    _("file_status").innerHTML = Math.round(percent)+"% uploaded... please wait";
}
function completeFileHandler(event){
    _("file_status").innerHTML = "";
    _("progressFileBar").value = 0;
    jQuery("#uploadModal").modal('hide');
    _("file_upload").value = "";
}
function errorFileHandler(event){
    _("file_status").innerHTML = event.responseText;
}
function abortFileHandler(event){
    _("file_status").innerHTML = "Upload Aborted";
}

function loadregform(){
	document.getElementById("jform_name").readOnly=true;
	
}

