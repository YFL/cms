var ajaxRegister = function(e)
{
	var url = 'modules/register.php';
	var data = $('#regform').serialize();
	$.ajax(
		{
			type: 'POST',
			data: data,
			url: url,
			success: function(data)
			{
				$('.error').text('');
				//console.log('madafak');
				console.log(data);
				var first = data.charAt(0);
				if(first === '{')
				{
					var jsoned = $.parseJSON(data);
					var keys = Object.getOwnPropertyNames(jsoned);
					for (var error in keys)
					{
						console.log(keys[error]);
						//$('#'+keys[error]).fadeIn(1000);
						$('#'+keys[error]).html(jsoned[keys[error]]);
					}
				}
				else //(er)
				{
					//console.log('ratyi');
					$('#success').html(data);
				}
			},
			error: function(a, b, c, d)
			{
				alert('Server-side failure: '+a+' '+b+' '+c+' '+d);
				console.log(a);
				console.log(b);
				console.log(c);
				console.log(d);
			}
		}
	);
	e.preventDefault();
  return false;
}
