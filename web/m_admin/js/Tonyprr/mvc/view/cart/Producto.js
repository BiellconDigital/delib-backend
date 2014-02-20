Ext.define("Tonyprr.mvc.view.cart.Producto", {
    extend : "Ext.panel.Panel",
    alias : 'widget.viewProducto',
    minHeight: 200,
    autoWidth : true,
    border : false,
    layout : 'border',
    itemId:'viewCrudUIProd',
    baseCls : 'x-plain',
    frame : false,
    autoScroll : true,
    items : [
        {
            region : 'west',
            xtype: 'panel',
            title: 'Lista de Productos',
            itemId:'viewRecordsProd',
            width : 310,
            border : true,
            frame : false
        },
        {
            region : 'center',
            xtype: 'panel',
            autoWidth : true,
            autoHeight: true,
            itemId:'viewListProd',
            autoScroll:true,
            border : true,
            frame : false
        }
    ],
    initComponent : function() {
        this.callParent(arguments);
        meProd = this;
        
        var storeCateProdProdTree = Ext.create('Tonyprr.mvc.store.cart.ProductoCategoriaTree');
        gridTreeProd = Ext.create("Ext.tree.Panel", {
            alias : 'widget.viewCateProdProdTree',
//            id : 'idCateProdProdTree',
            itemId:'viewCateProdProdTree',
            autoWidth: true,
            height: 150,
            autoScroll: true,
            useArrows: true,
            rootVisible: false,
            store: storeCateProdProdTree,//'Tonyprr.mvc.store.cart.ProductoCategoriaTree',
            multiSelect: false,
            singleExpand: false,
            columns: [
                {
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
            ]
//            ,dockedItems : [{
//                xtype: 'toolbar',
//                dock: 'top',
//                items: [
//                    '-',
//                    {
//                        text:'Agregar Nuevo',
//                        iconCls : 'add'
//                    },'-'
//                ]
//            }]
        });
        
        
        var storeProducto = Ext.create('Tonyprr.mvc.store.cart.Producto');
        panelView = Ext.create("Ext.grid.Panel", {
            frame:true,
            itemId:'viewListProdWidget',
            columnLines : true,
            autoScroll:true,
            store: storeProducto,
            border:false,
            dockedItems : [{
                xtype: 'toolbar',
                dock: 'top',
                items: [
                    '-',
                    {
                        text:'Agregar Producto',
                        iconCls: 'add'
                    },'-'
                ]
            }],            
            columns : [
                {
                    xtype:'actioncolumn', 
                    width:40,
                    items: [{
                        icon: Tonyprr.Constants.IMAGE_EDIT,
                        tooltip: 'Editar el Registro',
                        handler: function(grid, rowIndex, colIndex) {
//                            meProd.getComponent('viewListProd').expand(true);
//                            meProd.down('grid[itemId="viewListProdWidget"]').toggleCollapse();
                            meProd.down('panel[itemId="winProducto"]').getComponent(0).loadRecord(grid.getStore().getAt(rowIndex));
                            meProd.down('panel[itemId="winProducto"]').getComponent(0).getForm().setValues({borrarAdj: 0});
                            
                            idReg = grid.getStore().getAt(rowIndex).get('idproducto');
                            // storeLanguage = grid.up('panel[itemId="viewCrudUIProd"]').down('grid[itemId="gridProdLanguage"]').getStore();
                            // Ext.apply(storeLanguage.getProxy().extraParams, {idproducto: idReg});
                            // storeLanguage.load();

                            meProd.down('panel[itemId="panelGaleWidget"]').getComponent(0).getForm().reset();
                            meProd.down('grid[itemId="gridProdGaleriaLanguage"]').getStore().removeAll();
                            
                            storeGaleria = meProd.down('dataview[itemId="viewGaleWidget"]').getStore();
                            Ext.apply( storeGaleria.getProxy().extraParams, {idproducto: idReg} );
                            storeGaleria.load();
                            

//                            storeGaleria = meProd.down('dataview[itemId="viewGaleWidget"]').getStore();
//                            Ext.apply( storeGaleria.getProxy().extraParams, {idproducto: idReg} );
//                            storeGaleria.load();
                        }
                    },{
                        icon: Tonyprr.Constants.IMAGE_CROSS,
                        tooltip: 'Eliminar el Registro',
                        handler: function(grid, rowIndex, colIndex) {
                            Ext.MessageBox.confirm('Eliminar Producto', 'Esta seguro que desea eliminar este producto?', 
                                 function (btn) {
                                    if (btn == 'yes')
                                        Tonyprr.Ajax.request({
                                            url     : Tonyprr.BASE_URL + '/admin/cart-producto/delete',
                                            params	: grid.getStore().getAt(rowIndex).data,
                                            el	: this.el,
                                            scope	: this,
                                            success	: function(data,response) {
                                                Tonyprr.App.showNotification({message:data.msg});
                                                if(data.success==1) {
                                                    grid.getStore().load();
                                                }
                                            },
                                            failure : function(data,response) {
                                                Tonyprr.App.showNotification({message:data.msg});
                                            }
                                        });
                                });
                        }                
                    }]
                },
                {dataIndex: 'idproducto',header : 'ID',width:26, sortable : true},
                {dataIndex: 'nombre_producto',header : 'Nombre',width: 335,sortable : true},
//                {dataIndex: 'precio',header : 'Precio',width: 70,sortable : true},
//                {dataIndex: 'cantidad',header : 'Stock',width: 70,sortable : true},
//                {dataIndex: 'cantidadVendidos',header : 'Vendidos',width: 70,sortable : true},
                {dataIndex: 'orden',header : 'Orden',width: 60,sortable : true},
                {dataIndex: 'estado',header : 'Estado',width: 50,sortable : true,renderer: Tonyprr.core.Lib.checkRender}
//                {dataIndex: 'fecharegConte',header : 'Fecha Ini.',width: 70,sortable : false,
//                    xtype: 'datecolumn',format:'d-m-Y'}
            ],
            plugins : [
                {
                    ptype: 'rowexpander',
                    rowBodyTpl : [
                        '<div style = "width:340px;">',
                        '<p><b>Fecha Registro: </b>{fechareg:date("d-m-Y H:i:s")}<br/><b>Fecha Última Modificaci&oacute;n: </b>{fechamodf:date("d-m-Y H:i:s")}</p>',
                        '<p><b>Adjunto: </b><a href="'+Tonyprr.Constants.FILES_DATA_CART+'/producto/{adjunto}" target="_blank">{adjunto}</a></p>',
                        '<p><img src="'+Tonyprr.Constants.FILES_DATA_CART+'/producto/{imagen}" width="130" style="float:left;margin-right:5px;"/>{intro_producto}</p>',
                        '</div>'
                    ]
                }
            ],
            bbar : Ext.create('Ext.toolbar.Paging', {
                itemId:'gridPagingWidgetProd',
                pageSize: 15,
                store: storeProducto,
                displayInfo: true
            })
        });
        
        panelForm = Ext.create('Tonyprr.mvc.view.cart.WinProducto');
        meProd.getComponent('viewRecordsProd').add(gridTreeProd);
        meProd.getComponent('viewRecordsProd').add(panelView);
        meProd.getComponent('viewListProd').add(panelForm);

        delete panelView;
        delete gridTreeProd;
        delete panelForm;
        
    }
});
