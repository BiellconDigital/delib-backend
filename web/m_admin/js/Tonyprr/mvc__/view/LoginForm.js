Ext.define('Tonyprr.mvc.view.LoginForm', {
	extend 			: "Tonyprr.abstract.Form",
	alias			: "Tonyprr.Login",
	forward			: true,

	initComponent	: function() {
		this.items = this.createLoginFields();
		this.fbar = this.createButtons();
		this.callParent();
	},
	
	createButtons		: function(){
            return [{
			text	: "Acceder",
			scope	: this,
			handler	: this.login
		}
            ];
	},
	
	createLoginFields	: function(){
            return [
                {
                xtype	: "panel",
                layout	: "hbox",
                border:false,
                items:[
                    {
			xtype	: "panel",
                        width: 200,
                        height: 150,
                        border:false,
                        html: '<img src="'+Tonyprr.Constants.LOGIN_IMAGE+'" height=130>'
                    },
                    {
			xtype	: "panel",
                        width: 250,
                        border:false,
                        items : [
                            {
                                xtype	: "fieldset",
                                title   : "Credenciales de Acceso",
                                layout	: "auto",
                                margin :6,
                                defaultType : "textfield",
                                items	: [
                                    {
                                        labelAlign	: "top",
                                        msgTarget	: 'side',
                                        fieldLabel	: "Usuario",
                                        name		: "username",
                                        allowBlank	: false,
                                        flex		: 1,
                                        margins		: {right:3}
                                    },{
                                        labelAlign	: "top",
                                        msgTarget	: 'side',
                                        inputType	: 'password',
                                        fieldLabel	: 'Clave',
                                        name		: 'password',
                                        allowBlank	: false,
                                        flex		: 1,
                                        margins		: {left:3},
                                        listeners	: {
                                                scope		: this,
                                                specialkey	: function(f,e){
                                                        if (e.getKey() == e.ENTER) {
                                                                this.login();
                                                        }
                                                }
                                        }
                                    }
                                ]
                        },
                        {
                            xtype: 'displayfield',
                            width : 210,
                            margin :5,
                            name: 'reset-pass',
                            html: '<a id="link_sendp" href="#">¿Olvido su contrase&ntilde;a?</a>'
                        }
                        ]
                    }
                ]
            }
        ];
	},
	
	login		: function(){
		if(this.getForm().isValid()){
			var values = this.getForm().getValues();
			Tonyprr.Ajax.request({
				url		: Tonyprr.Constants.LOGIN_URL,
				params	: values,
				el		: this.up("panel").el,
				scope	: this,
				success	: this.onSuccess,
				failure	: this.onFailure
			});
		}
	},
	
	onSuccess	: function(data,response){
		if(data.success){
                    var passwrd = this.down("textfield[name=password]");
                    if(this.forward && data.resp==1) {
                            document.location = Tonyprr.Constants.HOME_URL;
                    } else {
                        Ext.create("Ext.tip.ToolTip",{
                                anchor		: "left",
                                target		: passwrd.bodyEl,
                                trackMouse	: false,
                                html		: data.msg,
                                autoShow	: true
                        });
                    }
			
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