Ext.define('Tonyprr.mvc.controller.cart.Orden', {
    extend	: 'Ext.app.Controller',
    stores	: [
                    'Tonyprr.abstract.Store','Tonyprr.mvc.store.cart.Orden'
                    ,'Tonyprr.mvc.store.cart.OrdenDetalle','Tonyprr.mvc.store.cart.OrdenEstado'
                    ,'Tonyprr.mvc.store.web.Cliente'
                    ,'Tonyprr.mvc.store.cart.TipoPago'
                  ],
    models	: ['Tonyprr.abstract.Model','Tonyprr.mvc.model.cart.Orden'
                    ,'Tonyprr.mvc.model.cart.OrdenDetalle','Tonyprr.mvc.model.cart.OrdenEstado','Tonyprr.mvc.model.web.Cliente'
                    ,'Tonyprr.mvc.model.cart.TipoPago'
                  ],

    views	: [
		'Tonyprr.mvc.view.cart.Orden'
    ],
    refs: [
        {
            ref: 'cboOrdenEstado',
            selector: 'combobox[itemId="cboOrdenEstado"]'
        }
        ,{
            ref: 'formOrden',
            selector: 'form[itemId="formWidgetOrden"]'
        }
        ,{
            ref: 'gridOrden',
            selector: 'grid[itemId="gridWidgetOrden"]'
        }
    ],
    init	: function(app) {
        this.callParent(null);
        this.control({
            'grid[itemId="gridWidgetOrden"]': {
                afterrender : this.onGridAfterRender
            }
            
            ,'form[itemId="formWidgetOrden"] button[text="Actualizar desde VISA"]': {
                click : this.onClickVisa
            }
             
        });
    },
    
    initView: function(parent) {
        var viewOrden = Ext.widget('viewOrden');
        parent.add(viewOrden);
        viewOrden.setHeight(parent.getHeight());
    }
    
    ,onClickVisa: function(button,e) {
        controller = this;
        var data = this.getFormOrden().getForm().getValues();
        
        Tonyprr.Ajax.request({
            url     : Tonyprr.BASE_URL + '/admin/cart-orden/actualizar-orden-visa',
            params	: data,
            el	: this.el,
            scope	: this,
            success	: function(data,response) {
                Tonyprr.App.showNotification({message:data.msg});
                if(data.update == 1) {
                    controller.getGridOrden().getStore().load();
                    controller.getFormOrden().getForm().setValues({idOrdenEstado: data.idOrdenEstado, fechaDeposito: data.fechaDeposito});
                }
            },
            failure : function(data, response) {
                Tonyprr.App.showNotification({message:data.msg});
            }
        });

    }
    
    ,onGridAfterRender: function(grid,opts) {//grid,opts
        grid.getStore().load();
        this.getCboOrdenEstado().getStore().load();
//        this.getCboClienteOrden().getStore().load();
    }
});