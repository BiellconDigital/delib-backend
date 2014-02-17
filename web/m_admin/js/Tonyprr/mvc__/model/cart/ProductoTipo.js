Ext.define("Tonyprr.mvc.model.cart.ProductoTipo",{
    extend		: "Tonyprr.abstract.Model",
    fields		: [
        {name:"idTipo", type:"integer"},
        "imagen",
        {name:"orden", type:"integer"},
        {name:"estado", type:"boolean"},
        {name:"fechamodf", type:"date", dateFormat:'Y-m-d H:i:s'},
        {name:"fechareg", type:"date", dateFormat:'Y-m-d H:i:s'},
        
        "descripcion",
        "detalle"
    ]
});