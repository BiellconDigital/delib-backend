Ext.define("Tonyprr.mvc.view.web.Cliente", {
    extend : "Ext.panel.Panel",
    alias : 'widget.viewCliente',
    minHeight: 200,
    autoWidth : true,
    border : false,
    layout : 'border',
    itemId:'viewCrudUICliente',
    baseCls : 'x-plain',
    frame : false,
    autoScroll : true,
    items : [
        {
            region : 'center',
            xtype: 'panel',
            title:'Lista de Clientes',
            itemId:'viewListCliente',
//            layout : 'fit',
//            autoWidth : true,
//            anchor : '100%',
            border : false,
            frame : false
        },
        {
            region : 'east',
            xtype: 'panel',
            title:'Registro de Cliente',
            minSize: 150,
            maxSize: 800,
            collapsible : true,
            collapsed : true,
            split:true,
            width : 650,
            itemId:'viewFormCliente',
            autoScroll:true,
            border : true,
            frame : false
        }
    ],
    loadUIForm : function(record){
            this.getComponent('viewFormCliente').getComponent('winCliente').getComponent('formWidgetCliente').loadRecord(record);
            this.getComponent('viewFormCliente').expand(true);
    },
    initComponent : function() {
        this.callParent(arguments);
        meCliente = this;
        
        var storeCliente = Ext.create('Tonyprr.mvc.store.web.Cliente',{storeId: 'idStoreCliente'});
        meCliente.gridUI = Ext.create("Ext.grid.Panel", {
            itemId:'gridWidgetCliente',
            frame:true,
            columnLines : true,
            autoScroll:true,
            store: storeCliente,
            border:false,
            tbar : [
                '-',
                {
                    text:'Nuevo', iconCls:'add'
                },
                 '-'
            ],
            columns : [
                {
                    xtype:'actioncolumn', 
                    width:40,
                    items: [
                        {
                            icon: Tonyprr.Constants.IMAGE_EDIT,
                            tooltip: 'Editar el Registro',
                            handler: function(grid, rowIndex, colIndex) {
                                grid.up('panel[itemId="viewCrudUICliente"]').loadUIForm(grid.getStore().getAt(rowIndex));
                            }
                        }
                    ]
                },
                {dataIndex: 'idCliente',header : 'ID',width:26, sortable : true},
                {dataIndex: 'nombres',header : 'Nombres',width: 140,sortable : true},
                {dataIndex: 'apellidoPaterno',header : 'Ape. Paterno',width: 120,sortable : true},
                {dataIndex: 'apellidoMaterno',header : 'Ape. Materno',width: 120,sortable : true},
                {dataIndex: 'email',header : 'E-mail',width: 180,sortable : true},
                {dataIndex: 'estado',header : 'Estado',width: 50,sortable : true,renderer: Tonyprr.core.Lib.checkRender}
            ],
            plugins : [
                {
                    ptype: 'rowexpander',
                    rowBodyTpl : [
                        '<div style = "width:340px;">',
                        '<p><b>Fecha Registro: </b>{fechaRegistro:date("d-m-Y H:i:s")}<br/></p>',
                        '<p><img src="'+Tonyprr.Constants.FILES_DATA+'/home/{foto}" width="130" style="float:left;margin-right:5px;"/>{descripcionCliente}</p>',
                        '</div>'
                    ]
                }
            ],
            bbar : Ext.create('Ext.toolbar.Paging', {
//                itemId:'gridPagingWidgetNoti',
                pageSize: 15,
                store: storeCliente,
                displayInfo: true
            })
        });
        meCliente.getComponent('viewListCliente').add(meCliente.gridUI);
        
        
        meCliente.formUI = Ext.create('Tonyprr.mvc.view.web.ClienteWin');
        meCliente.getComponent('viewFormCliente').add(meCliente.formUI);
        delete meCliente.gridUI;
        delete meCliente.formUI;
    }
});
