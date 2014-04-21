Ext.define('Tonyprr.mvc.controller.web.Contenido3', {
    extend	: 'Ext.app.Controller',
    stores	: [
                    'Tonyprr.abstract.Store','Tonyprr.mvc.store.web.Content','Tonyprr.mvc.store.web.ContentLanguage'
//                    ,'Tonyprr.mvc.store.web.ContentCategoriaTree'
                  ],
    models	: [
                    'Tonyprr.abstract.Model','Tonyprr.mvc.model.web.Content','Tonyprr.mvc.model.web.ContentLanguage'
//                    ,'Tonyprr.mvc.model.web.ContentCategoria'
                  ],

    views	: [
                    'Tonyprr.mvc.view.web.Contenido3'
                    ,'Tonyprr.mvc.view.web.Contenido3Win'
//                    ,'Tonyprr.mvc.view.web.ContentCategoriaTree'
                  ],
    refs: [
        {
            ref: 'listContenido3',
            selector: 'panel[itemId="viewListContenido3"]'
        }
        ,{
            ref: 'panelRegContenido3',
            selector: 'panel[itemId="viewRegContenido3"]'
        }
        ,{
            ref: 'winContenido3',
            selector: 'panel[itemId="winContenido3"]'
        }
    ],
    init	: function(app) {
        this.callParent(null);
        this.control({
            'grid[itemId="gridContenido3"]': {
                afterrender : this.onGridAfterRender
            }
            ,'grid[itemId="gridContenido3"] button[text="Agregar Noticia"]': {
                click : this.onClickAdd
            }

            ,'panel[itemId="winContenido3"]': {
                afterrender : this.onWinAfterRender
            }
            ,'panel[itemId="winContenido3"] button[text="Guardar"]': {
                click : this.onClickSave
            }
            ,'panel[itemId="winContenido3"] button[text="guardar idioma"]': {
                click : this.onClickSaveLanguage
            }
        });
    },
    
    initView: function(parent) {
        var viewContenido3 = Ext.widget('viewContenido3'); 
        parent.add(viewContenido3);
        viewContenido3.setHeight(parent.getHeight());
    }
    
    ,onGridAfterRender: function(grid, opts) {
//        if( Ext.isObject(this.getCbotipoprod()) ) this.getCbotipoprod().getStore().load();
    }
    ,onWinAfterRender: function(panel, opts) {
        var gridp = Ext.ComponentQuery.query('grid[itemId="gridContenido3"]')[0];
        Ext.apply(gridp.getStore().getProxy().extraParams, {idcontcate : 6});
        gridp.getStore().load();
    }

    ,onClickAdd: function(button,e) {
        try {
            idCategoria = 6;
            idDescCate = "Noticia";

            this.getWinContenido3().getComponent(0).getForm().reset();
            this.getWinContenido3().getComponent(0).getForm().setValues({idcontcate: idCategoria, nameCate:idDescCate});
            
            this.getWinContenido3().down(('form[itemId="formContenido3Language"]')).getForm().reset();
            this.getWinContenido3().down(('grid[itemId="gridContenido3Language"]')).getStore().removeAll();
        } catch(Exception) {
            Tonyprr.core.Lib.exceptionAlert(Exception);
        }
    }
    
    ,onClickSave: function(button,e) {
        controller = this;
        if(this.getWinContenido3().getComponent(0).getForm().isValid()) {
            this.getWinContenido3().getComponent(0).getForm().submit({
                url : Tonyprr.BASE_URL + '/admin/web-content/save',
                waitMsg:'Guardando, espere por favor...',
                method:'POST',
                timeout: 900000,
                scope:this,
                success: function(request, action) {
                    try {
                        var json = Ext.JSON.decode(action.response.responseText);
                        if(json.success == 1) {
                            controller.getListContenido3().getComponent(0).getStore().load();
                            formRepresen = controller.getWinContenido3().getComponent(0);
                            formRepresen.getForm().setValues({idcontent:json.idcontent});
                            
                            storeLanguage = controller.getWinContenido3().down('grid[itemId="gridContenido3Language"]').getStore();
                            Ext.apply(storeLanguage.getProxy().extraParams, {idcontent : json.idcontent});
                            storeLanguage.load();
                            
                        }
                        Tonyprr.App.showNotification({message:json.msg});
                    } catch(Exception) {
                        Tonyprr.core.Lib.exceptionAlert(Exception);
                    }
                },
                failure: function(request, action) {
                    Ext.MessageBox.alert('Error','Error en el servidor.');
                }
            });
        }
    }
    
    ,onClickSaveLanguage: function(button,e) {
        data = this.getWinContenido3().getComponent(0).getForm().getValues();
        if (data.ididcontent == "") {
            return;
        }
        controller = this;
        var form = this.getWinContenido3().getComponent(0).down('form').getForm();
        if (form.isValid()) {
            form.submit({
                clientValidation: true,
                params: {
                    idcontent: data.idcontent
                },
                success: function(form, action) {
                    Tonyprr.App.showNotification({message:action.result.msg});
                    controller.getWinContenido3().down('grid[itemId="gridContenido3Language"]').getStore().load();
                    controller.getListContenido3().getComponent(0).getStore().load();
                }
                ,failure: function(form, action) {
                    Ext.Msg.alert('Fallido', action.result.msg);
                }
            });
        }
    }
});