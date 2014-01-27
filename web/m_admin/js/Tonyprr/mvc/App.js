/**
 * @class Tonyprr.mvc.App
 * @extends Ext.app.Application
 * requires Tonyprr.core.Notification
 * @autor Antonio Ramos
 * @date 
 * @version 1.5
 * La Clase Aplicación que arranca el sistema
 *
 *
 **/

Ext.define("Tonyprr.mvc.App",{
	extend 		: "Ext.app.Application",
	mixins		: {
            observable	: "Ext.util.Observable"
	},
	requires	: [
		"Tonyprr.core.Message"
	],
        controllers: [
            'Tonyprr.mvc.controller.Init'
        ],
	useQuickTips: true,
//        appFolder : 'Tonyprr.mvc',
//        name: 'Tonyprr.App',
        launch: function() {
        }
        
	,constructor	: function() {
		var me = this;
                me.listController = [];
		
		me.addEvents({
			"ready"	: true
		});

		me.callParent(arguments);
		
		Tonyprr.Ajax.request({
			url		: Tonyprr.Constants.SYSTEM_CONFIGURATION_URL,
			scope	: this,
			success	: this.buildSystem,
			failure	: this.onError
		});

	},
        addListController : function(item) {
            Ext.Array.include(this.listController,item);
        },
        existItemListController : function(item) {
            return Ext.Array.contains(this.listController,item);
        },
	
	buildSystem	: function(data) {
            var me = this;
            if (me.useQuickTips) {
                Ext.QuickTips.init();
            }
            // Add the additional 'advanced' VTypes
            Ext.apply(Ext.form.field.VTypes, {
                daterange: function(val, field) {
                    var date = field.parseDate(val);

                    if (!date) {
                        return false;
                    }
                    if (field.startDateField && (!this.dateRangeMax || (date.getTime() != this.dateRangeMax.getTime()))) {
                        var start = field.up('form').down('#' + field.startDateField);
                        start.setMaxValue(date);
                        start.validate();
                        this.dateRangeMax = date;
                    }
                    else if (field.endDateField && (!this.dateRangeMin || (date.getTime() != this.dateRangeMin.getTime()))) {
                        var end = field.up('form').down('#' + field.endDateField);
                        end.setMinValue(date);
                        end.validate();
                        this.dateRangeMin = date;
                    }
                    return true;
                },

                daterangeText: 'Start date must be less than end date'
            });

            
            me.userConfig = data;
            me.tabsPrinAdmin = new Ext.TabPanel({
                region: 'center',
                margins:'0 0 0 0',
                activeTab: 0,
                autoDestroy: true,
                layoutOnTabChange : false,
                enableTabScroll: true,
                autoScroll:true,
                items: [
                    {
                        title: 'Home',
                        id : 'tab_inicio_sys',
                        iconCls: 'house',
                        closable: false,
                        autoScroll: true
//                        autoLoad: {url: url_app+'academico/Extjs/panel/', method:'POST', scripts: true, scope: this}
                    }
                ]
            });

            me.LogoutButton  =  Ext.create("Ext.Button",{
                    renderTo:'btnSalir',
                    text: 'salir',
                    handler: function(btn,e) {
                        btn.exitSystem(true);
//                        Ext.MessageBox.confirm('Confirmar', '¿Desea Ud. salir del Sistema?', function(btn) {
//                            alert(btn);
//                            if(btn=="yes"){alert("cc"); me.LogoutButton.exitSystem(true);}
//                        }); 
                    },
                    iconCls:'desconectar',
                    logOut: function() {
                            Ext.MessageBox.confirm('Confirmar', '¿Desea Ud. salir del Sistema?', this.showResult,this);
                    },
                    showResult: function(btn){
                        if(btn=="yes"){
                            this.exitSystem(true);
                        }
                    },
                    exitSystem: function(autoRedirect) {
//                        var redirect = this.idsBtnLogout.UrlRedirect;
                        Ext.MessageBox.show({title: 'Cerrar sesion', msg: 'Espere un momento por favor...',width:220,closable:false,icon:Ext.MessageBox.INFO});
                        Ext.Ajax.request({
                            url : Tonyprr.BASE_URL+'/admin/login/logout/',
                            method: 'POST',
                            success: function(result,request) {
                                    //cerrarTabs();
                                    if(autoRedirect)
                                        window.location = Tonyprr.Constants.HOME_URL;
                                    else {
                                        Ext.MessageBox.hide();
                                        Ext.Msg.alert('Mensaje','Sesión finalizada, ingrese nuevamente.', function(){
                                            window.location = Tonyprr.Constants.HOME_URL;
                                        });
                                    }
                            },
                            failure: function(result,request){
                                    Ext.MessageBox.hide();
                                    Ext.utiles.msg('Error', 'Problemas durante el proceso, intente nuevamente...');
                            }
                        });
                    }
            });

            me.ResetButton  =  Ext.create("Ext.Button", {
                    renderTo:'btnReset',
                    text: 'Cambiar Clave',
                    handler: function(btn) {
                        vtnReset = Ext.widget('winReset');
                        vtnReset.animateTarget=btn.getEl();vtnReset.show();
                    },
                    iconCls:'key_small'
            });

            me.treeMenu = Ext.create('Ext.tree.Panel', {
                title: 'Gestión Web',
                rootVisible: false,
                collapsed : true,
//                lines: true,
//                autoScroll: true,
//                bodyStyle:'',
//                animate:true,
                root: 
                    {
                        text: 'root',
                        expanded: true,
                        children: [
                            {
                                text: 'Gestión de Usuarios',
                                expanded: true,
                                children: [
                                    {
                                        text: 'Clientes',
                                        leaf: true
                                    }
                                ]
                                
                            }
                        ]
                    },
                    listeners: {
                        itemclick: {
                            fn: function(view,record,item,index) {
                                switch (record.get('text')) {
                                    case 'Clientes' : me.agregarTab('Clientes', 'tabm_cliente', '', true,'Cliente', 'web');
                                    break;
                                }
                            }
                        }
                    }
            });
            
            me.treeMenuCarrito = Ext.create('Ext.tree.Panel', {
                title: 'Productos',
                rootVisible: false,
                collapsed : false,
                root: 
                    {
                        text: 'root',
                        expanded: true,
                        children: [
                            {
                                text: 'Productos',
                                expanded: true,
                                children: [
                                    {
                                        text: 'Marcas de Productos',
                                        leaf: true
                                    }
                                    ,{
                                        text: 'Categorias de Productos',
                                        leaf: true
                                    }
                                    ,{
                                        text: 'Registro de Productos',
                                        leaf: true
                                    }
//                                    ,{
//                                        text: 'Comentarios',
//                                        leaf: true
//                                    }
                                ]
                                
                            }
                            ,{
                                text: 'Movimiento de Productos',
                                expanded: true,
                                children: [
                                    {
                                        text: 'Pedidos',
                                        leaf: true
                                    }
                                    ,{
                                        text: 'Movimiento de Stock',
                                        leaf: true
                                    }
                                ]
                                
                            }
                            
                        ]
                    }
                    ,listeners: {
                        itemclick: {
                            fn: function(view,record,item,index) {
                                switch (record.get('text')) {
                                    case 'Marcas de Productos' : me.agregarTab('Marcas', 'tabm_marca', '', true, 'Marca', 'cart');
                                    break;
                                    case 'Categorias de Productos' : me.agregarTab('Categoria de Productos', 'tabm_productoCategoria', '', true,'ProductoCategoria', 'cart');
                                    break;
                                    case 'Registro de Productos' : me.agregarTab('Productos', 'tabm_producto', '', true,'Producto', 'cart');
                                    break;
                                    case 'Pedidos': me.agregarTab('Pedidos', 'tabm_pedidos', '', true, 'Orden', 'cart');
                                    break;
                                    case 'Movimiento de Stock': me.agregarTab('Movimiento de Stock', 'tabm_movStock', '', true, 'MovimientoStock', 'cart');
                                    break;
                                }
                            }
                        }
                    }
            });
            
            
            me.Viewport = new Ext.container.Viewport({
                layout: 'border',
                items: [
                    {
                        region:'north',
                        contentEl:'north',
                        //baseCls: 'x-plain',
                        plain: true,
                        height:55,
                        autoWidth: true,
                        margins:'0 1 0 1'
                    },
                    {
                        region:'west',
                        title:'Menú del Sistema',
                        split:true,
                        width: 220,
                        minSize: 150,
                        maxSize: 300,
                        collapsible: true,
                        margins:'0 0 0 3',
                        layout:'accordion',
                        bodyStyle:'font-size: 13px;',
                        layoutConfig:{
                            animate:true
                        },
                        items: [
                            me.treeMenu,
                            me.treeMenuCarrito
                        ]
                    },
                    me.tabsPrinAdmin
                ]
            });            

            Ext.EventManager.on(window, "beforeunload", me.onUnload, me);
            me.fireEvent("ready", me);
            this.showNotification({message:'Bienvenidos al Sistema'});
            
	},
	
	/**
	 * Execute an application
	 * @param {Ext.menu.Item} item The item licked in the menu
	 */
	runApplication	: function(item) {
            var app = item.initialConfig;
	},
	
	/**
	 * This function allow you to display notifications in the desktop
	 * @param {Object} config The message to show
	 */
	showNotification: function(data){
		Ext.create("Tonyprr.core.Message",{
			data	: data
		});
	},
	
	/**
	 * This function show the login form in the desktop
	 * @param {Object} config The message to show
	 */
	showLoginWindow	: function(data){
		Ext.require("Tonyprr.modules.login.LoginWindow",function(){
			var win = Ext.create("Tonyprr.modules.login.LoginWindow",{
				modal	: true,
				forward	: false
			});
			win.show();
		});
	},
	
	onError	: function(data){
            Ext.Msg.alert("Error!","Sorry but there was an error loading the initial configuration.");
	},
        
	onUnload : function(e) {
            if (this.fireEvent('beforeunload', this) === false) {
                e.stopEvent();
            }
        },
        
        agregarTab : function(titulo,nombreTab,parametros,scroll,controller,module) {
            var me = this;
            if(me.maxTabs()) {
                Ext.MessageBox.alert('Alerta', 'Solamente puede tener abiertas cinco pesta�as, por favor cierre una para poder acceder a otra.');
                return;
            }
//            if(parametros == '') parametros= new Object();
//            parametros['url']=url_tab;parametros['idTab']=nombreTab;
            if (titulo==null)
                titulo=nombreTab;
            var open = me.tabsPrinAdmin.child('#'+nombreTab);
            if(open == null) {
                var tab = Ext.create('Ext.panel.Panel',{
                    id: nombreTab,
                    title: titulo,
                    layout:'fit',
                    autoScroll: scroll,
                    iconCls: 'tabs',
                    closable: true,
//                    autoLoad: {url: url_tab,method:'POST',params:parametros,scripts: true, scope: this,callback: function(){
//                    }},
                    listeners:{
                        afterrender : function () {
                            me.loadAppController(controller, Ext.getCmp(nombreTab), module);
                        }
                        ,beforedestroy: function(comp){
                            try {
                                comp.removeAll();
//                            Ext.destroy(Ext.getCmp('idController_'+controller));
                            } catch(Exception) {
//                                Tonyprr.core.Lib.exceptionAlert(Exception);
                            }
                        }
                    }
                });
                me.tabsPrinAdmin.add(tab);
                tab.show();
                return;//nombreTab
            }
            tab=me.tabsPrinAdmin.child('#'+nombreTab);
            tab.show();
//            me.iniViewController(this);
            return;//nombreTab
        },
        
        maxTabs : function(){
            var me = this;
            if(me.tabsPrinAdmin.items.getCount() >= 6) return true;
            else return false;
        },

        cerrarTabs : function(){
            var me = this;
            me.tabsPrinAdmin.items.each(function(tab){
                if(tab.id!='tab_inicio_sys')
                    me.tabsPrinAdmin.remove(tab);
            });
        },
        
        getLogoutButton : function() {
            return this.LogoutButton;
        },
        
        loadAppController : function (controllerName, parent, module) {
            if( !this.existItemListController('Tonyprr.mvc.controller.' + module + '.'+controllerName) ) {
//                var controllerLoad = Ext.create( 'Tonyprr.modules.admin.controller.'+controllerName ,{
//                    id : 'idController_'+controllerName
//                });

                var controllerLoad = this.getController( 'Tonyprr.mvc.controller.' + module + '.'+controllerName );
                controllerLoad.init(this.name);
                this.addListController('Tonyprr.mvc.controller.' + module + '.'+controllerName);
                this.iniViewController(controllerName, parent, module);
            } else {
                this.iniViewController(controllerName, parent, module);
            }
        },
        
        iniViewController : function (controllerName, parent, module) {
            this.getController( 'Tonyprr.mvc.controller.' + module + '.'+controllerName ).initView(parent);
        }
        
});

