$(function(){

	var save_and_close = false;

	var reload_datagrid = function () {
		$('.refresh-data').trigger('click');
	};

	var locations = location.href;
	var table = ''
	if(locations.includes('subscription')){
		$("#approve-button").css('display','block');
		table = 'subscription';
	}else if(locations.includes('user_management')){
		$("#approve-button").css('display','block');
		table = 'user';
	}else if(locations.includes('mentor_management')){
		$("#approve-button").css('display','block');
		table = 'mentor'
	}

	$('#save-and-go-back-button').click(function(){
		save_and_close = true;

		$('#crudForm').trigger('submit');
	});

	$('#crudForm').submit(function(){
		$(this).ajaxSubmit({
			url: validation_url,
			dataType: 'json',
			beforeSend: function(){
				$("#FormLoading").show();
			},
			cache: false,
			success: function(data){
				$("#FormLoading").hide();
				if(data.success)
				{
					$('#crudForm').ajaxSubmit({
						dataType: 'text',
						cache: false,
						beforeSend: function(){
							$("#FormLoading").show();
						},
						success: function(result){
							$("#FormLoading").fadeOut("slow");
							data = $.parseJSON( result );
							if(data.success)
							{
								if(save_and_close)
								{
									if ($('#save-and-go-back-button').closest('.ui-dialog').length === 0) {
										window.location = data.success_list_url;
									} else {
										$(".ui-dialog-content").dialog("close");
										success_message(data.success_message);
										reload_datagrid();
									}

									return true;
								}

								$('.field_error').removeClass('field_error');

								form_success_message(data.success_message);
								reload_datagrid();
							}
							else
							{
								form_error_message(message_update_error);
							}
						},
						error: function(){
							form_error_message( message_update_error );
						}
					});
				}
				else
				{
					$('.field_error').removeClass('field_error');
					form_error_message(data.error_message);
					$.each(data.error_fields, function(index,value){
						$('#crudForm input[name='+index+']').addClass('field_error');
					});
				}
			}
		});
		return false;
	});

	$(window).load(function(){
		if(location.href.includes('subscription')){
			var approve_button = $("#field-activate").val()	
		}else{
			var approve_button = $("#field-active").val()
		}
		if(approve_button == '1'){
			$("#approve-buttons").val('Disapprove');
		}else{
			$("#approve-buttons").val('Approve');
		}
	})

	$("#approve-buttons").click(function(){
		var locations = location.href.split('/');
		var id = locations[locations.length-1];
		var approve_button = $("#field-active").html();
		var type = $(this).val();
		var activate = 1;
		if(type != 'Approve'){
			activate = 2
		}
		$.ajax({
	      type: "POST",
	      url: "/buddy/home/active_deactive_users",
	      data: {"activate":activate, "type":type, "id":id, "table":table},
	      success: function(data){
	      	// console.log(data);
	      	$("#approve-buttons").val('Disapprove');
	      	data = JSON.parse(data);
	      	alert(data.msg);
	      	window.location.href = data.url;
	      	console.log(data.msg);
	      }
	    });
	});

	$(document).on("click",'#login_btn',function(){
	    var user_id= $(".user_id").val();
	    var password= $(".password").val();
	    $.ajax({
	      type: "POST",
	      url: "http://localhost/buddy/index.php/home/login",
	      data: {"userId":user_id, "password": password},
	      success: function(data){
	        if(data != 'success'){
	            $("#error-msg").addClass("show");
	            $("#error-msg").html(data);
	            setTimeout(fadeOut, 2000);
	        }
	      }
	    }); 
	})

	$('.ui-input-button').button();
	$('.gotoListButton').button({
        icons: {
        	primary: "ui-icon-triangle-1-w"
    	}
	});

	if( $('#cancel-button').closest('.ui-dialog').length === 0 ) {
		$('#cancel-button').click(function(){
			if( $(this).hasClass('back-to-list') || confirm( message_alert_edit_form ) )
			{
				window.location = list_url;
			}

			return false;
		});

	}

});