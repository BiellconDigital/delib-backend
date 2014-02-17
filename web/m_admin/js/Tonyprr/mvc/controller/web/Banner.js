Ext.define('Tonyprr.mvc.controller.web.Banner', {
    extend	: 'Ext.app.Controller',
    stores	: [
                    'Tonyprr.abstract.Store','Tonyprr.mvc.store.web.Content','Tonyprr.mvc.store.web.ContentLanguage'
                    ,'Tonyprr.mvc.store.web.ContentCategoriaTree'
                    ,'Tonyprr.mvc.store.web.ContentGaleria','Tonyprr.mvc.store.web.ContentGaleriaLanguage'
                  ],
    models	: [
                    'Tonyprr.abstract.Model','Tonyprr.mvc.model.web.Content','Tonyprr.mvc.model.web.ContentLanguage'
                    ,'Tonyprr.mvc.model.web.ContentCategoria'
                    ,'Tonyprr.mvc.model.web.ContentGaleria','Tonyprr.mvc.model.web.ContentGaleriaLanguage'
                  ],

    views	: [
                    'Tonyprr.mvc.view.web.Banner'
                    ,'Tonyprr.mvc.view.web.BannerWin'
//                    ,'Tonyprr.mvc.view.web.ContentCategoriaTree'
                  ],
    refs: [
        {
            ref: 'listBanner',
            selector: 'panel[itemId="viewListBanner"]'
        }
        ,{
            ref: 'treeCateBanner',
            selector: 'treepanel[itemId="treeCateBanner"]'
        }
        ,{
            ref: 'panelRegBanner',
            selector: 'panel[itemId="viewRegBanner"]'
        }
        ,{
            ref: 'winBanner',
            selector: 'panel[itemId="winBanners"]'
        }
//        ,{
//            ref: 'cbotipoprod',
//            selector: 'combobox[itemId="cboTipoDestacWinDestac"]'
//        }
//        ,{
//            ref : 'viewgaleria',
//            selector : 'dataview[itemId="viewGaleBanner"]'
//        }
    ],
    init	: function(app) {
        this.callParent(null);
        this.control({
            'grid[itemId="gridBanner"]': {
                afterrender : this.onGridAfterRender
            }
            ,'grid[itemId="gridBanner"] button[text="Agregar Banner"]': {
                click : this.onClickAdd
            }

            ,'treepanel[itemId="treeCateBanner"]': {
                select : this.onSelectCategoria,
                afterrender : this.onTreeAfterRender
            }

            ,'panel[itemId="winBanners"]': {
                afterrender : this.onWinAfterRender
            }
            ,'panel[itemId="winBanners"] button[text="Guardar"]': {
                click : this.onClickSave
            }
            ,'panel[itemId="winBanners"] button[text="guardar idioma"]': {
                click : this.onClickSaveLanguage
            }
        });
    },
    
    initView: function(parent) {
        var viewBanner = Ext.widget('viewBanner'); 
        parent.add(viewBanner);
        viewBanner.setHeight(parent.getHeight());
    }
    
    ,onTreeAfterRender: function(grid, opts) {
//        storeTree = Ext.getCmp('idTreeCateBanner').getStore();
        var treep = Ext.ComponentQuery.query('treepanel[itemId="treeCateBanner"]')[0];
//        storeTree = treep.getStore();
//        storeTree = this.getTreeCateBanner().getStore();
        Ext.apply(treep.getStore().getProxy().extraParams, {padre : 9});
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
//        storeDestacs = this.getListBanner().getComponent(1).getStore();
        var gridp = Ext.ComponentQuery.query('grid[itemId="gridBanner"]')[0];
//        Ext.apply(storeDestacs.getProxy().extraParams, {idcontcate : idReg});
        Ext.apply(gridp.getStore().getProxy().extraParams, {idcontcate : idReg});
        gridp.getStore().load();
    }

    ,onClickAdd: function(button,e) {
        try {
            select = this.getListBanner().getComponent(0).getSelectionModel().getSelection();
            if (select == "") {
                return;
            }
            idCategoria = select[0].get('idcontcate');
            idDescCate = select[0].get('nameCate');

            this.getWinBanner().getComponent(0).getForm().reset();
            this.getWinBanner().getComponent(0).getForm().setValues({idcontcate: idCategoria, nameCate:idDescCate});
            
            this.getWinBanner().down(('form[itemId="formBannerLanguage"]')).getForm().reset();
            this.getWinBanner().down(('grid[itemId="gridBannerLanguage"]')).getStore().removeAll();
        } catch(Exception) {
            Tonyprr.core.Lib.exceptionAlert(Exception);
        }
    }
    
    ,onClickSave: function(button,e) {
        controller = this;
        if(this.getWinBanner().getComponent(0).getForm().isValid()) {
            this.getWinBanner().getComponent(0).getForm().submit({
                url : Tonyprr.BASE_URL + '/admin/web-content/save',
                waitMsg:'Guardando, espere por favor...',
                method:'POST',
                timeout: 900000,
                scope:this,
                success: function(request, action) {
                    try {
                        var json = Ext.JSON.decode(action.response.responseText);
                        if(json.success == 1) {
                            controller.getListBanner().getComponent(1).getStore().load();
                            formDestac = controller.getWinBanner().getComponent(0);
                            formDestac.getForm().setValues({idcontent:json.idcontent});
                            
                            storeLanguage = controller.getWinBanner().down('grid[itemId="gridBannerLanguage"]').getStore();
                            Ext.apply(storeLanguage.getProxy().extraParams, {idcontent : json.idcontent});
                            storeLanguage.load();
                            
                            storeGaleria = controller.getWinBanner().down('dataview[itemId="viewGaleBanner"]').getStore();
                            Ext.apply( storeGaleria.getProxy().extraParams, {idcontent: idReg} );
//                            storeGaleria.load();
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
        data = this.getWinBanner().getComponent(0).getForm().getValues();
        if (data.ididcontent == "") {
            return;
        }
        controller = this;
        var form = this.getWinBanner().getComponent(0).down('form').getForm();
        if (form.isValid()) {
            form.submit({
                clientValidation: true,
                params: {
                    idcontent: data.idcontent
                },
                success: function(form, action) {
                    Tonyprr.App.showNotification({message:action.result.msg});
                    controller.getWinBanner().down('grid[itemId="gridBannerLanguage"]').getStore().load();
                    controller.getListBanner().getComponent(1).getStore().load();
                }
                ,failure: function(form, action) {
                    Ext.Msg.alert('Fallido', action.result.msg);
                }
            });
        }
    }
});