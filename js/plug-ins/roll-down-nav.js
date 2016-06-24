var DropDownItem = function(name)
{
	this.name = name;
}

var NavItem = function(name, child)
{
	var elem = new DropDownItem(child);
	this.name = name;
	this.dropDown = elem;
}

var Nav = function()
{
	this.mainItems = [];
	this.addMainItem = function(name, child)
	{
		var elem = new NavItem(name, child);
		this.mainItems.push(elem);
	}
	this.rollDown = function(name)
	{
		$('#'+this.mainItems[name].dropDown).slideDown();
	}
	this.rollUp = function(name)
	{
		$('#'+this.mainItems[name].dropDown).slideUp();
	}
}
