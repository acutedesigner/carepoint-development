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


});