Ext.Loader.setConfig({
    enabled : true,
    paths   : {
        Tonyprr : Tonyprr.Constants.JS_PATH+"/Tonyprr"
//        Ext     : Tonyprr.mvc.lib.Constants.JS_PATH+"Ext"
    } 
});

//Ext.require("Tonyprr.abstract.MessageBox");
//Ext.require("Tonyprr.desktop.Application");
Ext.require("Tonyprr.mvc.view.LoginForm");

Ext.onReady(function(){
//alert(Tonyprr.Constants.JS_PATH);

	Tonyprr.AppLogin = Ext.create("Ext.Panel",{
		name		: "Tonyprr.AppLogin",
                title   : 'Acceso al Sistema',
                renderTo: 'panelPrinLogin',
                height : 220,
                width  : 480,
                items:[
                    Ext.create("Tonyprr.mvc.view.LoginForm",{})
                ],
                listeners : {
                    afterrender : function() {
                        Ext.get('link_sendp').on('click', function(e) {
                            Ext.create('Ext.window.Window', {
                                title   : "Enviar clave",
                                height: 150,
                                width: 400,
                                layout: 'fit',
//                                modal : true,
//                                closable : false,
                                items : [
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
                                                fieldLabel	: "Validar E-mail",
                                                name		: "e-mail",
                                                allowBlank	: false,
                                                vtype           : 'email',
                                                anchor          : '95%'
                                            }, {
                                                labelAlign	: "left",
                                                msgTarget	: 'side',
                                                fieldLabel	: 'Validar Usuario',
                                                name		: 'user',
                                                anchor          : '95%',
                                                allowBlank	: false,
                                                listeners	: {
                                                        scope		: this,
                                                        specialkey	: function(f,e) {
                                                                if (e.getKey() == e.ENTER) {
                                                                        this.change();
                                                                }
                                                        }
                                                }
                                            }
                                        ]
                                    }            
                                ],
                                buttons :[
                                    {
                                            text	: "Enviar",
//                                            scope	: this,
                                            handler	: function () {
                                                if(this.up('window').getComponent(0).getForm().isValid()) {
                                                        var values = this.up('window').getComponent(0).getForm().getValues();
                                                        Tonyprr.Ajax.request({
                                                                url		: Tonyprr.BASE_URL + '/admin/login/change',
                                                                params	: values,
                                                                el		: this.up('window').el,
                                                                scope	: this,
                                                                success	: function(data,response) {
                                                                    if(data.resp==1) {
                                                                        this.up('window').destroy();
                                                                        Ext.MessageBox.alert('Mensaje',data.msg);
                                                                    } else {
                                                                        textf= (data.num==1)?"e-mail":"user";
                                                                        var fieldF = this.up('window').down("textfield[name="+textf+"]");
                                                                        Ext.create("Ext.tip.ToolTip", {
                                                                                anchor		: "left",
                                                                                target		: fieldF.bodyEl,
                                                                                trackMouse	: false,
                                                                                html		: data.msg,
                                                                                autoShow	: true
                                                                        });
                                                                    }
                                                                },
                                                                failure	: function(data,response) {
                                                                        var fieldF = this.up('window').down("textfield[name=user]");
                                                                        Ext.create("Ext.tip.ToolTip",{
                                                                                anchor		: "left",
                                                                                target		: fieldF.bodyEl,
                                                                                trackMouse	: false,
                                                                                html		: data.message,
                                                                                autoShow	: true
                                                                        });
                                                                }
                                                        });
                                                }
                                            }
                                    }
                                ]
                            }).show();
                            
                        });
                    }
                }
//		listeners : {
//                    ready : function(){
//                        setTimeout(function(){
//                            Ext.get("loading").remove();
//                            Ext.get("loading-mask").fadeOut({remove:true});
//                        },250);
//                    }
//		}
	});
	
});
