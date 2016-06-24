window.onload = function()
{
	var navigation = new Nav();
	navigation.addMainItem('item1', 'dd1');
	$('.nav-item').mouseenter(function(){navigation.rollDown(this.id);});
	$('.nav-item').mouseleave(function(){navigation.rollUp(this.id);});

}
