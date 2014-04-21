Ext.define('Tonyprr.mvc.controller.cart.ProductoCategoria', {
    extend	: 'Ext.app.Controller',
    stores	: [
                    'Tonyprr.mvc.store.cart.ProductoCategoriaTree'
                    ,'Tonyprr.abstract.Store','Tonyprr.mvc.store.cart.ProductoCategoriaLanguage'
//                    ,'Tonyprr.mvc.store.cart.ProductoCategoriaTipo'
//                    ,'Tonyprr.mvc.store.cart.ProductoTipo'
//                    'Tonyprr.abstract.Store','Tonyprr.mvc.store.cart.Producto','Tonyprr.mvc.store.cart.ProductoCategoria',
//                    'Tonyprr.mvc.store.cart.ProductoMarca'
                  ],
    models	: [
                    'Tonyprr.abstract.Model','Tonyprr.mvc.model.cart.ProductoCategoria'
                    ,'Tonyprr.mvc.model.cart.ProductoCategoriaLanguage'
//                    ,'Tonyprr.mvc.model.cart.ProductoCategoriaTipo'
//                    ,'Tonyprr.mvc.model.cart.ProductoTipo'
//                    'Tonyprr.mvc.model.cart.Producto','Tonyprr.mvc.model.cart.ProductoCategoria',
//                    'Tonyprr.mvc.model.cart.ProductoMarca'
                  ],

    views	: [
                    'Tonyprr.mvc.view.cart.ProductoCategoria','Tonyprr.mvc.view.cart.ProductoCategoriaForm'
//                    ,'Tonyprr.mvc.view.cart.ProductoCategoriaTree'
                  ],
    refs: [
        {
            ref: 'formservprod',
            selector: 'form[itemId="productoCategoriaForm"]'//widget.viewProductoCategoriaForm
        },
        {
            ref: 'treeservprod',
            selector: 'treepanel[itemId="viewCateProdTree"]'
        }
//        ,{
//            ref: 'cboTipoProdCate',
//            selector: 'combobox[id="cboTipoProdCate"]'
//        }
    ],
    init	: function(app) {
        this.callParent(null);
        this.control({
            'form[itemId="productoCategoriaForm"]': {
                afterrender : this.onFormAfterRender
            }
            ,'menu[itemId="menuContextProdCate"] [text="Agregar Sub-Categoria"]': {
                click : this.onClickAdd
            }
            ,'menu[itemId="menuContextProdCate"] [text="Editar"]': {
                click : this.onClickEdit
            }
            ,'menu[itemId="menuContextProdCate"] [text="Eliminar"]': {
                click : this.onClickDeleteCate
            }
            ,'form[itemId="productoCategoriaForm"] button[text="Guardar"]': {
                click : this.onClickSave
            }
            ,'form[itemId="productoCategoriaForm"] button[text="guardar idioma"]': {
                click : this.onClickSaveLanguage
            }
            ,'treepanel[itemId="viewCateProdTree"] button[text="Agregar Categoria"]': {
                click : this.onClickAddRoot
            }
            ,'treepanel[itemId="viewCateProdTree"] button[text="Actualizar"]': {
                click : this.onClickUpdate
            }
        });
    },
    
    initView: function(parent) {
        var viewProductoCategoria = Ext.widget('viewProductoCategoria'); 
        parent.add(viewProductoCategoria);
        viewProductoCategoria.setHeight(parent.getHeight());
    },
    
    onFormAfterRender: function(tree,opts) {
    },
    onClickAdd: function(button, e) {
        nodeSel = this.getTreeservprod().getSelectionModel().getSelection();
        if(nodeSel.length == 0 || nodeSel[0].get('nivelCate')>1 ) return;
        
        this.getFormservprod().newUIForm(nodeSel[0].get('idcontcate'),  nodeSel[0].get('nameCate'),  nodeSel[0].get('nivelCate')+1);
    },
    onClickEdit: function(button,e) {
        controller = this;
        nodeSel = this.getTreeservprod().getSelectionModel().getSelection();
        if(nodeSel.length == 0) return;
        idReg = nodeSel[0].get('idcontcate');
        this.getFormservprod().loadUIForm(idReg);
        // storeLanguage = this.getFormservprod().down('grid[itemId="gridProdCateLanguage"]').getStore();
        // Ext.apply(storeLanguage.getProxy().extraParams, {idcontcate : idReg});
        // storeLanguage.load();
        
//        storeCateTipos = this.getFormservprod().down('grid[itemId="gridProdCateTipo"]').getStore();
//        Ext.apply(storeCateTipos.getProxy().extraParams, {idcontcate : idReg});
//        storeCateTipos.load({callback : function() {
//        }});
    },
    onClickDeleteCate: function(button, e) {
        controller = this;
        nodeSel = this.getTreeservprod().getSelectionModel().getSelection();
        Ext.MessageBox.confirm('Eliminar', 'Esta seguro que desea eliminar esta Categoria? Se eliminaran todas las sub-categorias hijas y sus productos', 
             function (btn) {
                if (btn == 'yes')
                    Tonyprr.Ajax.request({
                        url     : Tonyprr.BASE_URL + '/admin/cart-producto-categoria/delete',
                        params	: nodeSel[0].data,
                        el	: this.el,
                        scope	: this,
                        success	: function(data,response) {
                            Tonyprr.App.showNotification({message:data.msg});
                            if(data.success==1) {
                                controller.loadTreeStore();
                            }
                        },
                        failure : function(data,response) {
                            Tonyprr.App.showNotification({message:data.msg});
                        }
                    });
        });
        
//        nodeSel = this.getTreeservprod().getSelectionModel().getSelection();
//        if(nodeSel.length == 0 || nodeSel[0].get('nivelCate')>1 ) return;
//        this.getFormservprod().newUIForm(nodeSel[0].get('idcontcate'),  nodeSel[0].get('nameCate'),  nodeSel[0].get('nivelCate')+1);
    },
    onClickUpdate: function(button,e) {
        this.loadTreeStore();    
    }
    ,onClickSave: function(button,e) {
        controller = this;
        this.getFormservprod().saveUIForm(function(request, action) {
                try {
                    var json = Ext.JSON.decode(action.response.responseText);
                    if(json.success == 1) {
                        controller.getFormservprod().getForm().setValues({idcontcate:json.idcontcate});
                        // storeLanguage = controller.getFormservprod().down('grid[itemId="gridProdCateLanguage"]').getStore();
                        // Ext.apply(storeLanguage.getProxy().extraParams, {idcontcate : json.idcontcate});
                        // storeLanguage.load();
                        
                        controller.loadTreeStore();
                    }
                    Tonyprr.App.showNotification({message:json.msg});
                } catch(Exception) {
                    Tonyprr.core.Lib.exceptionAlert(Exception);
                }
        });
    }
    ,onClickSaveLanguage: function(button,e) {
        data = this.getFormservprod().getForm().getValues();
        if (data.idcontcate == "") {
            return;
        }
        controller = this;
        var form = this.getFormservprod().down('form').getForm();//down('form').
        if (form.isValid()) {
            form.submit({
                clientValidation: true,
                params: {
                    idcontcate: data.idcontcate
                },
                success: function(form, action) {
                    Tonyprr.App.showNotification({message:action.result.msg});
                    controller.getFormservprod().down('grid[itemId="gridProdCateLanguage"]').getStore().load();
//                    this.getTreeservprod().getStore().load();
                    controller.loadTreeStore();
                }
                ,failure: function(form, action) {
                    Ext.Msg.alert('Fallido', action.result.msg);
                }
            });
        }
    }
    ,loadTreeStore: function() {
//        var treep = Ext.ComponentQuery.query('treepanel[itemId="viewCateProdTree"]')[0];
//        Ext.apply(treep.getStore().getProxy().extraParams, {tipo : 1});
//        treep.getStore().load();
//        Ext.apply(this.getTreeservprod().getStore().getProxy().extraParams, {tipo : 1});
//        this.getTreeservprod().getStore().load();
        
        try {
            Ext.apply(this.getTreeservprod().getStore().getProxy().extraParams, {tipo : 1});
            this.getTreeservprod().getStore().load();
        } catch (Exception) {
            try {
                Ext.apply(this.getTreeservprod().getStore().getProxy().extraParams, {tipo : 1});
                this.getTreeservprod().getStore().load();
            } catch (Exception) {
                try {
                    Ext.apply(this.getTreeservprod().getStore().getProxy().extraParams, {tipo : 1});
                    this.getTreeservprod().getStore().load();
                } catch (Exception) {
                    try {
                        Ext.apply(this.getTreeservprod().getStore().getProxy().extraParams, {tipo : 1});
                        this.getTreeservprod().getStore().load();
                    } catch (Exception) {
                        try {
                            Ext.apply(this.getTreeservprod().getStore().getProxy().extraParams, {tipo : 1});
                            this.getTreeservprod().getStore().load();
                        } catch (Exception) {
                            try {
                                Ext.apply(this.getTreeservprod().getStore().getProxy().extraParams, {tipo : 1});
                                this.getTreeservprod().getStore().load();
                            } catch (Exception) {
                                try {
                                    Ext.apply(this.getTreeservprod().getStore().getProxy().extraParams, {tipo : 1});
                                    this.getTreeservprod().getStore().load();
                                } catch (Exception) {
                                    Ext.apply(this.getTreeservprod().getStore().getProxy().extraParams, {tipo : 1});
                                    this.getTreeservprod().getStore().load();
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    ,onClickAddRoot: function(button,e) {
        this.getFormservprod().newUIForm(1, "categoria raiz", 1);
    }
    
});