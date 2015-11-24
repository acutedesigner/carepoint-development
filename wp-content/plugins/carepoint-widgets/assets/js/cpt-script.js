jQuery( function( $ )
{
	// Function for the print page feature.
	$(".cp_print_button").click( function (e)
	{
		e.preventDefault();

		// First the variables are setup
		var href = $(this).attr('href');
		var strWindowFeatures = "menubar=no,location=yes,resizable=yes,scrollbars=yes,status=no width=750,height=1000";
		var openWindow = window.open(href, "Carepoint", strWindowFeatures);

		// We then chain the new window to the window print
		// This ensure that is correct window is printed
		openWindow.window.print();

	});

	// Function for the A to Z select menu
	$( "#atoz-select" ).change(function() {
		window.location.href = wp_js_object.site_url + "/tag/" + $(this).val();
	});

	// Function for email article form
	$(".email-form").submit(function (e)
	{
		e.preventDefault();

		//Get the form object
		$form = $(this);

		// Hide the form and show sending gif
		
		email = $form.find( "input[name='email']" ).val();
		nonce = $form.find("input[name='nonce']").val();
		action = $form.find("input[name='action']").val();
			
		$.ajax({
			type: "post",
			dataType: "json",
			data: { email: email, nonce: nonce, action: action },
			url: wp_js_object.ajax_url,
			success: function(response){
				if(response.type == "success")
				{
					alert('success');
				}
				else if(response.type == "error")
				{
					alert('error');
				}
			}
		});
	});


});

jQuery(document).ready(function( $ ){

	$(".cp_bookmark_article_button").click(function(e){

		e.preventDefault();
		
		element = $(this);
		post_id = $(this).data("post-id");
		nonce = $(this).data("nonce");
		action = $(this).data("action");

		$.ajax({
			type: "post",
			dataType: "json",
			url: wp_js_object.site_url + '/savearticle/' + action + '/' + post_id + '/' + nonce,
			success: function(response){
				if(response.type == "success" && response.method == "bookmark")
				{
					element.find("i").removeClass("fa-plus-circle").addClass("fa-trash");
					element.data('action','unbookmark');
					element.tooltipster('content', 'Remove article from your list');
				}
				else if(response.type == "success" && response.method == "unbookmark")
				{
					element.find("i").removeClass("fa-trash").addClass("fa-plus-circle");
					element.data('action','bookmark');
					element.tooltipster('content', 'Save this article');
				}
			}
		});
	});

});