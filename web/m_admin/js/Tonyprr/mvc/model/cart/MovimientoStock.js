Ext.define("Tonyprr.mvc.model.cart.MovimientoStock",{
    extend		: "Tonyprr.abstract.Model",
    fields		: [
        {name:"idMovimientoStock", type:"integer"},
        {name:"cantidad", type:"integer"},
        {name:"iduser", type:"integer"},
        {name:'idAlmacen', type:"integer"},
        
        {name:"idMovimientoStockTipo", type:"integer"},
        "movTipo_nombre",
        {name:"signo", type:"integer"},
        
        {name:"idOrden", type:"integer"},
        
        {name:"idproducto", type:"integer"},
        "producto_nombre",
        
        {name:"fechaIngreso", type:"date", dateFormat:'Y-m-d H:i:s'},
        {name:"fechaCaducidad", type:"date", dateFormat:'Y-m-d H:i:s'},
        {name:"fechaRegistro", type:"date", dateFormat:'Y-m-d H:i:s'},
        {name:"fechaActualizacion", type:"date", dateFormat:'Y-m-d H:i:s'}
    ]
});