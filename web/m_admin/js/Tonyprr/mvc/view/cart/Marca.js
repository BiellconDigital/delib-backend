Ext.define("Tonyprr.mvc.view.cart.Marca", {
    extend : "Ext.panel.Panel",
    alias : 'widget.viewMarca',
    minHeight: 200,
    autoWidth : true,
    border : false,
    layout : 'border',
    itemId:'viewCrudUIMarcaProd',
    baseCls : 'x-plain',
    frame : false,
    autoScroll : true,
    items : [
        {
            region : 'west',
            xtype: 'panel',
            itemId:'viewListMarcaProd',
            width : 350,
            split:true,
            minSize: 150,
            maxSize: 350,
            collapsible : true,
            border : false,
            frame : false,
            layout: 'fit'
        },
        {
            region : 'center',
            xtype: 'panel',
            autoWidth : true,
            itemId:'viewFormMarcaProd',
            autoScroll:true,
            border : true,
            frame : false
        }
    ],
    loadUIForm : function(record){
            this.getComponent('viewFormMarcaProd').getComponent('formWidgetMarcaProd').loadRecord(record);
    },
    initComponent : function() {
        this.callParent(arguments);
        
        meMarcaProd = this;
        
        var storeMProd = Ext.create('Tonyprr.mvc.store.cart.Marca',{storeId: 'storeMarca'});
        meMarcaProd.gridUI = Ext.create("Ext.grid.Panel", {
            itemId:'gridWidgetMarcaProd',
            id:'gridWidgetMarcaProd',
            frame:true,
            columnLines : true,
            autoScroll:true,
            store: storeMProd,
            border:false,
            tbar : [
                '-',
                {
                    text:'Nuevo',iconCls:'add'
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
                            grid.up('panel[itemId="viewCrudUIMarcaProd"]').loadUIForm(grid.getStore().getAt(rowIndex));
                            idReg = grid.getStore().getAt(rowIndex).get('idmarca');
                            storeLanguage = grid.up('panel[itemId="viewCrudUIMarcaProd"]').down('grid[itemId="gridMarcaLanguage"]').getStore();
                            Ext.apply(storeLanguage.getProxy().extraParams, {idmarca: idReg});
                            storeLanguage.load();
                            
                        }
                    },{
                        icon: Tonyprr.Constants.IMAGE_CROSS,
                        tooltip: 'Eliminar registro',
                        handler: function(grid, rowIndex, colIndex) {
                            Ext.MessageBox.confirm('Eliminar Marca', 'Esta seguro que desea eliminar esta marca?', 
                                 function (btn) {
                                    if (btn == 'yes')
                                        Tonyprr.Ajax.request({
                                            url     : Tonyprr.BASE_URL + '/admin/cart-marca/delete',
                                            params	: grid.getStore().getAt(rowIndex).data,
                                            el	: this.el,
                                            scope	: this,
                                            success	: function(data, response) {
                                                Tonyprr.App.showNotification({message:data.msg});
                                                if(data.success == 1) {
                                                    grid.getStore().load();
                                                }
                                            },
                                            failure : function(data, response) {
//                                                alert(data);
//                                                alert(response);
                                                Tonyprr.App.showNotification({message:data.msg});
                                            }
                                        });
                                });
                        }                
                    }
                ]
            },
            {dataIndex: 'idmarca',header : 'ID',width:26, sortable : false},
            {dataIndex: 'nombre',header : 'Nombre',width: 190,sortable : false},
            {dataIndex: 'orden',header : 'Orden', width: 60},
            {dataIndex: 'estado',header : 'Estado',width: 50,sortable : false,renderer: Tonyprr.core.Lib.checkRender}
            ],
            plugins : [
                {
                    ptype: 'rowexpander',
                    rowBodyTpl : [
                        '<div style = "width:340px;">',
                        '<p><b>Fecha Registro: </b>{fechaRegistro:date("d-m-Y H:i:s")}<br/></p>',
                        '<p><img src="'+Tonyprr.Constants.FILES_DATA_CART + '/marca/thumb_{logo}" width="130" style="float:left;margin-right:5px;"/>{detalleMarca}</p>',
                        '</div>'
                    ]
                }
            ],
            bbar : Ext.create('Ext.toolbar.Paging', {
//                itemId:'gridPagingWidgetNoti',
                pageSize: 15,
                store: storeMProd,
                displayInfo: true
            })
        });
        meMarcaProd.getComponent('viewListMarcaProd').add(meMarcaProd.gridUI);
        
        
        meMarcaProd.formUI = Ext.create("Tonyprr.abstract.Form", {
            fileUpload:true,
            itemId:'formWidgetMarcaProd',
            id:'formWidgetMarcaProd',
            width:590,
            title:'Registro de Marca',
            margin:'0 23 12 1',
            frame: true,
            waitMsgTarget: true,
            items : [
                {
                    xtype: 'tabpanel',
                    activeTab: 0,
                    border:true,
                    autoHeight: true,
                    width:'100%',
                    defaults:{bodyStyle:'padding:2px'},
                    items:[
                        {
                            xtype :'panel',
                            title: 'Datos',
                            layout : 'anchor',
                            defaults: {anchor : '98%'},
                            defaultType : 'textfield',
                            padding : '6 6 6 6', 
                            items:[
                                {
                                    xtype: 'hidden',
                                    name:'idmarca'
                                },
                                {
                                    xtype: 'fieldcontainer',
                                    fieldLabel: 'Nombre',
                                    layout: 'hbox',
                                    items: [
                                        {
                                            xtype :'textfield',
                                            width : 310,
                                            name:'nombre'
                                        }
                                        ,{xtype: 'splitter', width : 18}
                                        ,{
                                            xtype: 'checkbox',
                                            name:'estado'
                                        }
                                    ]
                                }
                                ,{
                                    xtype :'numberfield',
                                    fieldLabel: 'Orden',
                                    anchor : '33%',
                                    name:'orden'
                                }
                                ,{
                                    xtype: 'fieldcontainer',
                                    fieldLabel: 'Imagen',
                                    layout: 'hbox',
                                    items: [
                                        {
                                            xtype :'textfield',
                                            name :'logo',
                                            width : 287, disabled : true
                                        },
                                        {xtype: 'splitter'},
                                        {
                                            xtype:'filefield',
                                            name:'file_image',
                                            msgTarget: 'side',
                                            buttonConfig :{iconCls:'image_edit'},buttonText:''
                                        }
                                    ]
                                }
                            ]
                        }
                        ,{
                            xtype :'panel',
                            title: 'Idiomas',
                            itemId:'panelMarcaLanguage',
                            layout : 'anchor',
                            padding : '6 6 6 6', 
                            defaults: {anchor : '98%'},
                            defaultType : 'textfield',
                            items:[
                                {
                                    xtype : 'grid',
                                    itemId:'gridMarcaLanguage',
                                    frame:true,
                                    columnLines : true,
                                    autoScroll:true,
                                    store: 'Tonyprr.mvc.store.cart.MarcaLanguage',
                                    border:false,
                                    columns : [
                                        {
                                            xtype:'actioncolumn', 
                                            width:60,
                                            items: [
                                                {
                                                    icon: Tonyprr.Constants.IMAGE_EDIT,
                                                    tooltip: 'Editar registro',
                                                    handler: function(grid, rowIndex, colIndex) {
                                                        model = grid.getStore().getAt(rowIndex);
                                                        grid.up('panel[itemId="panelMarcaLanguage"]').down(('form[itemId="formMarcaLanguage"]')).loadRecord(model);
                                                    }
                                                }
                                            ]
                                        },
                                        {dataIndex: 'idMarcaLanguage',header : 'ID',width:26, hidden : true},
                                        {dataIndex: 'idmarca',header : 'ID Categoria',width: 80, hidden : true},
                                        {dataIndex: 'idLanguage',header : 'ID Idioma',hidden : true},
                                        {dataIndex: 'idioma',header : 'Idioma', width : 180},
                                        {dataIndex: 'detalle',header : 'Detalle Marca',width: 270}
                                    ]
                                }
                                ,{
                                    xtype :'form',
                                    title: 'Idioma',
                                    itemId:'formMarcaLanguage',
                                    fileUpload:true,
                                    frame : true,
                                    url: Tonyprr.BASE_URL + '/admin/cart-marca/save-language',
                                    border : true, 
                                    defaults: {anchor : '98%', bodyStyle:'padding:7px'},
                                    defaultType : 'textfield',
                                    padding : '6 6 6 6', 
                                    items:[
                                        {
                                            xtype: 'hidden',
                                            name:'idMarcaLanguage'
                                        },
                                        {
                                            xtype : 'hidden',
                                            name:'idLanguage',
                                            allowBlank:false
                                        }
                                        ,{
                                            xtype : 'htmleditor',
                                            title : 'Detalle',
                                            height : 180,
                                            name:'detalle'
                                        }
                                        ,{
                                            xtype:'filefield',
                                            name:'file_image_temp',
                                            hidden :  true,
                                            buttonConfig :{iconCls:'image_edit'},buttonText:''
                                        }
                                    ],
                                    tbar: [
                                        '-',
                                        {
                                            text: 'guardar idioma',
                                            formBind: true,
                                            disabled: true,
                                            iconCls : 'save'
                                        }
                                        ,'-'
                                    ]
                                }
                            ]
                        }
                    ]
                }
            ]
            ,
            buttonsAlign:'right',
            buttons : [
                {
                    text:'Guardar',iconCls:'save',
//                    itemId:'saveBtnFormNoti',
                    formBind: true,
//                    disabled: true,
                    scope: this
                }
            ]
        });
        meMarcaProd.getComponent('viewFormMarcaProd').add(meMarcaProd.formUI);
        delete meMarcaProd.gridUI;
        delete meMarcaProd.formUI;
    }
});
