Ext.define("Tonyprr.mvc.view.cart.ProductoCategoria", {
    extend : "Ext.panel.Panel",
    alias : 'widget.viewProductoCategoria',
    minHeight: 200,
    autoWidth : true,
    border : false,
    layout : 'border',
    itemId:'viewCrudUIProdCate',
    baseCls : 'x-plain',
    frame : false,
    autoScroll : true,
    items : [
        {
            region : 'west',
            xtype: 'panel',
            title: 'Categoria de Productos',
            itemId:'viewListProdCate',
            collapsible : true,
            width : 370,
            split:true,
            minSize: 150,
            maxSize: 300,
            border : false,
            frame : false,
            layout: 'fit'
        },
        {
            region : 'center',
            xtype: 'panel',
            autoWidth : true,
            autoHeight: true,
            itemId:'viewFormProdCate',
            autoScroll:true,
            border : false,
            frame : false
//            items : []
        }
    ],
    initComponent : function() {
        this.callParent(arguments);
        meProds = this;

    var deleteProdCateAction = Ext.create('Ext.Action', {
        iconCls: 'cancel',
        text: 'Eliminar',
        disabled: true
    });

    var editarProdCateAction = Ext.create('Ext.Action', {
        iconCls: 'form_edit',
        text: 'Editar',
        disabled: true
    });

    var agregarProdCateAction = Ext.create('Ext.Action', {
        iconCls: 'add',
        text: 'Agregar Sub-Categoria',
        disabled: true
    });

    var contextMenuProd = Ext.create('Ext.menu.Menu', {
        itemId:'menuContextProdCate',
        items: [
            deleteProdCateAction,
            editarProdCateAction,
            agregarProdCateAction
        ]
    });

        var storeProductoCategoriaTree = Ext.create('Tonyprr.mvc.store.cart.ProductoCategoriaTree');
        var gridTreeProdCate = Ext.create("Ext.tree.Panel", {
            alias : 'widget.viewCateProdTree',
//            id : 'idCateProdTree',
            itemId:'viewCateProdTree',
            autoWidth: true,
            autoHeight: true,
            useArrows: true,
            rootVisible: false,
            store: storeProductoCategoriaTree,//'Tonyprr.mvc.store.cart.ProductoCategoriaTree',
            multiSelect: false,
            singleExpand: false,
            viewConfig: {
                stripeRows: true,
                listeners: {
                    itemcontextmenu: function(view, rec, node, index, e) {
                        e.stopEvent();
                        contextMenuProd.showAt(e.getXY());
                        return false;
                    }
                }
            },
            columns: [{
                xtype: 'treecolumn',
                text: 'Categoria',
                flex: 1,
                dataIndex: 'nameCate'
            },{
                text: 'ID',
                dataIndex: 'idcontcate',
                hidden: true
            },{
                text: 'nivel',
                dataIndex: 'nivelCate',
                hidden: true
            },{
                text: 'Estado',
                dataIndex: 'stateCate',
                sorteable: false,
                align : 'center',
                width: 50,
                renderer: Tonyprr.core.Lib.checkRender
            }
            ],
            dockedItems : [{
                xtype: 'toolbar',
                dock: 'top',
                items: [
                    '-',
                    {
                        text:'Agregar Categoria',
                        iconCls : 'add'
                    },'-',
//                    {
//                        text:'Agregar Sub-Categoria'
//                    },'-',
//                    {
//                        text:'Editar',
//                        iconCls : 'form_edit'
//                    },'-',
                    {
                        text:'Actualizar',
                        iconCls : 'refresh_small'
                    },'-'
                ]
            }]
        });
        
        gridTreeProdCate.getSelectionModel().on({
            selectionchange: function(sm, selections) {
                if (selections.length) {
                    deleteProdCateAction.enable();
                    editarProdCateAction.enable();
                    agregarProdCateAction.enable();
                } else {
                    deleteProdCateAction.disable();
                    editarProdCateAction.disable();
                    agregarProdCateAction.disable();
                }
            }
        });
        
//        Ext.create('Tonyprr.mvc.view.cart.ProductoCategoriaTree',{id : 'idCateProdTree', store: Ext.data.StoreManager.lookup('CateProdStoreTree')});
        meProds.getComponent('viewListProdCate').add(gridTreeProdCate);
        formTree =  Ext.create('Tonyprr.mvc.view.cart.ProductoCategoriaForm');//,{id: 'idCateProdForm'}
        meProds.getComponent('viewFormProdCate').add(formTree);
        delete gridTreeProdCate;
        delete formTree;
    }
});