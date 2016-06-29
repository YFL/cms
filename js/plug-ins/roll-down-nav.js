var DropDownItem = function(name)
{
	this.elem = $('#'+name);
	this.active = false;
	return this;
}

var NavItem = function(name, child)
{
	var elem = new DropDownItem(child);
	this.name = name;
	this.dropDown = elem;
	this.dropDown.elem.css("left", $('#'+name).css("left"));
	var num = $('#'+name).outerHeight() + parseInt($('#'+name).css("top")) + 10;
	this.dropDown.elem.css("top", num + 'px');
}

var Nav = function()
{
	this.mainItems = [];
	this.addMainItem = function(name, child)
	{
		var elem = new NavItem(name, child);
		this.mainItems.push(elem);
	}
	this.onclick = function(name)
	{
		var i;
		for(i in this.mainItems)
		{
			if(this.mainItems[i].name === name) break;
		}
		if(this.mainItems[i].name != name) return;
		var control = this.mainItems[i].dropDown;
		if(!control.active) control.elem.slideDown("slow", function(){control.elem.css("display", "flex"); control.active = true;});
		else control.elem.slideUp("slow", function(){control.active = false;});
	}
}
