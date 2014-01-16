Ext.define('Tonyprr.mvc.view.WinReset', {
	extend 			: "Ext.window.Window",
        alias                   : 'widget.winReset',
        title   : "Cambiar Clave e E-mail",
        height: 150,
        width: 400,
        layout: 'fit',
        modal : true,
        closable : false,
                frame : false,
//	forward			: true,

	initComponent	: function() {
		this.items = this.createForm();
		this.buttons = this.createButtons();
		this.callParent();
	},
	
	createButtons		: function(){
            return [
                {
			text	: "Cambiar",
			scope	: this,
			handler	: this.change
		},
                {
			text	: "Cerrar",
			scope	: this,
			handler	: function() { this.destroy(); }
		}
            ];
	},
	
	createForm	: function(){
            return [
                {
                xtype	: "form",
                frame : true,
                border:false,
//                layout	: "auto",
                margin :5,
                defaultType : "textfield",
                items:[
                    {
                        labelAlign	: "left",
                        msgTarget	: 'side',
                        fieldLabel	: "E-mail",
                        name		: "e-mail",
                        anchor          : '95%',
                        vtype           : 'email',
                        flex		: 1,
                        margins		: {right:3}
                    },{
                        labelAlign	: "left",
                        msgTarget	: 'side',
                        inputType	: 'password',
                        fieldLabel	: 'Clave',
                        name		: 'password',
                        anchor          : '95%',
                        allowBlank	: false,
                        flex		: 1,
                        margins		: {left:3},
                        listeners	: {
                                scope		: this,
                                specialkey	: function(f,e){
                                        if (e.getKey() == e.ENTER) {
                                                this.change();
                                        }
                                }
                        }
                    }
                ]
            }            
            ];
	},
	
	change : function() {
		if(this.getComponent(0).getForm().isValid()) {
			var values = this.getComponent(0).getForm().getValues();
			Tonyprr.Ajax.request({
				url		: Tonyprr.BASE_PATH + '/admin/user/change',
				params	: values,
				el		: this.el,
				scope	: this,
				success	: this.onSuccess,
				failure	: this.onFailure
			});
		}
	},
	
	onSuccess : function(data,response) {
            if(data.success) {
                Tonyprr.App.showNotification({message:data.msg});
                this.destroy();
            }
	},
	
	onFailure	: function(data,response){
		var passwrd = this.down("textfield[name=password]");
		Ext.create("Ext.tip.ToolTip",{
			anchor		: "left",
			target		: passwrd.bodyEl,
			trackMouse	: false,
			html		: data.message,
			autoShow	: true
		});
		//passwrd.markInvalid(data.message);
	}
});