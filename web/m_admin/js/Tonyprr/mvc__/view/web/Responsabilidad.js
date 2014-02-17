Ext.define("Tonyprr.mvc.view.web.Responsabilidad", {
    extend : "Ext.panel.Panel",
    alias : 'widget.viewResponsabilidad',
//    renderTo : 'tabResponsabilidad',
    minHeight: 200,
    autoWidth : true,
    border : false,
    layout : 'border',
    itemId:'viewUIResponsabilidad',
    baseCls : 'x-plain',
    frame : false,
    autoScroll : true,
    items : [
        {
            region : 'west',
            xtype: 'panel',
            title: 'Lista de Responsabilidad',
            itemId:'viewListResponsabilidad',
            width : 310,
            border : true,
            frame : false
        },
        {
            region : 'center',
            xtype: 'panel',
            autoWidth : true,
            autoHeight: true,
            itemId:'viewRegResponsabilidad',
            autoScroll:true,
            border : true,
            frame : false
        }
    ],
    initComponent : function() {
        this.callParent(arguments);
        meRespon = this;
        
//        Ext.create('Tonyprr.mvc.store.web.ContentCategoriaTree', {storeId:'CateResponsabilidadStoreTree'});
        var storeCateResponsabilidad = Ext.create('Tonyprr.mvc.store.web.ContentCategoriaTree');
        gridTreeRespon = Ext.create("Ext.tree.Panel", {
            alias : 'widget.treeCateResponsabilidad',
//            id : 'idTreeCateResponsabilidad',
            itemId:'treeCateResponsabilidad',
            autoWidth: true,
            height: 150,
            autoScroll: true,
            useArrows: true,
            rootVisible: false,
            store: storeCateResponsabilidad,
//            store: Ext.data.StoreManager.lookup('CateResponsabilidadStoreTree'),//'Tonyprr.mvc.store.web.ContentCategoriaTree',
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
                    dataIndex: 'estadoCate',
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
        
        
        
//        Ext.create('Tonyprr.mvc.store.web.Content', {storeId:'ResponsabilidadStore'});
        var storeResponsabilidad = Ext.create('Tonyprr.mvc.store.web.Content');
        panelView = Ext.create("Ext.grid.Panel", {
            frame:true,
            itemId:'gridResponsabilidad',
            columnLines : true,
            autoScroll:true,
            store: storeResponsabilidad,
            border:false,
            dockedItems : [{
                xtype: 'toolbar',
                dock: 'top',
                items: [
                    '-',
                    {
                        text:'Agregar Responsabilidad',
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
                            meRespon.down('panel[itemId="winResponsabilidad"]').getComponent(0).loadRecord(grid.getStore().getAt(rowIndex));
                            meRespon.down('form[itemId="formResponsabilidadLanguage"]').getForm().reset();
                            
                            idReg = grid.getStore().getAt(rowIndex).get('idcontent');
                            storeLanguage = grid.up('panel[itemId="viewUIResponsabilidad"]').down('grid[itemId="gridResponsabilidadLanguage"]').getStore();
                            Ext.apply(storeLanguage.getProxy().extraParams, {idcontent: idReg});
                            storeLanguage.load();
//                            storeGaleria = meRespon.down('dataview[itemId="viewGaleWidget"]').getStore();
//                            Ext.apply( storeGaleria.getProxy().extraParams, {idcontent: idReg} );
//                            storeGaleria.load();
                        }
                    },{
                        icon: Tonyprr.Constants.IMAGE_CROSS,
                        tooltip: 'Eliminar el Registro',
                        handler: function(grid, rowIndex, colIndex) {
                            Ext.MessageBox.confirm('Eliminar Foto', 'Esta seguro que desea eliminar este content?', 
                                 function (btn) {
                                    if (btn == 'yes')
                                        Tonyprr.Ajax.request({
                                            url     : Tonyprr.BASE_URL + '/admin/web-content/delete',
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
                {dataIndex: 'idcontent',header : 'ID',width:26, sortable : true},
                {dataIndex: 'nombre_content',header : 'Título',width: 220,sortable : true},
//                {dataIndex: 'precio',header : 'Precio',width: 70,sortable : true},
//                {dataIndex: 'cantidad',header : 'Stock',width: 70,sortable : true},
//                {dataIndex: 'cantidadVendidos',header : 'Vendidos',width: 70,sortable : true},
                {dataIndex: 'orden',header : 'Orden',width: 60,hidden : true},
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
                        '<p><b>Adjunto: </b><a href="'+Tonyprr.Constants.FILES_DATA+'/content/{adjunto}" target="_blank">{adjunto}</a></p>',
                        '<p><img src="'+Tonyprr.Constants.FILES_DATA+'/content/{imagen}" width="130" style="float:left;margin-right:5px;"/>{intro_content}</p>',
                        '</div>'
                    ]
                }
            ],
            bbar : Ext.create('Ext.toolbar.Paging', {
                itemId:'gridPagingResponsabilidad',
                pageSize: 15,
                store: storeResponsabilidad,
                displayInfo: true
            })
        });
        
        panelForm = Ext.create('Tonyprr.mvc.view.web.ResponsabilidadWin');
        meRespon.getComponent('viewListResponsabilidad').add(gridTreeRespon);
        meRespon.getComponent('viewListResponsabilidad').add(panelView);
        meRespon.getComponent('viewRegResponsabilidad').add(panelForm);

        delete panelView;
        delete gridTreeRespon;
        delete panelForm;
        
    }
//    ,listeners : {
//        beforedestroy: function(panel, opts) {
//            alert("borrar...");
//            panel.getComponent(0).destroy();
//            panel.getComponent(1).destroy();
//        }
//    }
});
