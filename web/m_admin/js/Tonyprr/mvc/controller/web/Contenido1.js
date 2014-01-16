Ext.define('Tonyprr.mvc.controller.web.Contenido1', {
    extend	: 'Ext.app.Controller',
    stores	: [
                    'Tonyprr.abstract.Store','Tonyprr.mvc.store.web.Content','Tonyprr.mvc.store.web.ContentLanguage'
                    ,'Tonyprr.mvc.store.web.ContentCategoriaTree','Tonyprr.mvc.store.web.ContentGaleriaLanguage',
                    'Tonyprr.mvc.store.web.ContentGaleria'
                  ],
    models	: [
                    'Tonyprr.abstract.Model','Tonyprr.mvc.model.web.Content','Tonyprr.mvc.model.web.ContentLanguage'
                    ,'Tonyprr.mvc.model.web.ContentCategoria','Tonyprr.mvc.model.web.ContentGaleriaLanguage'
                    ,'Tonyprr.mvc.model.web.ContentGaleria'
                  ],

    views	: [
                    'Tonyprr.mvc.view.web.Contenido1'
                    ,'Tonyprr.mvc.view.web.WinContenido1'
//                    ,'Tonyprr.mvc.view.web.ContentCategoriaTree'
                  ],
    refs: [
        {
            ref: 'listContenido1',
            selector: 'panel[itemId="viewListContenido1"]'
        }
        ,{
            ref: 'treeCateContenido1',
            selector: 'treepanel[itemId="treeCateContenido1"]'
        }
        ,{
            ref: 'panelRegContenido1',
            selector: 'panel[itemId="viewRegContenido1"]'
        }
        ,{
            ref: 'winContenido1',
            selector: 'panel[itemId="winContenido1"]'
        }
    ],
    init	: function(app) {
        this.callParent(null);
        this.control({
            'grid[itemId="gridContenido1"]': {
                afterrender : this.onGridAfterRender
            }
            ,'grid[itemId="gridContenido1"] button[text="Agregar Proyecto"]': {
                click : this.onClickAdd
            }

            ,'treepanel[itemId="treeCateContenido1"]': {
                select : this.onSelectCategoria,
                afterrender : this.onTreeAfterRender
            }

            ,'panel[itemId="winContenido1"]': {
                afterrender : this.onWinAfterRender
            }
            ,'panel[itemId="winContenido1"] button[text="Guardar"]': {
                click : this.onClickSave
            }
            ,'panel[itemId="winContenido1"] button[text="guardar idioma"]': {
                click : this.onClickSaveLanguage
            }
        });
    },
    
    initView: function(parent) {
        var viewContenido1 = Ext.widget('viewContenido1'); 
        parent.add(viewContenido1);
        viewContenido1.setHeight(parent.getHeight());
    }
    
    ,onTreeAfterRender: function(grid, opts) {
        storeTree = this.getListContenido1().getComponent(0).getStore();
        Ext.apply(storeTree.getProxy().extraParams, {padre : 5});
        storeTree.load();
    }
    ,onGridAfterRender: function(grid, opts) {
//        if( Ext.isObject(this.getCbotipoprod()) ) this.getCbotipoprod().getStore().load();
    }
    ,onWinAfterRender: function(panel, opts) {
//        this.getCbomarcaprod().getStore().load();
    }

    ,onSelectCategoria: function(tree, model, index) {
        idReg = model.get('idcontcate');
        storeContenido1 = this.getListContenido1().getComponent(1).getStore();
        Ext.apply(storeContenido1.getProxy().extraParams, {idcontcate : idReg});
        storeContenido1.load();
    }

    ,onClickAdd: function(button,e) {
        try {
            select = this.getListContenido1().getComponent(0).getSelectionModel().getSelection();
            if (select == "") {
                return;
            }
            idCategoria = select[0].get('idcontcate');
            idDescCate = select[0].get('nameCate');

            this.getWinContenido1().getComponent(0).getForm().reset();
            this.getWinContenido1().getComponent(0).getForm().setValues({idcontcate: idCategoria, nameCate:idDescCate});
            
            this.getWinContenido1().down(('form[itemId="formContenido1Language"]')).getForm().reset();
            this.getWinContenido1().down(('grid[itemId="gridContenido1Language"]')).getStore().removeAll();
        } catch(Exception) {
            Tonyprr.core.Lib.exceptionAlert(Exception);
        }
    }
    
    ,onClickSave: function(button,e) {
        controller = this;
        if(this.getWinContenido1().getComponent(0).getForm().isValid()) {
            this.getWinContenido1().getComponent(0).getForm().submit({
                url : Tonyprr.BASE_URL + '/admin/web-content/save',
                waitMsg:'Guardando, espere por favor...',
                method:'POST',
                timeout: 900000,
                scope:this,
                success: function(request, action) {
                    try {
                        var json = Ext.JSON.decode(action.response.responseText);
                        if(json.success == 1) {
                            controller.getListContenido1().getComponent(1).getStore().load();
                            formProd = controller.getWinContenido1().getComponent(0);
                            formProd.getForm().setValues({idcontent:json.idcontent});
                            
                            storeLanguage = controller.getWinContenido1().down('grid[itemId="gridContenido1Language"]').getStore();
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
        data = this.getWinContenido1().getComponent(0).getForm().getValues();
        if (data.ididcontent == "") {
            return;
        }
        controller = this;
        var form = this.getWinContenido1().getComponent(0).down('form').getForm();
        if (form.isValid()) {
            form.submit({
                clientValidation: true,
                params: {
                    idcontent: data.idcontent
                },
                success: function(form, action) {
                    Tonyprr.App.showNotification({message:action.result.msg});
                    controller.getWinContenido1().down('grid[itemId="gridContenido1Language"]').getStore().load();
                    controller.getListContenido1().getComponent(1).getStore().load();
                }
                ,failure: function(form, action) {
                    Ext.Msg.alert('Fallido', action.result.msg);
                }
            });
        }
    }
});