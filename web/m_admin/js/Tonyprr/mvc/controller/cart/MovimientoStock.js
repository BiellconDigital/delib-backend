Ext.define('Tonyprr.mvc.controller.cart.MovimientoStock', {
    extend	: 'Ext.app.Controller',
    stores	: [
                    'Tonyprr.abstract.Store','Tonyprr.mvc.store.cart.MovimientoStock'
                    ,'Tonyprr.mvc.store.cart.MovimientoStockTipo','Tonyprr.mvc.store.cart.Producto'
                   ],
    models	: ['Tonyprr.abstract.Model','Tonyprr.mvc.model.cart.MovimientoStockTipo'
                    ,'Tonyprr.mvc.model.cart.MovimientoStockTipo','Tonyprr.mvc.model.cart.Producto'
                    ],
    views	: [
		'Tonyprr.mvc.view.cart.MovimientoStock'
    ],
    refs: [
        {
            ref: 'cboTipoMovimiento',
            selector: 'combobox[itemId="cboMovimientoStockTipo"]'
        }
    ]
    ,init	: function(app) {
        this.callParent(null);
        this.control({
            'gridpanel[itemId="gridWidgetMovimientoStock"]': {
                afterrender : this.onGridAfterRender
            }
             
        });
    },
    
    initView: function(parent) {
        var viewMovimientoStock = Ext.widget('viewMovimientoStock');
        parent.add(viewMovimientoStock);
        viewMovimientoStock.setHeight(parent.getHeight());
    },
    
    onGridAfterRender: function(grid,opts) {
        grid.getStore().load();
        if( Ext.isObject(this.getCboTipoMovimiento()) ) this.getCboTipoMovimiento().getStore().load();
    }
});