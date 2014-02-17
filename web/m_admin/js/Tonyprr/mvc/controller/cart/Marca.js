Ext.define('Tonyprr.mvc.controller.cart.Marca', {
    extend	: 'Ext.app.Controller',
    stores	: [
                    'Tonyprr.abstract.Store','Tonyprr.mvc.store.cart.Marca'
                    ,'Tonyprr.mvc.store.cart.MarcaLanguage'
                   ],
    models	: ['Tonyprr.abstract.Model','Tonyprr.mvc.model.cart.Marca'
                    ,'Tonyprr.mvc.model.cart.MarcaLanguage'
                  ],

    views	: [
		'Tonyprr.mvc.view.cart.Marca'
    ],
    refs: [
//        {
//            ref: 'formMarca',
//            selector: 'form[id="formWidgetMarcaProd"]'
//        },
        {
            ref: 'gridMarca',
            selector: 'grid[id="gridWidgetMarcaProd"]'
        }
    ],
    init	: function(app) {
        this.callParent(null);
        this.control({
            'gridpanel[id="gridWidgetMarcaProd"]': {
                afterrender : this.onGridAfterRender
            }
            ,'grid[id="gridWidgetMarcaProd"] button[text="Nuevo"]': {
                click : this.onClickNew
            }
            
            ,'form[id="formWidgetMarcaProd"] button[text="Guardar"]': {
                click : this.onClickSave
            }
            ,'form[id="formWidgetMarcaProd"] button[text="guardar idioma"]': {
                click : this.onClickSaveLanguage
            }
             
        });
    },
    
    initView: function(parent) {
        var viewMarca = Ext.widget('viewMarca'); 
        parent.add(viewMarca);
        viewMarca.setHeight(parent.getHeight());
        
    },
    
    onGridAfterRender: function(grid,opts) {//grid,opts
        grid.getStore().load();
    }

    ,onClickNew: function(button,e) {
        try {
            Ext.getCmp('formWidgetMarcaProd').getForm().reset();
            Ext.getCmp('formWidgetMarcaProd').down(('form[itemId="formMarcaLanguage"]')).getForm().reset();
            Ext.getCmp('formWidgetMarcaProd').down(('grid[itemId="gridMarcaLanguage"]')).getStore().removeAll();
        } catch(Exception) {
//            Tonyprr.core.Lib.exceptionAlert(Exception);
        }
    }

    ,onClickSave: function(button,e) {
        controller = this;
        Ext.getCmp('formWidgetMarcaProd').getForm().submit({
            url : Tonyprr.BASE_URL + '/admin/cart-marca/save',
            waitMsg:'Guardando, espere por favor...',
            method:'POST',
            timeout: 900000,
            scope:this,
            success: function(request, action) {
                try{
                    var json = Ext.JSON.decode(action.response.responseText);
                    if(json.success == 1) {
                        controller.getGridMarca().getStore().load();
                        formProd = Ext.getCmp('formWidgetMarcaProd');
                        formProd.getForm().setValues({idmarca:json.idmarca});
                        
                        storeLanguage = Ext.getCmp('formWidgetMarcaProd').down('grid[itemId="gridMarcaLanguage"]').getStore();
                        Ext.apply(storeLanguage.getProxy().extraParams, {idmarca : json.idmarca});
                        storeLanguage.load();
                        
                    }
                    Tonyprr.App.showNotification({message:json.msg});
//                                    Ext.MessageBox.alert('Error ', json.msg);
                } catch(Exception) {
                    Tonyprr.core.Lib.exceptionAlert(Exception);
                }
            },
            failure: function(request, action) {
                Ext.MessageBox.alert('Error','Error en el servidor.');
            }
        });
    }
    ,onClickSaveLanguage: function(button,e) {
        data = Ext.getCmp('formWidgetMarcaProd').getForm().getValues();
        if (data.idmarca == "") {
            Tonyprr.App.showNotification({message: "Seleccione o guarde el registro primero."});
            return;
        }
        controller = this;
        var form = Ext.getCmp('formWidgetMarcaProd').down('form').getForm();
        if (form.isValid()) {
            form.submit({
                clientValidation: true,
                params: {
                    idmarca: data.idmarca
                },
                success: function(form, action) {
                    Tonyprr.App.showNotification({message:action.result.msg});
                    Ext.getCmp('formWidgetMarcaProd').down('grid[itemId="gridMarcaLanguage"]').getStore().load();
                    controller.getGridMarca().getStore().load();
                }
                ,failure: function(form, action) {
                    Ext.Msg.alert('Fallido', action.result.msg);
                }
            });
        }
    }
    
});