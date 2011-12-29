/*
Script: NinjaModuleHider.js
	Contains <NinjaModuleHider>

License:
	MIT-style license.
	
Author:
	Stian Didriksen <stian@ninjaforge.com>
	
Copyright:
	Copyright (C) 2007 - 2010 NinjaForge. All rights reserved.
*/

/*
Class: NinjaModuleHider
	Basically Fx.Slide with a handle, and cookie states.

Note:
	NinjaModuleHider requires an XHTML doctype.

Options:
	open - set the initial state
	msg - set the handle messages
	cookie - set the cookie options, set to false if you don't want to use cookies
	options - all the <Fx.Slide> options

Example:
	(start code)
	new NinjaModuleHider('myElement', {duration: 500});
	(end)
*/

var NinjaModuleHider = Fx.Slide.extend({

	options: {

		duration: 1000,
		transition: Fx.Transitions.Quad.easeInOut,
		
		open: false,

		msg: {
			open:  'Open Panel',
			close: 'Close Panel'
		},

		cookie: {
			duration: 3600
		}

	},

	initialize: function(el, options){

		this.parent(el, options);
		this.handle = this.element.getParent().getParent().getChildren().filterByClass('handle')[0];

		this.handle.addEvent('click', this.onHandle.bind(this)).setHTML(this.options.msg.close);
		this.addEvent('onStart'     , this.setMessage.bind(this));
		this.addEvent('onComplete'  , this.setState.bind(this));
		this.hide();

		this.open = this.options.open;
		if(this.options.cookie) {
			var cookie = Cookie.get(this.element.getProperty('id'));
			if(cookie !== false) this.open = 'true' == cookie;
		}

		if(this.open){
			this.open = false;
			this.handle.fireEvent('click');
		}
	},
	
	onHandle: function(event){
		if(event) new Event(event).stop();
		this.toggle();
	},
	
	setMessage: function(){
		if(this.open) {
			this.handle.setHTML(this.options.msg.close)
			           .addClass('open')
			           .removeClass('closed');
		}
		else {
			this.handle.setHTML(this.options.msg.open)
			           .addClass('closed')
			           .removeClass('open');
		}
	},
	
	setState: function(){
//		if(this.open) {
			Cookie.set(this.element.getProperty('id'), this.open, this.options.cookie);
//		}
//		else {
//			Cookie.remove(this.element.getProperty('id'));
//		}
		this.element.setStyle('opacity', Math.round(this.element.getStyle('opacity')));
	},
	
	increase: function(){
		this.parent();
		this.element.setStyle('opacity', this.open ? ( 1 - this.delta ) : this.delta);
	}
	
});