var ajaxRegister = function(e)
{
	var data = $('#regform').serialize();
	$.ajax(
		{
			type: 'POST',
			data: data,
			dataType: 'JSON',
			url: 'modules/register.php',
			success: function(data)
			{
				$('#success').text( 'Broki');
				console.log('madafak');
				console.log(data);
				if(typeof(data) !== "string")
				{
					$("#success").html("some value");
					console.log('hola');
					var keys = Object.getOwnPropertyNames(data);
					for (var error in keys) {
						{
							console.log(keys[error]);
							//$('#'+keys[error]).fadeIn(1000);
							$('#'+keys[error]).html(data[keys[error]]);
						}
					}
				}
				else //(er)
				{
					console.log('ratyi');
					$('#success').html(data);
				}
			},
			error: function(a, b, c)
			{
				alert('Server-side failure: '+a+' '+b+' '+c);
				console.log(a);
				console.log(b);
				console.log(c);
			}
		}
	);
	e.preventDefault();
  return false;
}
