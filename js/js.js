window.onload = function()
{
	var navigation = new Nav();
	navigation.addMainItem('item1', 'dd1');
	$('.nav-item').click(function(){navigation.onclick(this.id);});


	//----------Register----------//

	$('#regform').submit(ajaxRegister);
}
