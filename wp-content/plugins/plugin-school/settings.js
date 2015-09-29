jQuery(document).ready(

	function($)
	{
		$('#pSsettingsForm').submit(
			function(event)
			{
				if($('#dateFormatString').val() == '')
				{
					$('#dateFormatStringMessage').html('<span style="font-weight: bold; color: red;">Please enter a value</span>');
					$('#dateFormatString').css({'border-color':'red'});
					return false;
				}
			}
		);
	}

);