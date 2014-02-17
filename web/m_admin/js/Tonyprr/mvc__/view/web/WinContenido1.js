var rowEditingContent = Ext.create('Ext.grid.plugin.RowEditing');
Ext.define('Tonyprr.mvc.view.web.WinContenido1', {
	extend 			: "Ext.Panel",
        alias                   : 'widget.winContenido1',
        itemId: 'winContenido1',
        title   : "Proyecto",
//        height: 500,
        autoHeight: true,
        autoWidth: true,
//        region : 'north',
        margin : '3 25 4 5',
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
                                        fieldLabel: 'Descripción',
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
//                                        name:'precio',
//                                        minValue : 0,
//                                        fieldLabel: 'Precio',
//                                        anchor : '45%',
////                                        width : 220,
//                                        allowBlank:false 
//                                    },
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
                                        anchor : '90%',
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
                                                width: 300, disabled : true
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
                                    },
                                    {
                                        xtype: 'fieldcontainer',
                                        fieldLabel: 'Adjunto',
                                        layout: 'hbox',
                                        items: [
                                            {
                                                xtype:'textfield',
                                                name:'adjunto',
                                                width: 300, disabled : true
                                            },
                                            {xtype: 'splitter'},
                                            {
                                                xtype:'filefield',
                                                name:'file_adjunto',
                                                msgTarget: 'side',
                                                buttonConfig :{iconCls:'file_pdf'},buttonText:''
                                            }
//                                            {xtype: 'splitter', width:15},
//                                            {
//                                                xtype: 'checkbox',
//                                                fieldLabel: 'Borrar',
//                                                labelWidth : 42,
//                                                name:'borrarAdj'
//                                            }
                                        ]
                                    }
                                ]
                            }
                            
                            ,{
                                xtype :'panel',
                                title: 'Idiomas',
                                itemId:'panelContenido1Language',
                                layout : 'anchor',
                                padding : '2 2 2 2', 
                                defaults: {anchor : '98%'},
                                defaultType : 'textfield'
//                                items:[
//                                ]
                            }
                            ,{
                                xtype :'panel',
                                title: 'Galeria del Imagenes',
                                itemId:'panelGaleWidget',
                                layout : 'anchor',
                                frame: false,
                                autoHeight:true,
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
                                                itemId:'gridProdGaleriaLanguage',
                                                plugins: [rowEditingContent],
                                                frame:true,
                                                columnLines : true,
                                                autoScroll:true,
                                                store: 'Tonyprr.mvc.store.web.ContentGaleriaLanguage',
                                                border:false,
                                                columns : [
                                                    {dataIndex: 'idContentLanguage',header : 'ID',width:26, hidden : true},
                                                    {dataIndex: 'idcontgale',header : 'ID Categoria',width: 80, hidden : true},
                                                    {dataIndex: 'idLanguage',header : 'ID Idioma',hidden : true},
                                                    {dataIndex: 'idioma',header : 'Idioma', width : 110},
                                                    {
                                                        dataIndex: 'titulo',header : 'Titulo',width: 140,
                                                        field: {
                                                            xtype: 'textfield'
                                                        }
                                                    },
                                                    {
                                                        dataIndex: 'descripcion',header : 'Descripci&oacute;n',width: 170,
                                                        field: {
                                                            xtype: 'textarea'
                                                        }
                                                    }
                                                ]
                                            }
                                        ]
                                        ,buttons:[
                                            {
                                                text : 'Subir Foto',iconCls:'save',
                                                formBind: true,
                                                handler: function(btn){
                                                    
                                                    valuesForm=meWinContenido1.getComponent(0).getForm().getValues();
                                                    valuesFormFoto = meWinContenido1.down('panel[itemId="panelGaleWidget"]').getComponent(0).getForm().getValues();

                                                    if(valuesFormFoto.descripcionGale=='' || valuesFormFoto.file_foto_gale=='') {
                                                        Ext.MessageBox.alert('Alerta','Ingrese los datos de la Foto a agregar.');
                                                        return;
                                                    }
                                                    if(!Ext.isNumeric(valuesForm.idcontent)) {
                                                        Ext.MessageBox.alert('Alerta','No ha seleccionado o creado un Content para crear su Galeria.');
                                                        return;
                                                    }

                                                    meWinContenido1.down('panel[itemId="panelGaleWidget"]').getComponent(0).getForm().submit({
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
                                                                    viewtemp=meWinContenido1.down('dataview[itemId="viewGaleWidget"]');
                                                                    viewtemp.getStore().load( { callback: function() {
//                                                                            viewtemp.refresh();
                                                                            newImage = Ext.fly('gale_prod_img-'+json.idcontgale);
                                                                            newImage.hide().show({duration: 500}).frame("#ffcc33", 3, { duration: 3 });//hide().show({duration: 500}).
//                                                                            winNewFoto.animateTarget = newImage; 
                                                                    }} );
                                                                    
                                                                    storeLanguage = meWinContenido1.down('grid[itemId="gridProdGaleriaLanguage"]').getStore();
                                                                    Ext.apply(storeLanguage.getProxy().extraParams, {idcontgale : json.idcontgale});
                                                                    storeLanguage.load();
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
        //            ,{
        //                    text	: "Mostrar Lista",
        //                    iconCls : 'cross',
        //                    width : 130,
        //                    scope : this
        //            }
                ]
            }
        ]

	,initComponent	: function() {
//		this.buttons = this.createButtons();
		this.callParent();
                meWinContenido1 = this;//var storeContenido1Lang = 
                storeContenido1Lang = Ext.create('Tonyprr.mvc.store.web.ContentLanguage');

                meWinContenido1.down('panel[itemId="panelContenido1Language"]').add(
                                    {
                                        xtype : 'grid',
                                        itemId:'gridContenido1Language',
                                        frame:true,
                                        columnLines : true,
                                        autoScroll:true,
                                        store: storeContenido1Lang,
//                                        store: Ext.data.StoreManager.lookup('storeContenido1Lang'),
//                                        store: 'Tonyprr.mvc.store.web.ContentLanguage',
//                                        store : Ext.create('Tonyprr.mvc.store.web.ContentLanguage', {storeId:'storeContenido1Lang'}),
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
                                                            grid.up('panel[itemId="panelContenido1Language"]').down(('form[itemId="formContenido1Language"]')).loadRecord(model);
                                                        }
                                                    }
                                                ]
                                            },
                                            {dataIndex: 'idContentLanguage',header : 'ID',width:26, hidden : true},
                                            {dataIndex: 'idcontent',header : 'ID Categoria',width: 80, hidden : true},
                                            {dataIndex: 'idLanguage',header : 'ID Idioma',hidden : true},
                                            {dataIndex: 'idioma',header : 'Idioma', width : 180},
                                            {dataIndex: 'descripcion',header : 'Descripción',width: 270}
                                        ]
                                    }
                                );
                                        
                meWinContenido1.down('panel[itemId="panelContenido1Language"]').add(
                                    {
                                        xtype :'form',
                                        title: 'Idioma',
                                        itemId:'formContenido1Language',
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
                                                xtype: 'tinymcefield',
                                                name: 'detalle',
                                                fieldLabel: 'Detalle',
                                                labelAlign: 'top',
                                                height: 270,
                                                anchor: '100%',
                                                tinymceConfig: {
                                                    theme_advanced_buttons1: 'fullscreen,|,undo,redo,|,bold,italic,underline,strikethrough,|,forecolor,backcolor,removeformat,|,justifyleft,justifycenter,justifyright,justifyfull,|,fontselect,|,code',
                                                    theme_advanced_buttons2: 'fontsizeselect,|,cut,copy,paste,pastetext,pasteword,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink',
                                                    theme_advanced_buttons3: '',
                                                    theme_advanced_buttons4: '',
                                                    skin_variant : 'gray'
                                                }
                                            }
//                                            ,{
//                                                xtype : 'htmleditor',
//                                                fieldLabel : 'Detalle',
//                                                height : 190,
//                                                name:'detalle'
//                                            }
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


                
                Ext.create('Tonyprr.mvc.store.web.ContentGaleria', {storeId:'Contenido1GaleStore'});
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
                                    valuesForm=meWinContenido1.getComponent(0).getForm().getValues();
                                    if(!Ext.isNumeric(valuesForm.idcontent)) {
                                        Ext.MessageBox.alert('Alerta','No ha seleccionado o creado un Content para crear su Galeria.');
                                        return;
                                    }
                                    var viewGal = meWinContenido1.down('dataview[itemId="viewGaleWidget"]');
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
//                            itemId:'viewGaleWidget',
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
                                itemId:'viewGaleWidget',
                                baseCls: 'data-view-gale',
                                store: Ext.data.StoreManager.lookup('Contenido1GaleStore'),
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
                                        idImagen = node.id;
//                                        alert(name+ '-' +idImagen);
                                        
                                        storeLanguage = meWinContenido1.down('grid[itemId="gridProdGaleriaLanguage"]').getStore();
                                        Ext.apply(storeLanguage.getProxy().extraParams, {idcontgale : model.get('idcontgale')});
                                        storeLanguage.load();
                                        
                                    }
                                }
                            }
                        )
                    }
                );          
                meWinContenido1.down('panel[itemId="panelGaleWidget"]').add(panelGaleria);
                delete panelGaleria;
                
	}
	
	
});