Ext.define('Tonyprr.mvc.controller.web.Cliente', {
    extend	: 'Ext.app.Controller',
    stores	: [
                    'Tonyprr.abstract.Store','Tonyprr.mvc.store.web.Cliente'
                    ,'Tonyprr.mvc.store.web.TipoDocumento','Tonyprr.mvc.store.web.Pais'
                   ],
    models	: ['Tonyprr.abstract.Model','Tonyprr.mvc.model.web.Cliente'
                    ,'Tonyprr.mvc.model.web.TipoDocumento','Tonyprr.mvc.model.web.Pais'
                  ],

    views	: [
		'Tonyprr.mvc.view.web.Cliente'
    ],
    refs: [
        {
            ref: 'listCliente',
            selector: 'panel[itemId="viewListCliente"]'
        }
        ,{
            ref: 'formCliente',
            selector: 'panel[itemId="viewFormCliente"]'
        }
        ,{
            ref: 'cboTipoDocumentoCliente',
            selector: 'combobox[itemId="cboTipoDocCliente"]'
        }
        ,{
            ref: 'cboPaisCliente',
            selector: 'combobox[itemId="cboPaisCliente"]'
        }
        ,{
            ref: 'winCliente',
            selector: 'panel[itemId="winCliente"]'
        }
    ],
    init	: function(app) {
        this.callParent(null);
        this.control({
            'grid[itemId="gridWidgetCliente"]': {
                afterrender : this.onGridAfterRender
            }
            ,'panel[itemId="gridWidgetCliente"] button[text="Nuevo"]': {
                click : this.onClickNuevo
            }
            
            ,'panel[itemId="winCliente"] button[text="Guardar"]': {
                click : this.onClickSave
            }
            ,'panel[itemId="winCliente"] button[text="Mostrar Lista"]': {
                click : this.onMostrarLista
            }
             
        });
    },

    initView: function(parent) {
        var viewCliente = Ext.widget('viewCliente'); 
        parent.add(viewCliente);
        viewCliente.setHeight(parent.getHeight());
    },
    
    onGridAfterRender: function(grid,opts) {//grid,opts
        grid.getStore().load();
        this.getCboTipoDocumentoCliente().getStore().load();
        this.getCboPaisCliente().getStore().load();
    }

    
    ,onClickNuevo: function() {
        this.getWinCliente().getComponent(0).getForm().reset();
        this.getFormCliente().expand(true);
    }
    
    ,onClickSave: function(button, e) {
        controller = this;
        if(this.getWinCliente().getComponent(0).getForm().isValid()) {
            this.getWinCliente().getComponent(0).getForm().submit({
                url : Tonyprr.BASE_URL + '/admin/web-cliente/save',
                waitMsg:'Guardando, espere por favor...',
                method:'POST',
                timeout: 900000,
                scope:this,
                success: function(request, action) {
                    try{
                        var json = Ext.JSON.decode(action.response.responseText);
                        if(json.success === 1) {
                            controller.getListCliente().getComponent(0).getStore().load();
                            formClie = controller.getWinCliente().getComponent(0);
                            formClie.getForm().setValues({idCliente:json.idCliente});
                            
                        }
                        Tonyprr.App.showNotification({message:json.msg});
    //                                    Ext.MessageBox.alert('Error ', json.msg);
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
    ,onMostrarLista: function (btn,e) {
        this.getFormCliente().collapse(Ext.Component.DIRECTION_RIGHT, true);
    }
    
});