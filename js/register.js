$('window').on("load", function()
{
	$('#regform').submit(function(e)
	{
		var data = $('#regform').serialize();
		$.ajax(
			{
				type: 'POST',
				data: data,
				dataType: 'JSON',
				url: 'register.php',
				success: function(data)
				{
					try
					{
						var dat = JSON.parse(data);
						var keys = Object.getOwnPropertyNames(dat);
						for (var error in keys) {
							{
								$('#'+keys[error]).fadeIn(1000);
								$('#'+keys[error]).html(dat[keys[error]]);
							}
						}
					}
					catch (e)
					{
						$('#success').html(data);
					}
				},
				error: function(a, b, c)
				{
					alert('Server-side failure: '+a+' '+b+' '+c);
				}
			}
		);
		e.preventDefault();
    return false;
	});
});
