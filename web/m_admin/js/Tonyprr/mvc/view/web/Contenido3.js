Ext.define("Tonyprr.mvc.view.web.Contenido3", {
    extend : "Ext.panel.Panel",
    alias : 'widget.viewContenido3',
//    renderTo : 'tabContenido3',
    minHeight: 200,
    autoWidth : true,
    border : false,
    layout : 'border',
    itemId:'viewUIContenido3',
    baseCls : 'x-plain',
    frame : false,
    autoScroll : true,
    items : [
        {
            region : 'west',
            xtype: 'panel',
            title: 'Lista de Noticias',
            itemId:'viewListContenido3',
            width : 310,
            border : true,
            frame : false
        },
        {
            region : 'center',
            xtype: 'panel',
            autoWidth : true,
            autoHeight: true,
            itemId:'viewRegContenido3',
            autoScroll:true,
            border : true,
            frame : false
        }
    ],
    initComponent : function() {
        this.callParent(arguments);
        meNoticia = this;
        
//        Ext.create('Tonyprr.mvc.store.web.Content', {storeId:'Contenido3Store'});
        var storeContenido3 = Ext.create('Tonyprr.mvc.store.web.Content');
        panelView = Ext.create("Ext.grid.Panel", {
            frame:true,
            itemId:'gridContenido3',
            columnLines : true,
            autoScroll:true,
            store: storeContenido3,
            border:false,
            dockedItems : [{
                xtype: 'toolbar',
                dock: 'top',
                items: [
                    '-',
                    {
                        text:'Agregar Noticia',
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
//                            meNoticia.getComponent('viewRegContenido3').expand(true);
//                            meNoticia.down('grid[itemId="gridContenido3"]').toggleCollapse();
                            meNoticia.down('panel[itemId="winContenido3"]').getComponent(0).loadRecord(grid.getStore().getAt(rowIndex));
                            meNoticia.down('form[itemId="formContenido3Language"]').getForm().reset();
                            
                            idReg = grid.getStore().getAt(rowIndex).get('idcontent');
                            storeLanguage = grid.up('panel[itemId="viewUIContenido3"]').down('grid[itemId="gridContenido3Language"]').getStore();
                            Ext.apply(storeLanguage.getProxy().extraParams, {idcontent: idReg});
                            storeLanguage.load();
//                            storeGaleria = meNoticia.down('dataview[itemId="viewGaleWidget"]').getStore();
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
                {dataIndex: 'nombre_content',header : 'Titulo',width: 220,sortable : true},
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
                itemId:'gridPagingContenido3',
                pageSize: 15,
                store: storeContenido3,
                displayInfo: true
            })
        });
        
        panelForm = Ext.create('Tonyprr.mvc.view.web.Contenido3Win');
//        meNoticia.getComponent('viewListContenido3').add(gridTreeRepresen);
        meNoticia.getComponent('viewListContenido3').add(panelView);
        meNoticia.getComponent('viewRegContenido3').add(panelForm);

        delete panelView;
        delete gridTreeRepresen;
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
