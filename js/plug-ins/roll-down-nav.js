var DropDownItem = function(name)
{
	this.name = name;
	this.visible = 0;
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
		var i;
		for(i in this.mainItems)
		{
			if(this.mainItems[i].name === name) break;
		}
		if(this.mainItems[i].name != name) return;
		var control = $('#'+this.mainItems[i].dropDown.name);
		control.slideDown("slow", function(){control.css("display", "flex");});
	}
	this.rollUp = function(name)
	{
		var i;
		for(i in this.mainItems)
		{
			if(this.mainItems[i].name === name) break;
		}
		if(this.mainItems[i].name != name) return;
		var control = $('#'+this.mainItems[i].dropDown.name);
		control.slideUp("slow");
	}
}
