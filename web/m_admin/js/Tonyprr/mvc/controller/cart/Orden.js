Ext.define('Tonyprr.mvc.controller.cart.Orden', {
    extend	: 'Ext.app.Controller',
    stores	: [
                    'Tonyprr.abstract.Store','Tonyprr.mvc.store.cart.Orden'
                    ,'Tonyprr.mvc.store.cart.OrdenDetalle','Tonyprr.mvc.store.cart.OrdenEstado'
                    ,'Tonyprr.mvc.store.web.Cliente'
                  ],
    models	: ['Tonyprr.abstract.Model','Tonyprr.mvc.model.cart.Orden'
                    ,'Tonyprr.mvc.model.cart.OrdenDetalle','Tonyprr.mvc.model.cart.OrdenEstado','Tonyprr.mvc.model.web.Cliente'
                  ],

    views	: [
		'Tonyprr.mvc.view.cart.Orden'
    ],
    refs: [
        {
            ref: 'cboOrdenEstado',
            selector: 'combobox[itemId="cboOrdenEstado"]'
        }
//        ,{
//            ref: 'cboClienteOrden',
//            selector: 'combobox[itemId="cboClienteOrden"]'
//        }
    ],
    init	: function(app) {
        this.callParent(null);
        this.control({
            'grid[itemId="gridWidgetOrden"]': {
                afterrender : this.onGridAfterRender
            }
             
        });
    },
    
    initView: function(parent) {
        var viewOrden = Ext.widget('viewOrden');
        parent.add(viewOrden);
        viewOrden.setHeight(parent.getHeight());
    },
    
    onGridAfterRender: function(grid,opts) {//grid,opts
        grid.getStore().load();
        this.getCboOrdenEstado().getStore().load();
//        this.getCboClienteOrden().getStore().load();
    }
});