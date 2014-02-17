Ext.define('Tonyprr.mvc.controller.web.Contenido2', {
    extend	: 'Ext.app.Controller',
    stores	: [
                    'Tonyprr.abstract.Store','Tonyprr.mvc.store.web.Content','Tonyprr.mvc.store.web.ContentLanguage'
                    ,'Tonyprr.mvc.store.web.ContentCategoriaTree'
                  ],
    models	: [
                    'Tonyprr.abstract.Model','Tonyprr.mvc.model.web.Content','Tonyprr.mvc.model.web.ContentLanguage'
                    ,'Tonyprr.mvc.model.web.ContentCategoria'
                  ],

    views	: [
                    'Tonyprr.mvc.view.web.Contenido2'
                    ,'Tonyprr.mvc.view.web.Contenido2Win'
//                    ,'Tonyprr.mvc.view.web.ContentCategoriaTree'
                  ],
    refs: [
        {
            ref: 'listContenido2',
            selector: 'panel[itemId="viewListContenido2"]'
        }
        ,{
            ref: 'treeCateContenido2',
            selector: 'treepanel[itemId="treeCateContenido2"]'
        }
        ,{
            ref: 'panelRegContenido2',
            selector: 'panel[itemId="viewRegContenido2"]'
        }
        ,{
            ref: 'winContenido2',
            selector: 'panel[itemId="winContenido2s"]'
        }
//        ,{
//            ref: 'cbotipoprod',
//            selector: 'combobox[itemId="cboTipoDestacWinDestac"]'
//        }
//        ,{
//            ref : 'viewgaleria',
//            selector : 'dataview[itemId="viewGaleWidget"]'
//        }
    ],
    init	: function(app) {
        this.callParent(null);
        this.control({
            'grid[itemId="gridContenido2"]': {
                afterrender : this.onGridAfterRender
            }
            ,'grid[itemId="gridContenido2"] button[text="Agregar Mind Break"]': {
                click : this.onClickAdd
            }

            ,'treepanel[itemId="treeCateContenido2"]': {
                select : this.onSelectCategoria,
                afterrender : this.onTreeAfterRender
            }

            ,'panel[itemId="winContenido2s"]': {
                afterrender : this.onWinAfterRender
            }
            ,'panel[itemId="winContenido2s"] button[text="Guardar"]': {
                click : this.onClickSave
            }
            ,'panel[itemId="winContenido2s"] button[text="guardar idioma"]': {
                click : this.onClickSaveLanguage
            }
        });
    },
    
    initView: function(parent) {
        var viewContenido2 = Ext.widget('viewContenido2'); 
        parent.add(viewContenido2);
        viewContenido2.setHeight(parent.getHeight());
    }
    
    ,onTreeAfterRender: function(grid, opts) {
//        storeTree = Ext.getCmp('idTreeCateContenido2').getStore();
        var treep = Ext.ComponentQuery.query('treepanel[itemId="treeCateContenido2"]')[0];
//        storeTree = treep.getStore();
//        storeTree = this.getTreeCateContenido2().getStore();
        Ext.apply(treep.getStore().getProxy().extraParams, {padre : 3});
        treep.getStore().load();
//        this.loadTreeStore(treep.getStore());
    }
    ,onGridAfterRender: function(grid, opts) {
//        if( Ext.isObject(this.getCbotipoprod()) ) this.getCbotipoprod().getStore().load();
    }
    ,onWinAfterRender: function(panel, opts) {
//        this.getCbomarcaprod().getStore().load();
    }

    ,onSelectCategoria: function(tree, model, index) {
        idReg = model.get('idcontcate');
//        storeDestacs = this.getListContenido2().getComponent(1).getStore();
        var gridp = Ext.ComponentQuery.query('grid[itemId="gridContenido2"]')[0];
//        Ext.apply(storeDestacs.getProxy().extraParams, {idcontcate : idReg});
        Ext.apply(gridp.getStore().getProxy().extraParams, {idcontcate : idReg});
        gridp.getStore().load();
    }

    ,onClickAdd: function(button,e) {
        try {
            select = this.getListContenido2().getComponent(0).getSelectionModel().getSelection();
            if (select == "") {
                return;
            }
            idCategoria = select[0].get('idcontcate');
            idDescCate = select[0].get('nameCate');

            this.getWinContenido2().getComponent(0).getForm().reset();
            this.getWinContenido2().getComponent(0).getForm().setValues({idcontcate: idCategoria, nameCate:idDescCate});
            
            this.getWinContenido2().down(('form[itemId="formContenido2Language"]')).getForm().reset();
            this.getWinContenido2().down(('grid[itemId="gridContenido2Language"]')).getStore().removeAll();
        } catch(Exception) {
            Tonyprr.core.Lib.exceptionAlert(Exception);
        }
    }
    
    ,onClickSave: function(button,e) {
        controller = this;
        if(this.getWinContenido2().getComponent(0).getForm().isValid()) {
            this.getWinContenido2().getComponent(0).getForm().submit({
                url : Tonyprr.BASE_URL + '/admin/web-content/save',
                waitMsg:'Guardando, espere por favor...',
                method:'POST',
                timeout: 900000,
                scope:this,
                success: function(request, action) {
                    try {
                        var json = Ext.JSON.decode(action.response.responseText);
                        if(json.success == 1) {
                            controller.getListContenido2().getComponent(1).getStore().load();
                            formDestac = controller.getWinContenido2().getComponent(0);
                            formDestac.getForm().setValues({idcontent:json.idcontent});
                            
                            storeLanguage = controller.getWinContenido2().down('grid[itemId="gridContenido2Language"]').getStore();
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
        data = this.getWinContenido2().getComponent(0).getForm().getValues();
        if (data.ididcontent == "") {
            return;
        }
        controller = this;
        var form = this.getWinContenido2().getComponent(0).down('form').getForm();
        if (form.isValid()) {
            form.submit({
                clientValidation: true,
                params: {
                    idcontent: data.idcontent
                },
                success: function(form, action) {
                    Tonyprr.App.showNotification({message:action.result.msg});
                    controller.getWinContenido2().down('grid[itemId="gridContenido2Language"]').getStore().load();
                    controller.getListContenido2().getComponent(1).getStore().load();
                }
                ,failure: function(form, action) {
                    Ext.Msg.alert('Fallido', action.result.msg);
                }
            });
        }
    }
});