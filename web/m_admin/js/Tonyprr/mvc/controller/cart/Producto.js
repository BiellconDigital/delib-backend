Ext.define('Tonyprr.mvc.controller.cart.Producto', {
    extend	: 'Ext.app.Controller',
    stores	: [
                    'Tonyprr.abstract.Store','Tonyprr.mvc.store.cart.ProductoCategoriaTree',
                    'Tonyprr.mvc.store.cart.Producto','Tonyprr.mvc.store.cart.ProductoLanguage',
                    'Tonyprr.mvc.store.cart.ProductoCategoria'
                    
//                    ,'Tonyprr.mvc.store.cart.Marca'
                    ,'Tonyprr.mvc.store.cart.ProductoGaleria'
                    ,'Tonyprr.mvc.store.cart.ProductoGaleriaLanguage'
//                    ,'Tonyprr.mvc.store.cart.ProductoTipo'
                  ],
    models	: [
                    'Tonyprr.abstract.Model','Tonyprr.mvc.model.cart.ProductoCategoria',
                    'Tonyprr.mvc.model.cart.Producto','Tonyprr.mvc.model.cart.ProductoLanguage'
                    
//                    ,'Tonyprr.mvc.model.cart.Marca'
                    ,'Tonyprr.mvc.model.cart.ProductoGaleria'
                    ,'Tonyprr.mvc.model.cart.ProductoGaleriaLanguage'
//                    ,'Tonyprr.mvc.model.cart.ProductoTipo'
                  ],

    views	: [
                    'Tonyprr.mvc.view.cart.Producto'
                    ,'Tonyprr.mvc.view.cart.WinProducto'
//                    ,'Tonyprr.mvc.view.cart.ProductoCategoriaTree'
                  ],
    refs: [
        {
            ref: 'panelViewListProd',
            selector: 'panel[itemId="viewListProd"]'
        }
        ,{
            ref: 'listviewprod',
            selector: 'panel[itemId="viewRecordsProd"]'
        }
        ,{
            ref: 'winproducto',
            selector: 'panel[itemId="winProducto"]'
        }
//        ,{
//            ref: 'cbomarcaprod',
//            selector: 'combobox[itemId="cboMarcaProdWinProd"]'
//        }
//        ,{
//            ref: 'cbotipoprod',
//            selector: 'combobox[itemId="cboTipoProdWinProd"]'
//        }
//        ,{
//            ref : 'viewgaleria',
//            selector : 'dataview[itemId="viewGaleWidget"]'
//        }
    ],
    init	: function(app) {
        this.callParent(null);
        this.control({
            'grid[itemId="viewListProdWidget"]': {
                afterrender : this.onGridAfterRender
            }
            ,'grid[itemId="viewListProdWidget"] button[text="Agregar Producto"]': {
                click : this.onClickAddProd
            }

            ,'treepanel[itemId="viewCateProdProdTree"]': {
                select : this.onSelectCategoria
            }

            ,'panel[itemId="winProducto"]': {
                afterrender : this.onWinAfterRender
            }
            ,'panel[itemId="winProducto"] button[text="Guardar"]': {
                click : this.onClickSaveProd
            }
/*            ,'panel[itemId="winProducto"] button[text="guardar idioma"]': {
                click : this.onClickSaveLanguage
            }
*/        });
    },
    
    initView: function(parent) {
        var viewProducto = Ext.widget('viewProducto');
        parent.add(viewProducto);
        viewProducto.setHeight(parent.getHeight());
    }
    
    ,onGridAfterRender: function(grid, opts) {
//        if( Ext.isObject(this.getCbomarcaprod()) ) this.getCbomarcaprod().getStore().load();
//        if( Ext.isObject(this.getCbotipoprod()) ) this.getCbotipoprod().getStore().load();
    }
    ,onWinAfterRender: function(panel, opts) {
//        this.getCbomarcaprod().getStore().load();
    }

    ,onSelectCategoria: function(tree, model, index) {
        idReg = model.get('idcontcate');
        storeProds = this.getListviewprod().getComponent(1).getStore();
        Ext.apply(storeProds.getProxy().extraParams, {idcontcate : idReg});
        storeProds.load();
    }

    ,onClickAddProd: function(button,e) {
        try {
            select = this.getListviewprod().getComponent(0).getSelectionModel().getSelection();
            if (select == "") {
                return;
            }
            idCategoria = select[0].get('idcontcate');
            idDescCate = select[0].get('nameCate');

            this.getWinproducto().getComponent(0).getForm().reset();
            this.getWinproducto().getComponent(0).getForm().setValues({idcontcate: idCategoria, nameCate:idDescCate});
            
            //this.getWinproducto().down(('form[itemId="formProdLanguage"]')).getForm().reset();
//            this.getWinproducto().down(('grid[itemId="gridProdLanguage"]')).getStore().removeAll();
        } catch(Exception) {
            Tonyprr.core.Lib.exceptionAlert(Exception);
        }
    }
    
    ,onClickSaveProd: function(button,e) {
        controller = this;
        if(this.getWinproducto().getComponent(0).getForm().isValid()) {
            this.getWinproducto().getComponent(0).getForm().submit({
                url : Tonyprr.BASE_URL + '/admin/cart-producto/save',
                waitMsg:'Guardando, espere por favor...',
                method:'POST',
                timeout: 900000,
                scope:this,
                success: function(request, action) {
                    try {
                        var json = Ext.JSON.decode(action.response.responseText);
                        if(json.success == 1) {
                            controller.getListviewprod().getComponent(1).getStore().load();
                            formProd = controller.getWinproducto().getComponent(0);
                            formProd.getForm().setValues({idproducto:json.idproducto});
                            
                            // storeLanguage = controller.getWinproducto().down('grid[itemId="gridProdLanguage"]').getStore();
                            // Ext.apply(storeLanguage.getProxy().extraParams, {idproducto : json.idproducto});
                            // storeLanguage.load();
                            
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
        data = this.getWinproducto().getComponent(0).getForm().getValues();
        if (data.ididproducto == "") {
            return;
        }
        controller = this;
        var form = this.getWinproducto().getComponent(0).down('form').getForm();
        if (form.isValid()) {
            form.submit({
                clientValidation: true,
                params: {
                    idproducto: data.idproducto
                },
                success: function(form, action) {
                    Tonyprr.App.showNotification({message:action.result.msg});
//                    controller.getWinproducto().down('grid[itemId="gridProdLanguage"]').getStore().load();
                    controller.getListviewprod().getComponent(1).getStore().load();
                }
                ,failure: function(form, action) {
                    Ext.Msg.alert('Fallido', action.result.msg);
                }
            });
        }
    }
});