Ext.define('Tonyprr.mvc.controller.web.Responsabilidad', {
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
                    'Tonyprr.mvc.view.web.Responsabilidad'
                    ,'Tonyprr.mvc.view.web.ResponsabilidadWin'
//                    ,'Tonyprr.mvc.view.web.ContentCategoriaTree'
                  ],
    refs: [
        {
            ref: 'listResponsabilidad',
            selector: 'panel[itemId="viewListResponsabilidad"]'
        }
        ,{
            ref: 'treeCateResponsabilidad',
            selector: 'treepanel[itemId="treeCateResponsabilidad"]'
        }
        ,{
            ref: 'panelRegResponsabilidad',
            selector: 'panel[itemId="viewRegResponsabilidad"]'
        }
        ,{
            ref: 'winResponsabilidad',
            selector: 'panel[itemId="winResponsabilidad"]'
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
            'grid[itemId="gridResponsabilidad"]': {
                afterrender : this.onGridAfterRender
            }
            ,'grid[itemId="gridResponsabilidad"] button[text="Agregar Responsabilidad"]': {
                click : this.onClickAdd
            }

            ,'treepanel[itemId="treeCateResponsabilidad"]': {
                select : this.onSelectCategoria,
                afterrender : this.onTreeAfterRender
            }

            ,'panel[itemId="winResponsabilidad"]': {
                afterrender : this.onWinAfterRender
            }
            ,'panel[itemId="winResponsabilidad"] button[text="Guardar"]': {
                click : this.onClickSave
            }
            ,'panel[itemId="winResponsabilidad"] button[text="guardar idioma"]': {
                click : this.onClickSaveLanguage
            }
        });
    },
    
    initView: function(parent) {
        var viewResponsabilidad = Ext.widget('viewResponsabilidad'); 
        parent.add(viewResponsabilidad);
        viewResponsabilidad.setHeight(parent.getHeight());
    }
    
    ,onTreeAfterRender: function(grid, opts) {
//        storeTree = Ext.getCmp('idTreeCateResponsabilidad').getStore();
        var treep = Ext.ComponentQuery.query('treepanel[itemId="treeCateResponsabilidad"]')[0];
//        storeTree = treep.getStore();
//        storeTree = this.getTreeCateResponsabilidad().getStore();
        Ext.apply(treep.getStore().getProxy().extraParams, {padre : 7});
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
//        storeDestacs = this.getListResponsabilidad().getComponent(1).getStore();
        var gridp = Ext.ComponentQuery.query('grid[itemId="gridResponsabilidad"]')[0];
//        Ext.apply(storeDestacs.getProxy().extraParams, {idcontcate : idReg});
        Ext.apply(gridp.getStore().getProxy().extraParams, {idcontcate : idReg});
        gridp.getStore().load();
    }

    ,onClickAdd: function(button,e) {
        try {
            select = this.getListResponsabilidad().getComponent(0).getSelectionModel().getSelection();
            if (select == "") {
                return;
            }
            idCategoria = select[0].get('idcontcate');
            idDescCate = select[0].get('nameCate');

            this.getWinResponsabilidad().getComponent(0).getForm().reset();
            this.getWinResponsabilidad().getComponent(0).getForm().setValues({idcontcate: idCategoria, nameCate:idDescCate});
            
            this.getWinResponsabilidad().down(('form[itemId="formResponsabilidadLanguage"]')).getForm().reset();
            this.getWinResponsabilidad().down(('grid[itemId="gridResponsabilidadLanguage"]')).getStore().removeAll();
        } catch(Exception) {
            Tonyprr.core.Lib.exceptionAlert(Exception);
        }
    }
    
    ,onClickSave: function(button,e) {
        controller = this;
        if(this.getWinResponsabilidad().getComponent(0).getForm().isValid()) {
            this.getWinResponsabilidad().getComponent(0).getForm().submit({
                url : Tonyprr.BASE_URL + '/admin/web-content/save',
                waitMsg:'Guardando, espere por favor...',
                method:'POST',
                timeout: 900000,
                scope:this,
                success: function(request, action) {
                    try {
                        var json = Ext.JSON.decode(action.response.responseText);
                        if(json.success == 1) {
                            controller.getListResponsabilidad().getComponent(1).getStore().load();
                            formDestac = controller.getWinResponsabilidad().getComponent(0);
                            formDestac.getForm().setValues({idcontent:json.idcontent});
                            
                            storeLanguage = controller.getWinResponsabilidad().down('grid[itemId="gridResponsabilidadLanguage"]').getStore();
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
        data = this.getWinResponsabilidad().getComponent(0).getForm().getValues();
        if (data.ididcontent == "") {
            return;
        }
        controller = this;
        var form = this.getWinResponsabilidad().getComponent(0).down('form').getForm();
        if (form.isValid()) {
            form.submit({
                clientValidation: true,
                params: {
                    idcontent: data.idcontent
                },
                success: function(form, action) {
                    Tonyprr.App.showNotification({message:action.result.msg});
                    controller.getWinResponsabilidad().down('grid[itemId="gridResponsabilidadLanguage"]').getStore().load();
                    controller.getListResponsabilidad().getComponent(1).getStore().load();
                }
                ,failure: function(form, action) {
                    Ext.Msg.alert('Fallido', action.result.msg);
                }
            });
        }
    }
});