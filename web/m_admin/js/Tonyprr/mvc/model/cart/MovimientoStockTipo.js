Ext.define("Tonyprr.mvc.model.cart.MovimientoStockTipo",{
    extend		: "Tonyprr.abstract.Model",
    fields		: [
        {name:"idMovimientoStockTipo", type:"integer"},
        "nombre",
        {name:"signo", type:"integer"},
        {name:"fechaRegistro", type:"date", dateFormat:'Y-m-d H:i:s'},
        {name:"fechaActualizacion", type:"date", dateFormat:'Y-m-d H:i:s'}
    ]
});