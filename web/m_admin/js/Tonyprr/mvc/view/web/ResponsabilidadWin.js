var rowEditingContent = Ext.create('Ext.grid.plugin.RowEditing');

Ext.define('Tonyprr.mvc.view.web.ResponsabilidadWin', {
	extend 			: "Ext.Panel",
        alias                   : 'widget.winResponsabilidad',
        itemId: 'winResponsabilidad',
        title   : "Responsabilidad",
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
                                    {
                                        xtype:'textfield',
                                        fieldLabel:'URL Video Youtube',
                                        name:'url',
                                        vtype : 'url'
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
                                    },
                                    {
                                        xtype: 'fieldcontainer',
                                        fieldLabel: 'Adjunto',
                                        layout: 'hbox',
                                        items: [
                                            {
                                                xtype:'textfield',
                                                name:'adjunto',
                                                width: 320, disabled : true
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
                                itemId:'panelResponsabilidadLanguage',
                                layout : 'anchor',
                                padding : '2 2 2 2', 
                                defaults: {anchor : '98%'},
                                defaultType : 'textfield'
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
                meResponsabilidadWin = this;
                storeResponsabilidadLang = Ext.create('Tonyprr.mvc.store.web.ContentLanguage');

                
                meResponsabilidadWin.down('panel[itemId="panelResponsabilidadLanguage"]').add(
                                    {
                                        xtype : 'grid',
                                        itemId:'gridResponsabilidadLanguage',
                                        frame:true,
                                        columnLines : true,
                                        autoScroll:true,
                                        store: storeResponsabilidadLang,
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
                                                            grid.up('panel[itemId="panelResponsabilidadLanguage"]').down(('form[itemId="formResponsabilidadLanguage"]')).loadRecord(model);
                                                        }
                                                    }
                                                ]
                                            },
                                            {dataIndex: 'idContentLanguage',header : 'ID',width:26, hidden : true},
                                            {dataIndex: 'idcontent',header : 'ID Categoria',width: 80, hidden : true},
                                            {dataIndex: 'idLanguage',header : 'ID Idioma',hidden : true},
                                            {dataIndex: 'idioma',header : 'Idioma', width : 180},
                                            {dataIndex: 'descripcion',header : 'Título',width: 270}
                                        ]
                                    }
                                );
                                    
                meResponsabilidadWin.down('panel[itemId="panelResponsabilidadLanguage"]').add(
                                    {
                                        xtype :'form',
                                        title: 'Idioma',
                                        itemId:'formResponsabilidadLanguage',
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
                                                fieldLabel:'Título',
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
                                                height: 290,
                                                anchor: '100%',
                                                tinymceConfig: {
                                                    theme_advanced_buttons1: 'fullscreen,|,undo,redo,|,bold,italic,underline,strikethrough,|,forecolor,backcolor,removeformat,|,justifyleft,justifycenter,justifyright,justifyfull,|,fontselect,|,code',
                                                    theme_advanced_buttons2: 'fontsizeselect,|,cut,copy,paste,pastetext,pasteword,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink',
                                                    theme_advanced_buttons3: '',
                                                    theme_advanced_buttons4: '',
                                                    skin_variant : 'gray'
                                                }
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