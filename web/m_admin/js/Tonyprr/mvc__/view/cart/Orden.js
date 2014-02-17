Ext.define("Tonyprr.mvc.view.cart.Orden", {
    extend : "Ext.panel.Panel",
    alias : 'widget.viewOrden',
    minHeight: 200,
    autoWidth : true,
    border : false,
    layout : 'border',
    itemId:'viewCrudUIOrden',
    baseCls : 'x-plain',
    frame : false,
    autoScroll : true,
    items : [
        {
            region : 'center',
            xtype: 'panel',
            itemId:'viewListOrden',
//            layout : 'fit',
//            autoWidth : true,
//            anchor : '100%',
            border : false,
            frame : false
        },
        {
            region : 'east',
            xtype: 'panel',
            title:'Registro de Pedido',
            minSize: 150,
            maxSize: 800,
            collapsible : true,
            collapsed : true,
            split:true,
            width : 650,
            itemId:'viewFormOrden',
            autoScroll:true,
            border : true,
            frame : false
        }
    ],
    loadUIForm : function(record){
            this.getComponent('viewFormOrden').getComponent('formWidgetOrden').loadRecord(record);
            this.getComponent('viewFormOrden').expand(true);
    },
    initComponent : function() {
        this.callParent(arguments);
        meOrden = this;
        
        var storeOrden = Ext.create('Tonyprr.mvc.store.cart.Orden',{storeId: 'idStoreOrden'});
        meOrden.gridUI = Ext.create("Ext.grid.Panel", {
            itemId:'gridWidgetOrden',
            frame:true,
            columnLines : true,
            autoScroll:true,
            store: storeOrden,
            border:false,
            columns : [
                {
                    xtype:'actioncolumn', 
                    width:40,
                    items: [
                        {
                            icon: Tonyprr.Constants.IMAGE_EDIT,
                            tooltip: 'Editar el Registro',
                            handler: function(grid, rowIndex, colIndex) {
                                grid.up('panel[itemId="viewCrudUIOrden"]').loadUIForm(grid.getStore().getAt(rowIndex));
                                if (grid.getStore().getAt(rowIndex).get('idOrdenEstado') == 3 || grid.getStore().getAt(rowIndex).get('idOrdenEstado') == 4) {
                                    meOrden.down('combobox[itemId="cboOrdenEstado"]').setReadOnly(true);
                                } else {
                                    meOrden.down('combobox[itemId="cboOrdenEstado"]').setReadOnly(false);
                                }
                                    
                                storeOrdenDetalle = meOrden.down('grid[itemId="gridOrdenDetalle"]').getStore();
                                Ext.apply( storeOrdenDetalle.getProxy().extraParams, {idOrden:grid.getStore().getAt(rowIndex).get('idOrden')} );
                                storeOrdenDetalle.load({callback: function() {
                                }});

                            }
                        }
                    ]
                },
                {dataIndex: 'idOrden',header : 'ID',width:49, sortable : true},
                {dataIndex: 'nombre_cliente',header : 'Cliente',width: 190,sortable : true},
                {dataIndex: 'tipoDocumento',header : 'Tipo Documento',width: 90,sortable : true},
                {dataIndex: 'nombre_estado',header : 'Estado',width: 126,sortable : true},
                {dataIndex: 'totalFinal',header : 'Precio Total',width: 80,sortable : true},
                {dataIndex: 'costoEnvio',header : 'Costo de Env&iacute;o',width: 80,sortable : true},
//                {xtype: 'datecolumn',dataIndex: 'fechaEnvio',header : 'Fecha de Env&iacute;o',width: 95,format:'d-m-Y',sortable : true},
//                {dataIndex: 'horaEnvio',header : 'Hora de Env&iacute;o',width: 85,sortable : true},
                {xtype: 'datecolumn',dataIndex: 'fechaDeposito',header : 'Fecha Deposito',width: 95,format:'d-m-Y',sortable : true},
                {dataIndex: 'horaDeposito',header : 'Hora Deposito',width: 85,sortable : true},
                {dataIndex: 'codigoVoucher',header : 'Voucher',width: 130,sortable : true},
                {dataIndex: 'nroFactura',header : 'Nro. Factura',width: 130,sortable : true}
            ],
            bbar : Ext.create('Ext.toolbar.Paging', {
//                itemId:'gridPagingWidgetNoti',
                pageSize: 15,
                store: storeOrden,
                displayInfo: true
            })
        });
        meOrden.getComponent('viewListOrden').add(meOrden.gridUI);
        
        
        meOrden.formUI = Ext.create("Tonyprr.abstract.Form", {
            fileUpload:true,
            itemId:'formWidgetOrden',
            width:600,
            margin:'0 14 12 1',
            frame: true,
            waitMsgTarget: true,
            fieldDefaults: {
                labelWidth: 135,
                labelAlign	: 'left',
                msgTarget	: 'side',
                anchor          : '99%',
                readOnly: true
            },
            items : [
                {
                    xtype: 'hidden',
                    name:'idOrden'
                },
                {
                    xtype :'textfield',
                    fieldLabel: 'RUC',
                    name:'rucCliente',
                    anchor:'60%'
                }
                ,{
                    xtype :'textfield',
                    fieldLabel: 'Raz&oacute;n Social',
                    name:'razonSocial'
                }
                ,{
                    xtype :'textfield',
                    fieldLabel: 'Nombres',
                    name:'nombre_cliente',
                    allowBlank:false 
                }
                ,{
                    xtype: 'fieldcontainer',
                    layout: 'hbox',
                    fieldLabel: '<b>Estado</b>',
                    items: [
                        {
                            xtype: 'combobox',
            //                anchor : '95%',
                            itemId: 'cboOrdenEstado',
                            name:'idOrdenEstado',
                            typeAhead: true,
                            width : 290,
                            store: 'Tonyprr.mvc.store.cart.OrdenEstado',
                            queryMode: 'local',
                            displayField: 'nombre',
                            valueField: 'idOrdenEstado',
                            allowBlank:false
                        }
                        ,{xtype: 'splitter', width : 15}
                        ,{
                            xtype :'radio',
                            labelWidth: 90,
                            boxLabel: 'Boleta',
                            name: 'tipoDocumento',
                            inputValue: '1'
//                            ,disabled: true
                        }                        
                        ,{xtype: 'splitter', width : 5}
                        ,{
                            xtype :'radio',
                            labelWidth: 90,
                            boxLabel: 'Factura',
                            name: 'tipoDocumento',
                            inputValue: '2'
//                            ,disabled: true
                        }
                    ]
                },
                {
                    xtype :'textfield',
                    fieldLabel: 'Direcci&oacute;n de Env&iacute;o',
    //                width : 200,
                    name:'direccionEnvio'
                }
                ,{
                    xtype :'textfield',
                    fieldLabel: 'Distrito de Env&iacute;o',
    //                width : 200,
                    name:'distritoEnvio'
                }
                ,{
                    xtype :'textfield',
                    fieldLabel: 'Persona de recepci&oacute;n',
                    name : 'personaRecepcion'
                }
                ,{
                    xtype :'textfield',
                    fieldLabel:'Combo',
                    name : 'direccionPago',
                    allowBlank:false 
                }
                ,{
                    xtype :'textfield',
                    fieldLabel:'Banco',
                    name:'cuentaBanco',
                    allowBlank:false 
                }
                ,{
                    xtype: 'fieldcontainer',
                    fieldLabel: 'Fecha y Hora Deposito',
                    layout: 'hbox',
                    defaultType: 'textfield',
                    items: [
                        {
                            xtype :'datefield',
                            width : 150,
                            format : 'd-m-Y',
                            name:'fechaDeposito',
                            readOnly: true
                        }
                        ,{xtype: 'splitter', width : 10}
                        ,{
                            xtype :'textfield',
                            name: 'horaDeposito',
                            readOnly: true
                        }
                    ]
                }
                ,{
                    xtype: 'fieldcontainer',
                    fieldLabel: 'C&oacute;digo Voucher',
                    layout: 'hbox',
                    defaultType: 'textfield',
                    items: [
                        {
                            width : 150,
                            name:'codigoVoucher',
                            readOnly: true
                        }
                        ,{xtype: 'splitter', width : 10}
                        ,{
                            fieldLabel: '<b>Nro. Factura</b>',
                            xtype :'textfield',
                            name: 'nroFactura'
                        }
                    ]
                }
                ,{
                    xtype: 'fieldcontainer',
                    fieldLabel: 'Fecha y Hora Deposito',
                    layout: 'hbox',
                    defaultType: 'textfield',
                    items: [
                        {
                            xtype :'datefield',
                            width : 150,
                            format : 'd-m-Y',
                            name:'fechaDeposito',
                            readOnly: true
                        }
                        ,{xtype: 'splitter', width : 10}
                        ,{
                            xtype :'textfield',
                            name: 'horaDeposito',
                            readOnly: true
                        }
                    ]
                },
                {
                    xtype: 'grid',
                    itemId:'gridOrdenDetalle',
                    frame:true,
                    columnLines : true,
                    autoScroll:true,
                    store: 'Tonyprr.mvc.store.cart.OrdenDetalle',
                    border:false,
                    columns : [
                        {dataIndex: 'idOrdenDetalle',header : 'ID',width:49, hidden : true},
                        {dataIndex: 'idproducto',header : 'ID Producto',width: 120,hidden : true},
                        {dataIndex: 'productoNombre',header : 'Producto',width: 300,sortable : false, css:'font-size:10px;color;blue;'},
                        {dataIndex: 'cantidad',header : 'Cantidad',width: 70,sortable : false,align:'right'},
                        {dataIndex: 'precioUnitario',header : 'Precio Unitario',width: 100,sortable : false,align:'right'},
                        {dataIndex: 'precioTotal',header : 'Precio Total',width: 100,sortable : false,align:'right'},
                        {dataIndex: 'idOrden',header : 'ID Orden',width: 140,hidden : true}
                    ]
                }
                ,{
                    xtype: 'fieldcontainer',
                    layout: 'hbox',
                    defaultType: 'textfield',
                    items: [
                        {xtype: 'splitter', width : 405}
                        ,{
                            xtype :'textfield',
                            labelWidth: 80,
                            fieldLabel: 'Total',
                            name: 'totalFinal',
                            readOnly: true,
                            width : 170
                        }
                    ]
                }
                ,{
                    xtype: 'fieldcontainer',
                    layout: 'hbox',
                    defaultType: 'textfield',
                    items: [
                        {xtype: 'splitter', width : 405}
                        ,{
                            xtype :'textfield',
                            labelWidth: 80,
                            fieldLabel: 'Costo Env&iacute;o',
                            name: 'costoEnvio',
                            readOnly: true,
                            width : 170
                        }
                    ]
                }
            ]
            ,buttonsAlign:'right',
            buttons : [
                {
                    text:'Guardar',iconCls:'save',
//                    itemId:'saveBtnFormNoti',
                    formBind: true,
//                    disabled: true,
                    scope: this,
                    handler: function (btn,e) {
//                        alert("enviar");
                        meOrden.getComponent('viewFormOrden').getComponent('formWidgetOrden').getForm().submit({
                            url : Tonyprr.BASE_URL + '/admin/cart-orden/cambiar-estado',
                            waitMsg:'Guardando, espere por favor...',
                            method:'POST',
                            timeout: 90000,
                            scope:this,
                            success: function(request, action) {
                                try{
                                    var json = Ext.JSON.decode(action.response.responseText);
                                    if(json.success == 1) {
                                        meOrden.getComponent('viewFormOrden').getComponent('formWidgetOrden').getForm().reset();
                                        meOrden.down('grid[itemId="gridOrdenDetalle"]').getStore().removeAll();
                                        meOrden.getComponent('viewListOrden').getComponent('gridWidgetOrden').getStore().load();
                                    }
                                    Tonyprr.App.showNotification({message:json.msg});
                                } catch(Exception) {
                                    Tonyprr.core.Lib.exceptionAlert(Exception);
                                }
                            },
                            failure: function(request, action) {
                                var json = Ext.JSON.decode(action.response.responseText);
                                Ext.MessageBox.alert('Mensaje', json.msg);
                            }
                        });
                    }
                }
                ,{
                    text:'Mostrar Lista',iconCls:'grid',
                    scope: this,
                    handler: function (btn,e) {
                        this.getComponent('viewFormOrden').collapse(Ext.Component.DIRECTION_RIGHT, true);
                    }
                }
            ]
        });
        meOrden.getComponent('viewFormOrden').add(meOrden.formUI);
        delete meOrden.gridUI;
        delete meOrden.formUI;
    }
});
