// JavaScript Document
$(document).ready(function(){
						   window.asd = $('.SlectB').SumoSelect({ csvDispCount: 3 ,placeholder: 'Allergies'});
						   window.asd = $('.SlectBo').SumoSelect({ csvDispCount: 3 ,placeholder: 'Medical History'});
						   window.asd = $('.SlectBoxx').SumoSelect({ csvDispCount: 3,placeholder: 'Affected by:' });
            window.test = $('.testsel').SumoSelect({okCancelInMulti:true });
$(".queries_click").click(function()
					{
						$(".conform_queries_click").text("Processing...");
						$('#queries').parsley('validate');
						var validation = $('#queries').parsley('isValid');
						if (validation == true) 
						{
							$(".queries_click").text("Processing...");
							var contain='';
							var contain1='';
							var contain2='';
							$('.SlectB').next().next().find( 'li').each(function(){
								if($(this).hasClass("selected")){
								contain += $(this).attr("data-val")+",";
								}
							});
							$(".allergies").val(contain);

							$('.SlectBo').next().next().find( 'li').each(function(){
								if($(this).hasClass("selected")){
								contain1 += $(this).attr("data-val")+",";
								}
							});
							$(".history").val(contain1);

							$('.SlectBoxx').next().next().find( 'li').each(function(){
								if($(this).hasClass("selected")){
								contain2 += $(this).attr("data-val")+",";
								}
							});
							$(".fhistory").val(contain2);

							var dataz=$("#queries").serialize();
							$(".resultis").val(dataz);
							$.ajax({
								type: 'POST',
								url: SITEURL + 'checkin-queries-load-data',
								data: dataz,
								success: function(res) {
									if (res == 0) {
										$("#patient_error").show();
										$("#continue").text('Countinue');
									} else {
										// window.location.href = SITEURL + 'patient/profile';
										$("#queries").hide();
										$('.hide-it-aj').hide();
										$(".info").show();
										$(".conform_registration").html(res);
										$(window).scrollTop(0);
										registration_function();
										$('.SlectiB').SumoSelect({ csvDispCount: 3 ,placeholder: 'Allergies'});
										$('.SlectiBo').SumoSelect({ csvDispCount: 3 ,placeholder: 'Medical History'});
										$('.SlectiBoxx').SumoSelect({ csvDispCount: 3 ,placeholder: 'Allergies'});

										var str=$(".allergies").val();
										$(".allergiesi").val(str);

										var str1=$(".history").val();
										$(".historyi").val(str1);

										var str2=$(".fhistory").val();
										$(".fhistoryi").val(str2);

										$(".reslut").val(dataz);
									}
								}
							});
						}
					});
$(".registration_click").click(function(){
					$('#checkin_reg').parsley('validate');
					var validation = $('#checkin_reg').parsley('isValid');
					if (validation == true) {
						document.getElementById('check_button').style.pointerEvents = 'none';
						$(".registration_click").text("Processing...");
						var formData = $("#checkin_reg").serialize();
						$(".resultis").val(formData);
						$.ajax({
							type: 'POST',
							url: SITEURL + 'checkin-registration-load-data',
							data: formData,
							success: function(res) {
								if (res == 0) {
									$("#patient_error").show();
									$(".registration_click").text('Countinue');
									document.getElementById('check_button').style.pointerEvents = 'auto';
								} else {
									// window.location.href = SITEURL + 'patient/profile';
									$("#checkin_reg").hide();
									$(".info").show();
									$('.hide-it-aj').hide();
									$(".conform_registration").html(res);
									$(window).scrollTop(0);
									registration_function();
								}
							}
						});
					}
									});
$(".insurence_click").click(function(){
	$('#user_insurence').parsley('validate');
        var validation = $('#user_insurence').parsley('isValid');
        if (validation == true) 
        {
            document.getElementById('insurence_click').style.pointerEvents = 'none';
					$(".insurence_click").text("Processing...");
					var formData = $("#user_insurence").serialize();
					$(".resultis").val(formData);
					$.ajax({
						type: 'POST',
						url: SITEURL + 'checkin-insurence-load-data',
						data: formData,
						success: function(res) {
							if (res == 0) {
								$("#patient_error").show();
								$("#insurence_click").text('Countinue');
							} else {
								// window.location.href = SITEURL + 'patient/profile';
								$("#user_insurence").hide();
								$('.hide-it-aj').hide();
								$(".info").show();
								$(".conform_insurence").html(res);
								$(window).scrollTop(0);
								registration_function();
							}
						}
					});
		}
});

function registration_function(){
$(".editthis").click(function(){
							  $(this).parent().hide();
							  $(this).parent().next().show();
							  });
$(".cancel").click(function(){
							  $(this).parent().parent().parent().hide();
							  $(this).parent().parent().parent().prev().show();
							  });
$(".save").click(function(){
						  $(".save").text("Processing...");
		var form = $(".conform_registration").serialize();
		$(".resultis").val(form);
//alert(form);
});
$(".save2").click(function(){
						   $(".save2").text("Processing...");
		var form = $(".conform_registration").serialize();
		$(".resultis").val(form);
//alert(form);
});
$(".save1").click(function(){
						   $(".save1").text("Processing...");
						     var contain='';
															  var contain1='';
															  var contain2='';
								   $('.SlectiB').next().next().find( 'li').each(function(){
														 if($(this).hasClass("selected")){
														 contain += $(this).attr("data-val")+",";
														 }
														 });
								   $(".allergiesi").val(contain);
								   
								   $('.SlectiBo').next().next().find( 'li').each(function(){
														 if($(this).hasClass("selected")){
														 contain1 += $(this).attr("data-val")+",";
														 }
														 });
								   $(".historyi").val(contain1);
								   
								   $('.SlectiBoxx').next().next().find( 'li').each(function(){
														 if($(this).hasClass("selected")){
														 contain2 += $(this).attr("data-val")+",";
														 }
														 });
								   $(".fhistoryi").val(contain2);
								   
								   var dataz=$("#query_result").serialize();
								   $(".reslut").val(dataz);
						   });
$(".conform_click").click(function(){
								   $(".conform_click").text("Processing...");
								   var Data = $(".resultis").val();
										$.ajax({
                type: 'POST',
                url: SITEURL + 'save-checkin-registration',
                data: Data,
                success: function(res) {
                    if (res == 0) {
                        $("#patient_error").show();
                        $("#continue").text('Countinue');
                    } else {
                       window.location.href = SITEURL + 'checkin-queries';
					   console.log(res);
                    }
                }
								   }); });

$(".conform_queries_click").click(function(){
												var Data = $(".reslut").val();
												$.ajax({
												type: 'POST',
												url: SITEURL + 'save-checkin-queries',
												data: Data,
												success: function(res) {
													if (res == 0) {
														$("#patient_error").show();
														$("#continue").text('Countinue');
													} else {
														window.location.href = SITEURL + 'checkin-billing';
														console.log(res);
													}
												}
												}); 
										});
$(".conform_insurence_click").click(function(){
											 $(".conform_insurence_click").text("Processing...");
								   var Data = $(".resultis").val();
										$.ajax({
                type: 'POST',
                url: SITEURL + 'save-checkin-insurence',
                data: Data,
                success: function(res) {
                    if (res == 0) {
                        $("#patient_error").show();
                        $("#continue").text('Countinue');
                    } else {
                      // window.location.href = SITEURL + 'checkin-queries';
					  $(".final_conformation").show();
					  $(".conform_insurence").hide();
					  $(".info").hide();
					  $(window).scrollTop(0);
                    }
                }
								   }); });
 $('.toggler').click(function(){
       if (this.checked) {
           $('.final_confirm_click').removeClass('blank_button');
		   $('.final_confirm_click').addClass('conform_button');
       } else {
           $('.final_confirm_click').removeClass('conform_button');
		   $('.final_confirm_click').addClass('blank_button');
       }
   });
 $(".final_confirm_click").click(function(){
										  $(".final_confirm_click").text("Processing...");
										  $.ajax({
                url: SITEURL + 'save-checkin-details',
                success: function(res) {
                    if (res == 0) {
                        $("#patient_error").show();
                        $("#continue").text('Countinue');
                    } else {
                      window.location.href = SITEURL + 'past_appoinments';
					  /*$(".final_conformation").show();
					  $(".conform_insurence").hide();
					  $(".info").hide();
					  $(window).scrollTop(0);*/
                    }
                }
								   });
										  });

}

});