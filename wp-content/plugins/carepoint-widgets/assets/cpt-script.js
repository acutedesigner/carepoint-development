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
			url: wp_js_object.ajax_url,
			data: {action: action, post_id: post_id, nonce: nonce},
			success: function(response){
				if(response.type == "success" && response.method == "bookmark")
				{
					element.find("i").removeClass("fa-plus-circle").addClass("fa-trash");
					element.data('action','cp_unbookmark_article');
					element.tooltipster('content', 'Remove article from your list');
				}
				else if(response.type == "success" && response.method == "unbookmark")
				{
					element.find("i").removeClass("fa-trash").addClass("fa-plus-circle");
					element.data('action','cp_bookmark_article');
					element.tooltipster('content', 'Save this article');
				}
			}
		});
	});

});