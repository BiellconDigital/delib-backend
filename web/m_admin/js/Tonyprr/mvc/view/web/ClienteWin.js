Ext.define('Tonyprr.mvc.view.web.ClienteWin', {
    extend 			: "Ext.Panel",
    alias                   : 'widget.winCliente',
    itemId: 'winCliente',
    title   : "Cliente",
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
            itemId:'formWidgetCliente',
            width:596,
            margin:'0 23 12 1',
            frame: true,
            waitMsgTarget: true,
            items : [
            {
                xtype: 'hidden',
                name:'idCliente'
            },
            {
                xtype: 'fieldcontainer',
                fieldLabel: 'Nombres',
                layout: 'hbox',
                items: [
                    {
                        xtype :'textfield',
                        width : 330,
                        name:'nombres',
                        allowBlank:false 
                    }
                    ,{xtype: 'splitter', width : 15}
                    ,{
                        xtype: 'checkbox',
                        fieldLabel: 'Activo?',
                        name:'estado'
                    }
                ]
            },
            {
                xtype :'textfield',
                fieldLabel: 'Ape. Paterno',
//                width : 200,
                name:'apellidoPaterno',
                allowBlank:false 
            }
            ,{
                xtype :'textfield',
                fieldLabel:'Ape. Materno',
//                width : 200,
                name : 'apellidoMaterno',
                allowBlank:false 
            }
            ,{
                xtype :'textfield',
                fieldLabel:'E-mail',
                name:'email',
                vtype :'email',
                allowBlank:false 
            }
            ,{
                xtype :'datefield',
                anchor : '40%',
                format : 'd-m-Y',
                fieldLabel:'Fcha. Nacimiento',
                name:'fechaNacimiento'
            }
            ,{
                xtype: 'fieldcontainer',
                fieldLabel: 'G&eacute;nero',
                layout: 'hbox',
                defaultType: 'radio',
                items: [
                    {
                        checked: true,
                        boxLabel: 'Masculino',
                        name: 'genero',
                        inputValue: 'M'
                    }
                    ,{xtype: 'splitter', width : 10}
                    ,{
                        boxLabel: 'Femenino',
                        name: 'genero',
                        inputValue: 'F'
                    }
                ]
            }
            ,{
                xtype: 'fieldcontainer',
                fieldLabel: 'Doc. Identidad',
                layout: 'hbox',
                items: [
                    {
                        xtype: 'combobox',
//                        anchor : '95%',
                        itemId: 'cboTipoDocCliente',
                        name:'idtipoDocumento',
                        typeAhead: true,
                        width : 200,
                        store: 'Tonyprr.mvc.store.web.TipoDocumento',
                        queryMode: 'local',
                        displayField: 'nombreTdoc',
                        valueField: 'idtipoDocumento',
                        allowBlank:false
                    }
                    ,{xtype: 'splitter', width : 6}
                    ,{
                        xtype :'textfield',
                        width : 200,
                        name : 'nroDocumento',
                        allowBlank:false
                    }
                ]
            }
            ,{
                xtype: 'combobox',
                fieldLabel: 'Pais',
//                anchor : '95%',
                itemId: 'cboPaisCliente',
                name:'idPais',
                typeAhead: true,
//                readOnly : true,
                store: 'Tonyprr.mvc.store.web.Pais',
                queryMode: 'local',
                displayField: 'nombre',
                valueField: 'idPais'
            }
            ,{
                xtype: 'fieldcontainer',
                fieldLabel: 'Tel&eacute;fono Casa',
                layout: 'hbox',
                items: [
                    {
                        xtype :'textfield',
                        name :'telefonoCasa',
                        width : 100
                    },
                    {xtype: 'splitter'},
                    {
                        xtype :'textfield',
                        fieldLabel: 'Tel&eacute;fono Oficina',
                        labelWidth : 60,
                        name :'telefonoOficina',
                        width : 180
                    },
                    {xtype: 'splitter'},
                    {
                        xtype :'textfield',
                        labelWidth      : 45,
                        fieldLabel: 'M&oacute;vil',
                        name :'movil',
                        width : 170
                    }
                ]
            }
            ,{
                xtype: 'fieldcontainer',
                fieldLabel: 'Imagen',
                layout: 'hbox',
                items: [
                    {
                        xtype :'textfield',
                        name :'foto',
                        width : 296, disabled : true
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
            ,{
                xtype :'checkbox',
                fieldLabel: 'Recibir Oferta por EMail',
                name:'recibirOfertasMail'
            }
            ]
            ,
            buttonsAlign:'right',
            buttons : [
                {
                    text:'Guardar',
                    iconCls:'save',
//                    itemId:'saveBtnFormNoti',
                    formBind: true,
//                    disabled: true,
                    scope: this
                }
                ,{
                    text:'Mostrar Lista',iconCls:'grid',
                    scope: this
                }
            ]
        }
    ]
    
    ,initComponent	: function() {
        this.callParent();
        //meClienteWin = this;
    }
            
});



