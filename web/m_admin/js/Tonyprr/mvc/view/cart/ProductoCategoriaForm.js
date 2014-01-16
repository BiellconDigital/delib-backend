var rowEditing = Ext.create('Ext.grid.plugin.RowEditing', {
    clicksToMoveEditor: 1,
    autoCancel: false
});

Ext.define("Tonyprr.mvc.view.cart.ProductoCategoriaForm", {
    extend : "Tonyprr.abstract.Form",
    fileUpload:true,
    minHeight: 200,
    width : 570,
//    autoWidth : true,
    itemId:'productoCategoriaForm', 
    title: 'Registro',
    margins : '0 15 10 5', 
    frame : true,
    border : true, 
    autoScroll : true,
    loadUIForm : function(id) {
        this.down(('form[itemId="formProdCateLanguage"]')).getForm().reset();
        this.form.load({
            url: Tonyprr.BASE_URL + '/admin/cart-producto-categoria/form',
            method:'POST',
            waitMsg:'Cargando datos...',
            params: {
                id : id
            },
            failure:function(form, action) {
                Ext.MessageBox.alert('Mensaje', 'Error en servidor');
            },
            success:function(form, action){
                var json = Ext.JSON.decode(action.response.responseText);
//                form.setValues({nom_padre:'U'});
            }
        });
    },
    newUIForm : function(idcontcatePadre, nombrePadre, nivel) {
        this.down(('form[itemId="formProdCateLanguage"]')).getForm().reset();
        this.form.reset();
        this.down(('grid[itemId="gridProdCateLanguage"]')).getStore().removeAll();
//        this.down(('grid[itemId="gridProdCateTipo"]')).getStore().removeAll();
//        this.form.setValues({idpadre: idPadre, nombre_padre: nombrePadre, nivel: nivel});
        this.form.setValues({idcontcatePadre: idcontcatePadre, nombre_padre: nombrePadre, nivelCate: nivel});
    } ,
    saveUIForm : function(funcionSuccess) {
        this.form.submit({
            url: Tonyprr.BASE_URL + '/admin/cart-producto-categoria/save',
            waitMsg:'Guardando, espere por favor...',
            method:'POST',
            timeout: 90000,
            scope:this,
            success: funcionSuccess,
            failure: function(request, action) {
                switch (action.failureType) {
                    case Ext.form.action.Action.CLIENT_INVALID:
                        Ext.Msg.alert('Failure', 'Los campos del formulario no pueden registrarse con valores no v&aacute;lidos.');
                        break;
                    case Ext.form.action.Action.CONNECT_FAILURE:
                        Ext.Msg.alert('Failure', 'Comunicaci&oacute;n Ajax fallida');
                        break;
                    case Ext.form.action.Action.SERVER_INVALID:
                       Ext.Msg.alert('Failure', action.result.msg);
               }
//                Ext.MessageBox.alert('Error','Error en el servidor. ' + json.msg);
            }
        });
    },
    buttons : [
        {
            text : 'Guardar',
            iconCls : 'save'
        }
    ],
    items : [
        {
            xtype: 'tabpanel',
            activeTab: 0,
            border:true,
            autoHeight: true,
            width:'100%',
//                    baseCls: 'x-plain',
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
                            name:'idcontcate'
                        },
                        {
                            xtype : 'hidden',
                            name:'idcontcatePadre'
                        },
                        {
                            fieldLabel:'Padre',
                            name:'nombre_padre',
                            disabled : true
                        },
                        {
                            xtype: 'fieldcontainer',
                            fieldLabel: 'Nivel',
                            layout: 'hbox',
                            defaults: {
                                labelWidth: 40
                            },
                            items: [
                                {
                                    xtype : 'numberfield',
                                    name:'nivelCate',
                                    minValue: 1,
                                    width : 100,
                                    allowBlank:false,
                                    readOnly : true
                                },
                                {xtype: 'splitter'},
                                {
                                    xtype : 'numberfield',
                                    fieldLabel:'Orden',
                                    name:'ordenCate',
                                    width : 160,
                                    minValue: 1,
                                    allowBlank:false 
                                },
                                {xtype: 'splitter'},
                                {
                                    xtype : 'checkbox',
                                    fieldLabel:'Estado',
                                    name:'stateCate'
                                }
                            ]
                        },
                        {
                            xtype: 'fieldcontainer',
                            fieldLabel: 'Foto (200x122)',
                            layout: 'hbox',
                            items: [
                                {
                                    xtype :'textfield',
                                    name :'imagenCate',
                                    width : 270, disabled : true
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
                    itemId:'panelProdCateLanguage',
                    layout : 'anchor',
                    padding : '6 6 6 6', 
                    defaults: {anchor : '98%'},
                    defaultType : 'textfield',
                    items:[
                        {
                            xtype : 'grid',
                            itemId:'gridProdCateLanguage',
                            frame:true,
                            columnLines : true,
                            autoScroll:true,
                            store: 'Tonyprr.mvc.store.cart.ProductoCategoriaLanguage',
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
                                                grid.up('panel[itemId="panelProdCateLanguage"]').down(('form[itemId="formProdCateLanguage"]')).loadRecord(model);
                                            }
                                        }
                                    ]
                                },
                                {dataIndex: 'idProductocateLanguage',header : 'ID',width:26, hidden : true},
                                {dataIndex: 'idcontcate',header : 'ID Categoria',width: 80, hidden : true},
                                {dataIndex: 'idLanguage',header : 'ID Idioma',hidden : true},
                                {dataIndex: 'idioma',header : 'Idioma', width : 180},
                                {dataIndex: 'descripcion',header : 'Nombre Categoria',width: 270}
                            ]
                        }
                        ,{
                            xtype :'form',
                            title: 'Idioma',
                            itemId:'formProdCateLanguage',
                            fileUpload:true,
                            frame : true,
                            url: Tonyprr.BASE_URL + '/admin/cart-producto-categoria/save-language',
                            border : true, 
                            defaults: {anchor : '98%', bodyStyle:'padding:7px'},
                            defaultType : 'textfield',
                            padding : '6 6 6 6', 
                            items:[
                                {
                                    xtype: 'hidden',
                                    name:'idProductocateLanguage'
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
                                ,{
                                    xtype : 'htmleditor',
                                    title : 'Detalle',
                                    height : 200,
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
});
