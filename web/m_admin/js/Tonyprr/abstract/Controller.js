/*
 * Aun no se implementa y no se utiliza en el proyecto
 */
Ext.define("Tonyprr.abstract.Controller",{
	extend		: "Ext.app.Controller",
	init	: function(app) {
            var me = this,
            actions = {};
            me.control();
	},
	control		: function(actions){
		if(Ext.isObject(actions)){
//			Ext.Object.each(actions,function(selector){
//				obj["#"+this.win.id+" "+selector] = actions[selector];
//			},this);
//			delete actions;
			this.callParent(actions);
		}else{
			this.callParent(arguments);
		}
	}
	
});