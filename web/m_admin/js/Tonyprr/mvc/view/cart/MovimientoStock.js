Ext.define("Tonyprr.mvc.view.cart.MovimientoStock", {
    extend : "Ext.panel.Panel",
    alias : 'widget.viewMovimientoStock',
    minHeight: 200,
    autoWidth : true,
    border : false,
    layout : 'border',
    itemId:'viewCrudUIMovimientoStock',
    baseCls : 'x-plain',
    frame : false,
    autoScroll : true,
    items : [
        {
            region : 'center',
            xtype: 'panel',
            itemId:'viewListMovimientoStock',
            border : false,
            frame : false
        },
        {
            region : 'east',
            xtype: 'panel',
            title:'Registro de Movimiento de Stock',
            minSize: 150,
            maxSize: 800,
            collapsible : true,
            collapsed : true,
            split:true,
            width : 600,
            itemId:'viewFormMovimientoStock',
            autoScroll:true,
            border : true,
            frame : false
        }
    ],
    loadUIForm : function(record){
            this.getComponent('viewFormMovimientoStock').getComponent('formWidgetMovimientoStock').loadRecord(record);
            
//            Ext.getCmp('comboUbigeoNacPers').doQuery(Ext.getCmp('comboUbigeoNacPers').getValue(),true);
//            delayVar.delay(2200,function(){Ext.getCmp('comboUbigeoNacPers').setValue(Ext.getCmp('comboUbigeoNacPers').getValue());});
            
    },
    initComponent : function() {
        this.callParent(arguments);
        
        meMovimientoStock = this;
        
        var storeMovimientoStock = Ext.create('Tonyprr.mvc.store.cart.MovimientoStock',{storeId: 'storeMovimientoStock'});
        meMovimientoStock.gridUI = Ext.create("Ext.grid.Panel", {
            itemId:'gridWidgetMovimientoStock',
            frame:true,
            columnLines : true,
            autoScroll:true,
            store: storeMovimientoStock,
            border:false,
            tbar : [
                '-',
                {
                    text:'Nuevo',iconCls:'add',
                    listeners : {
                        click: function() {
                            meMovimientoStock.getComponent('viewFormMovimientoStock').getComponent('formWidgetMovimientoStock').getForm().reset();
                            meMovimientoStock.getComponent('viewFormMovimientoStock').expand(true);
                        }
                    }
                },
                 '-'
            ],
            columns : [
                {dataIndex: 'idMovimientoStock',header : 'ID',width:26, sortable : false},
                {dataIndex: 'cantidad',header : 'Cantidad',width: 80,sortable : false},
                {dataIndex: 'idMovimientoStockTipo',header : 'ID Tipo Moov',hidden : true},
                {dataIndex: 'movTipo_nombre',header : 'Tipo Movimiento',width: 170,sortable : false},
                {dataIndex: 'signo',header : 'Nombre',width: 90, hidden : true},
                {dataIndex: 'idproducto',header : 'ID Producto',width: 70,hidden : true},
                {dataIndex: 'producto_nombre',header : 'Producto',width: 275,sortable : true},
                {dataIndex: 'idOrden',header : 'Pedido',width: 80,sortable : false},
//                {dataIndex: 'iduser',header : 'Usuario',width: 100,sortable : false},
                {dataIndex: 'fechaIngreso',header : 'Fecha Ingreso',width: 100,xtype: 'datecolumn',format:'d-m-Y'},
//                {dataIndex: 'fechaCaducidad',header : 'Fecha de Caducidad',width: 106,xtype: 'datecolumn',format:'d-m-Y'},
                {dataIndex: 'fechaRegistro',header : 'Fecha Registro',width: 100,xtype: 'datecolumn',format:'d-m-Y H:i:s'}
            ],
            bbar : Ext.create('Ext.toolbar.Paging', {
                pageSize: 15,
                store: storeMovimientoStock,
                displayInfo: true
            })
        });
        meMovimientoStock.getComponent('viewListMovimientoStock').add(meMovimientoStock.gridUI);
        
        
        meMovimientoStock.formUI = Ext.create("Tonyprr.abstract.Form", {
            itemId:'formWidgetMovimientoStock',
            width:570,
            margin:'0 23 12 1',
            frame: true,
            waitMsgTarget: true,
            items : [
                {
                    xtype: 'hidden',
                    name:'idMovimientoStock'
                },
                {
                    xtype :'numberfield',
                    fieldLabel:'Cantidad',
                    anchor : '40%',
                    name:'cantidad',
                    allowBlank:false 
                },
                {
                    xtype: 'combobox',
                    fieldLabel:'Tipo Movimiento',
                    itemId: 'cboMovimientoStockTipo',
                    name:'idMovimientoStockTipo',
                    typeAhead: true,
                    anchor:'95%',
                    store: 'Tonyprr.mvc.store.cart.MovimientoStockTipo',
                    queryMode: 'local',
                    displayField: 'nombre',
                    valueField: 'idMovimientoStockTipo',
                    allowBlank:false
                }
                ,{
                    xtype: 'combobox',
                    itemId:'cboMovimientoStockProducto',
                    store: 'Tonyprr.mvc.store.cart.Producto',
                    fieldLabel:'Producto',
                    mode: 'remote',
                    anchor:'95%',
                    triggerAction: 'all',
                    loadingText: 'Cargando lista...',
                    listConfig: {
                        loadingText: 'buscando...',
                        emptyText: 'No se encontró resultados.',
                        getInnerTpl: function() {
                            return '{nombre_producto} ({codigoProducto})'
                        }
                    },
                    name: 'idproducto',
                    displayField: 'nombre_producto',
                    valueField: 'idproducto',
                    minChars:2,
                    pageSize:10,
                    listClass: 'x-combo-list-small'
                }
                ,{
                    xtype :'datefield',
                    fieldLabel:'Fecha Ingreso',
                    anchor:'45%',
                    format : 'd-m-Y',
                    name:'fechaIngreso',
                    allowBlank:false
                }
                // ,{
                //     xtype :'datefield',
                //     fieldLabel:'Fecha de Caducidad',
                //     anchor:'45%',
                //     format : 'd-m-Y',
                //     name:'fechaCaducidad',
                //     allowBlank:false
                // }
                
            ]
            ,
            buttonsAlign:'right',
            buttons : [
                {
                    text:'Guardar',iconCls:'save',
                    formBind: true,
                    scope: this,
                    handler: function (btn,e) {
                        meMovimientoStock.getComponent('viewFormMovimientoStock').getComponent('formWidgetMovimientoStock').getForm().submit({
                            url : Tonyprr.BASE_URL + '/admin/cart-movimiento-stock/save',
                            waitMsg:'Guardando, espere por favor...',
                            method:'POST',
                            timeout: 90000,
                            scope:this,
                            success: function(request, action) {
                                try{
                                    var json = Ext.JSON.decode(action.response.responseText);
                                    if(json.success == 1) {
                                        meMovimientoStock.getComponent('viewListMovimientoStock').getComponent('gridWidgetMovimientoStock').getStore().load();
                                        formProd = meMovimientoStock.getComponent('viewFormMovimientoStock').getComponent('formWidgetMovimientoStock');
                                        formProd.getForm().reset();
                                        //formProd.getForm().setValues({idMovimientoStock:json.idMovimientoStock});
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
                ,{
                    text:'Mostrar Lista',iconCls:'grid',
                    scope: this,
                    handler: function (btn,e) {
                        this.getComponent('viewFormMovimientoStock').collapse(Ext.Component.DIRECTION_RIGHT, true);
                    }
                }
            ]
        });
        meMovimientoStock.getComponent('viewFormMovimientoStock').add(meMovimientoStock.formUI);
        delete meMovimientoStock.gridUI;
        delete meMovimientoStock.formUI;
    }
});
