jQuery( function( $ ) {

    toggleFields();
    
    $("#blockstyle").change(function () {
        toggleFields();
    });


	function toggleFields() {
	    if ($("#blockstyle").val() === 'block-thumb')
	        $("#blocklink").show();
	    else
	        $("#blocklink").hide();
	}

});

