Ext.define("Tonyprr.abstract.CrudUI", {
    extend : "Ext.panel.Panel",
    minHeight: 200,
//    height: 400,
    autoWidth : true,
    border : false,
    layout : 'border',
    itemId:'viewCrudUI',
    baseCls : 'x-plain',
    frame : false,
    autoScroll : true,
    items : [
        {
            region : 'center',
            xtype: 'panel',
            itemId:'viewList',
//            autoWidth : true,
            border : false,
            frame : false,
            layout: 'fit'
        },
        {
            region : 'east',
            xtype: 'panel',
            autoWidth : true,
            collapsible : true,
            collapsed:true,
            title:'Registro',
            itemId:'viewForm',
            autoScroll:true,
            border : true,
            frame : false
        }
    ],
    loadUIForm : function(record){
//        this.getComponent('viewForm').expand(true);
        this.taskDelayed.delay(1300, function() {
            this.getComponent('viewForm').getComponent('formWidget').loadRecord(record);
        },this);
    },
    initComponent : function() {
        this.callParent(arguments);
        
        me = this;
        me.taskDelayed = new Ext.util.DelayedTask();
//        me.loadUIForm = function(record) {
//            me.getComponent('viewForm').expand(true);
//            me.taskDelayed.delay(1300, function() {
//                me.getComponent('viewForm').getComponent('formWidget').loadRecord(record);
//            });
//        };
        me.getComponent('viewForm').setTitle(me.titleForm);

        me.deleteRecord = function(grid,rowIndex) {
            Ext.MessageBox.confirm('Eliminar Registro', 'Esta seguro que desea eliminar este registro?', 
                 function (btn) {
                    if (btn == 'yes')
                        Tonyprr.Ajax.request({
                            url     : Tonyprr.BASE_PATH + me.urlDelete,
                            params	: grid.getStore().getAt(rowIndex).data,
                            el	: grid.el,
                            scope	: this,
                            success	: function(data,response) {
                                Tonyprr.App.showNotification({message:data.msg});
                                if(data.resp==1) {
                                    me.getComponent('viewForm').getComponent('formWidget').getForm().reset();
                                    grid.getStore().load();
                                }
                            },
                            failure : function(data,response) {
                                Tonyprr.App.showNotification({message:data.msg});
                            }
                        });
                 });            
            
        };
        

        me.gridUI = Ext.create("Ext.grid.Panel", {
            itemId:'gridWidget',
            frame:true,
//            autoHeight: true,
//            loadMask: true,
            columnLines : true,
            autoScroll:true,
            store: me.optionsGrid.store,  //Tonyprr.abstract.Store
            border:false,
            tbar : [
                '-',
                {
                    text:'Nuevo',iconCls:'add',
                    listeners :{
                        click: function(){ 
                            me.getComponent('viewForm').expand(true);
                            me.getComponent('viewForm').getComponent('formWidget').getForm().reset();
                        }
                    }
                },
                 '-'
            ],
            columns : me.optionsGrid.columns,
            plugins : Ext.isEmpty(me.optionsGrid.plugins)?[]:me.optionsGrid.plugins
            ,bbar : Ext.create('Ext.toolbar.Paging', {
                itemId:'gridPagingWidget',
                pageSize: 15,
                store: me.optionsGrid.store,
                displayInfo: true
            })
//            ,listeners: {
//                itemdblclick : function (grid, record) {
//                    me.loadUIForm(record);
//                }
//            }
        });
        me.getComponent('viewList').add(me.gridUI);
        
        
        me.formUI = Ext.create("Tonyprr.abstract.Form", {
            fileUpload:true,
            itemId:'formWidget',
            width:580,
//            border:true,
            margin:'0 23 12 1',
            frame: true,
//            baseCls : 'x-plain',
            waitMsgTarget: true,
            items:  me.optionsForm.items,
            buttonsAlign:'right',
            buttons : [
                {
                    text:'Guardar',iconCls:'save',
                    itemId:'saveBtnForm',
//                    formBind: true,
//                    disabled: true,
                    scope: this,
                    handler: function (btn,e) {
//                        alert("enviar");
                        me.getComponent('viewForm').getComponent('formWidget').getForm().submit({
                            url : Tonyprr.BASE_PATH + me.urlForm,
                            waitMsg:'Guardando, espere por favor...',
                            method:'POST',
                            timeout: 900000,
                            scope:this,
                            success: function(request, action) {
                                try{
                                    var json = Ext.JSON.decode(action.response.responseText);
                                    if(json.success == 1) {
                                        me.getComponent('viewList').getComponent('gridWidget').getStore().load();
                                    }
                                    Ext.MessageBox.alert('Error ', json.msg);
                                } catch(Exception) {
                                    Tonyprr.core.Lib.exceptionAlert(Exception);
                                }
                            },
                            failure: function(request, action) {
                                Ext.MessageBox.alert('Error en el servidor');
                            }
                        });
                    }
                },
                {
                    text:'Ver Lista',iconCls:'grid',
                    itemId:'returnBtnForm',
                    scope: this
//                    handler: function(){ me.getComponent('viewForm').collapse(true); }
                }
            ],
            listeners : {
//                render : function(){
//                    alert("renderizando form panel...");
//                }
            }
        });
        me.getComponent('viewForm').add(me.formUI);
        delete me.gridUI;
        delete me.formUI;
    }
});