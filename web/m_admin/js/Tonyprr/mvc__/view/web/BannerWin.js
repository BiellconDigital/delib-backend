var rowEditingBanner = Ext.create('Ext.grid.plugin.RowEditing');

Ext.define('Tonyprr.mvc.view.web.BannerWin', {
	extend 			: "Ext.Panel",
        alias                   : 'widget.winBanners',
        itemId: 'winBanners',
        title   : "Banners",
        autoHeight: true,
        autoWidth: true,
//        region : 'north',
        margin : '3 10 4 5',
        layout: 'fit',
//        modal : true,
//        closable : false,
//        closeAction : 'hide',
        frame : true,
        items : [
            {
                xtype : 'form',
                fileUpload:true,
                monitorValid : true,
                frame : false,
                autoHeight: true,
                autoWidth: true,
                defaultType : 'textfield',
                layout              : 'anchor',
                fieldDefaults	: {
                    labelAlign	: 'left',
                    labelWidth      : 90,
                    msgTarget	: 'side',
                    anchor          : '99%'
                },
                items : [
                    {
                        xtype : 'tabpanel',
//                        autoHeight: true,
                        autoWidth: true,
                        plain:true,
                        activeTab: 0,
//                        height:235,
                        defaults:{bodyStyle:'padding:10px'},
                        items : [
                            {
                                xtype :'panel',
//                                layout : 'form',
                                layout : 'anchor',
                                defaults: {anchor : '98%'},
                                defaultType : 'textfield',
//                                border : false,
                                title : 'Informaci&oacute;n',
                                items : [
                                    {
                                        xtype: 'hidden',
                                        name:'idcontent'
                                    },
                                    {
                                        xtype: 'fieldcontainer',
                                        fieldLabel: 'Título',
                                        layout: 'hbox',
                                        items: [
                                            {
                                                xtype:'textfield',
                                                name:'nombre_content',
                                                width : 370,
                                                disabled:true
                                            },
                                            {
                                                xtype: 'splitter',
                                                width : 15
                                            },
                                            {
                                                xtype: 'checkbox',
                                                fieldLabel: 'Mostrar?',
                                                labelWidth : 50,
                                                name:'estado'
                                            }
                                        ]
                                    },            
//                                    {
//                                        xtype : 'datefield',
//                                        name:'fechainipub',
//                                        format : "d-m-Y",
//                                        fieldLabel: 'Fecha',
//                                        anchor : '45%',
//                                        allowBlank:false 
//                                    },
                                    {
                                        xtype : 'numberfield',
                                        name:'orden',
                                        minValue : 0,
                                        fieldLabel: 'Orden',
                                        anchor : '45%',
                                        allowBlank:false 
                                    },
//                                    {
//                                        xtype : 'numberfield',
//                                        name:'cantidad',
//                                        minValue : 0,
//                                        fieldLabel: 'Stock',
//                                        anchor : '45%',
//                                        readOnly : true
//                                    },
//                                    {
//                                        xtype : 'numberfield',
//                                        name:'pesoConte',
//                                        minValue : 0,
//                                        anchor : '45%',
//                                        fieldLabel: 'Peso'
//                                    },
                                    {
                                        xtype: 'hidden',
                                        name:'idcontcate'
                                    },
                                    {
                                        fieldLabel:'Categoria',
                                        anchor : '95%',
                                        name:'nameCate',
                                        disabled : true,
                                        allowBlank:false 
                                    },
                                    {
                                        xtype: 'fieldcontainer',
                                        fieldLabel: 'Foto',//(200x130)
                                        layout: 'hbox',
                                        items: [
                                            {
                                                xtype :'textfield',
                                                name :'imagen',
                                                width: 320, disabled : true
                                            },
                                            {xtype: 'splitter'},
                                            {
                                                xtype:'filefield',
                                                name:'file_image',
                                                msgTarget: 'side',
//                                                anchor : '30%',
                                                buttonConfig :{iconCls:'image_edit'},buttonText:''
                                            }
                                        ]
                                    }
                                ]
                            }
                            
                            ,{
                                xtype :'panel',
                                title: 'Idiomas',
                                itemId:'panelBannerLanguage',
                                layout : 'anchor',
                                padding : '2 2 2 2', 
                                defaults: {anchor : '98%'},
                                defaultType : 'textfield'
                            }
                            
                            
                            ,{
                                xtype :'panel',
                                itemId:'panelGaleBanner',
                                frame: false,
                                autoHeight:true,
                                title: 'Galeria',
                                items: [
                                    {
                                        xtype : 'form',
                                        fileUpload:true,
                                        frame : false,
                                        autoHeight: true,
                                        padding : '3 3 3 3',
                                        autoWidth: true,
                                        border : false,
                                        defaultType : 'textfield',
                                        layout              : 'anchor',
                                        fieldDefaults	: {
                                            labelAlign	: 'left',
                                            labelWidth      : 90,
                                            msgTarget	: 'side',
                                            anchor          : '96%'
                                        },
                                        items : [
                                            {
                                                xtype: 'hidden',
                                                name:'idcontgale'
                                            },
                                            {
                                                xtype: 'numberfield',
                                                name:'ordenGale',
                                                fieldLabel :'Orden',
                                                anchor:'33%'
                                            },
                                            {
                                                xtype:'filefield',
                                                name:'file_foto_gale',
                                                fieldLabel :'Foto',
                                                anchor:'98%',
                                                msgTarget: 'side',
                                                buttonConfig :{iconCls:'image_edit'},buttonText:''
                                            }
                                            ,{
                                                xtype : 'grid',
                                                itemId:'gridBannerGaleLanguage',
                                                selType: 'rowmodel',
                                                plugins: [rowEditingBanner],
                                                frame:true,
                                                columnLines : true,
                                                height: 120, 
                                                autoScroll:true,
                                                store: 'Tonyprr.mvc.store.web.ContentGaleriaLanguage',
                                                border:false,
                                                columns : [
                                                    {dataIndex: 'idContentgaleLanguage',header : 'ID',width:26, hidden : true},
                                                    {dataIndex: 'idcontgale',header : 'ID Categoria',width: 80, hidden : true},
                                                    {dataIndex: 'idLanguage',header : 'ID Idioma',hidden : true},
                                                    {dataIndex: 'idioma',header : 'Idioma', width : 110},
                                                    {
                                                        dataIndex: 'titulo',header : 'Link',width: 260,
                                                        field: {
                                                            xtype: 'textfield',vtype:'url'
                                                        }
                                                    },
                                                    {
                                                        dataIndex: 'descripcion',header : 'Descripci&oacute;n',width: 140,
                                                        field: {
                                                            xtype: 'textarea'
                                                        }
                                                    }
                                                ]
                                            }
                                        ]
                                        ,buttons:[
                                            {
                                                text : 'Nueva foto',iconCls:'add',
                                                formBind: true,
                                                handler: function(btn) {
                                                    meWinBanner.down('panel[itemId="panelGaleBanner"]').getComponent(0).getForm().reset();
                                                    
                                                    storeLanguage = meWinBanner.down('grid[itemId="gridBannerGaleLanguage"]').getStore();
                                                    storeLanguage.removeAll();
                                                }
                                                
                                            }
                                            ,{
                                                text : 'Subir Foto',iconCls:'save',
                                                formBind: true,
                                                handler: function(btn){
                                                    
                                                    valuesForm=meWinBanner.getComponent(0).getForm().getValues();
                                                    valuesFormFoto = meWinBanner.down('panel[itemId="panelGaleBanner"]').getComponent(0).getForm().getValues();

                                                    if(valuesFormFoto.descripcionGale=='' || valuesFormFoto.file_foto_gale=='') {
                                                        Ext.MessageBox.alert('Alerta','Ingrese los datos de la Foto a agregar.');
                                                        return;
                                                    }
                                                    if(!Ext.isNumeric(valuesForm.idcontent)) {
                                                        Ext.MessageBox.alert('Alerta','No ha seleccionado o creado un Banner para crear su Galeria.');
                                                        return;
                                                    }

                                                    meWinBanner.down('panel[itemId="panelGaleBanner"]').getComponent(0).getForm().submit({
                                                        url : Tonyprr.BASE_URL + '/admin/web-content-galeria/save',
                                                        waitMsg:'Guardando, espere por favor...',
                                                        method:'POST',
                                                        params : {
                                                            idcontent: valuesForm.idcontent
                                                        },
                                                        timeout: 90000,
                                                        scope:this,
                                                        success: function(request, action) {
                                                            try {
                                                                var json = Ext.JSON.decode(action.response.responseText);
                                                                if(json.success == 1) {
                                                                    viewtemp=meWinBanner.down('dataview[itemId="viewGaleBanner"]');
                                                                    viewtemp.getStore().load( { callback: function() {
//                                                                            viewtemp.refresh();
                                                                            newImage = Ext.fly('gale_prod_img-'+json.idcontgale);
                                                                            newImage.hide().show({duration: 500}).frame("#ffcc33", 3, { duration: 3 });//hide().show({duration: 500}).
//                                                                            winNewFoto.animateTarget = newImage; 
                                                                    }} );
                                                                    frm = meWinBanner.down('panel[itemId="panelGaleBanner"]').getComponent(0).getForm();
                                                                    frm.setValues({idcontgale: json.idcontgale});

                                                                    storeLanguage = meWinBanner.down('grid[itemId="gridBannerGaleLanguage"]').getStore();
                                                                    Ext.apply(storeLanguage.getProxy().extraParams, {idcontgale : json.idcontgale});
                                                                    storeLanguage.load();

                                                                    
//                                                                    storeLanguage = meWinBanner.down('grid[itemId="gridBannerGaleLanguage"]').getStore();
//                                                                    Ext.apply(storeLanguage.getProxy().extraParams, {idcontgale : json.idcontgale});
//                                                                    storeLanguage.load();
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
                                        ]
                                    }
                                ]
                            }
                            
                        ]
                    }
                    
                ]
                ,buttons : [
                    {
                            text	: "Guardar",
                            iconCls : 'save',
                            formBind : true,
                            scope	: this
                    }
//                    ,{
//                            text	: "Mostrar Lista",
//                            iconCls : 'grid',
//                            scope : this
//                    }
                ]
            }
        ]

	,initComponent	: function() {
//		this.buttons = this.createButtons();
		this.callParent();
                meWinBanner = this;
                
                var BannerGaleStore = Ext.create('Tonyprr.mvc.store.web.ContentGaleria');
                panelGaleria = Ext.create('Ext.Panel',
                    {
                        itemId:'formGaleWidget',
                        frame: false,
                        autoScroll: true,
                        height:240,
                        margin : '3 3 3 3',
                        autoWidth: true,
                        tbar: [
                            {
                                text:'Borrar',
                                iconCls:'cancel', scope: this,
                                handler: function(btn){
                                    valuesForm=meWinBanner.getComponent(0).getForm().getValues();
                                    if(!Ext.isNumeric(valuesForm.idcontent)) {
                                        Ext.MessageBox.alert('Alerta','No ha seleccionado o creado un Banner para crear su Galeria.');
                                        return;
                                    }
                                    var viewGal = meWinBanner.down('dataview[itemId="viewGaleBanner"]');
                                    var records = viewGal.getSelectionModel().getSelection();
                                    if(records.length == 0) {
                                        Ext.MessageBox.alert('Alerta','Debe seleccionar una foto para eliminarla.');delete viewGal;return;
                                    }
                                    Ext.MessageBox.confirm('Eliminar Foto', 'Esta seguro que desea eliminar esta foto?', 
                                         function (btn) {
                                            if (btn == 'yes')
                                                Tonyprr.Ajax.request({
                                                    url     : Tonyprr.BASE_URL + '/admin/web-content-galeria/delete',
                                                    params	: records[0].data,
                                                    el	: this.el,
                                                    scope	: this,
                                                    success	: function(data,response) {
                                                        Tonyprr.App.showNotification({message:data.msg});
                                                        if(data.success==1) {
                                                            viewGal.getStore().load();
                                                            delete viewGal;delete records;
                                                        }
                                                    },
                                                    failure : function(data,response) {
                                                        Tonyprr.App.showNotification({message:data.msg});
                                                    }
                                                });
                                    });            
                                }
                            },'-'
                        ],
                        items: 
//                        Ext.create("Ext.grid.Panel", {
//                            frame:true,
//                            itemId:'viewGaleBanner',
//                            height: 250,
//                            columnLines : true,
//                            autoScroll:true,
//                            store: Ext.data.StoreManager.lookup('prodGaleStore'),
//                            border:false,
//                            columns : [
//                                {dataIndex: 'idcontgale',header : 'ID',width:66, sortable : false},
//                                {dataIndex: 'descripcionGale',header : 'T&iacute;tulo',width: 205,sortable : false}
//                            ],
//                            plugins : [
//                                {
//                                    ptype: 'rowexpander',
//                                    rowBodyTpl : [
//                                        '<div style = "width:340px;">',
//                                        '<p><img src="'+Tonyprr.Constants.FILES_DATA+'/content/{imagenGale}" width="130" style="float:left;margin-right:5px;"/></p>',
//                                        '</div>'
//                                    ]
//                                }
//                            ]
//                        })
                            
                            Ext.create('Ext.view.View', 
                            {
                                xtype : 'dataview',
                                itemId:'viewGaleBanner',
                                baseCls: 'data-view-gale',
                                store: BannerGaleStore,
                                tpl: [
                                    '<tpl for=".">',
                                        '<div class="thumb-wrap" id="gale_prod-{idcontgale}">',
                                        '<div class="thumb"><img src="'+Tonyprr.Constants.FILES_DATA+'/content/galeria/{imagenGale}" title="{descripcionGale}" id="gale_prod_img-{idcontgale}"></div>',
                                        '<span class="x-editable">{shortDescription}</span></div>',
                                    '</tpl>',
                                    '<div class="x-clear"></div>'
                                ],
                                multiSelect: true,
                                autoHeight:true,
                                trackOver: true,
                                overItemCls: 'x-item-over',
                                itemSelector: 'div.thumb-wrap',
                                emptyText: 'No hay imagenes a mostrar',
                                prepareData: function(data) {
                                    Ext.apply(data, {
                                        shortDescription: Ext.util.Format.ellipsis(data.descripcionGale, 19),
                    //                    sizeString: Ext.util.Format.fileSize(data.size),
                                        dateString: Ext.util.Format.date(data.fecharegGale, "d-m-Y H:i:s")
                                    });
                                    return data;
                                },
                                listeners: {
                                    itemdblclick : function(view, model, node, e) {
                                        try {
                                            frm = meWinBanner.down('panel[itemId="panelGaleBanner"]').getComponent(0);
                                            frm.loadRecord(model);
                                            storeLanguage = meWinBanner.down('grid[itemId="gridBannerGaleLanguage"]').getStore();
                                            Ext.apply(storeLanguage.getProxy().extraParams, {idcontgale : model.get('idcontgale')});
                                            storeLanguage.load();
                                        } catch(Exception) {
                                            
                                        }
                                    }
                                }
                            }
                        )
                    }
                );          
                meWinBanner.down('panel[itemId="panelGaleBanner"]').add(panelGaleria);
                delete panelGaleria;

                storeBannerLang = Ext.create('Tonyprr.mvc.store.web.ContentLanguage');
                
                meWinBanner.down('panel[itemId="panelBannerLanguage"]').add(
                                    {
                                        xtype : 'grid',
                                        itemId:'gridBannerLanguage',
                                        frame:true,
                                        columnLines : true,
                                        autoScroll:true,
                                        store: storeBannerLang,
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
                                                            model = grid.getStore().getAt(rowIndex);
                                                            grid.up('panel[itemId="panelBannerLanguage"]').down(('form[itemId="formBannerLanguage"]')).loadRecord(model);
                                                        }
                                                    }
                                                ]
                                            },
                                            {dataIndex: 'idContentLanguage',header : 'ID',width:26, hidden : true},
                                            {dataIndex: 'idcontent',header : 'ID Categoria',width: 80, hidden : true},
                                            {dataIndex: 'idLanguage',header : 'ID Idioma',hidden : true},
                                            {dataIndex: 'idioma',header : 'Idioma', width : 180},
                                            {dataIndex: 'descripcion',header : 'Nombre Receta',width: 270}
                                        ]
                                    }
                                );
                                    
                meWinBanner.down('panel[itemId="panelBannerLanguage"]').add(
                                    {
                                        xtype :'form',
                                        title: 'Idioma',
                                        itemId:'formBannerLanguage',
                                        frame : true,
                                        fileUpload:true,
                                        url: Tonyprr.BASE_URL + '/admin/web-content/save-language',
                                        border : true, 
                                        defaults: {anchor : '98%', bodyStyle:'padding:7px'},
                                        defaultType : 'textfield',
                                        padding : '6 6 6 6', 
                                        items:[
                                            {
                                                xtype: 'hidden',
                                                name:'idContentLanguage'
                                            },
                                            {
                                                xtype : 'hidden',
                                                name:'idLanguage',
                                                allowBlank:false
                                            },
                                            {
                                                fieldLabel:'Nombre',
                                                name:'descripcion'
            //                                    ,allowBlank:false
                                            }
//                                            ,{
//                                                xtype : 'htmleditor',
//                                                fieldLabel : 'Intro',
//                                                height : 160,
//                                                name:'intro'
//                                            }
                                            ,{
                                                xtype : 'htmleditor',
                                                fieldLabel : 'Detalle',
                                                height : 190,
                                                name:'detalle'
                                            }
                                            ,{
                                                xtype:'filefield',
                                                name:'file_image_lan',
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
                                );

	}
	
	
});