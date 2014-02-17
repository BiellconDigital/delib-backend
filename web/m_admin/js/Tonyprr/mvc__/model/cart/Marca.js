Ext.define("Tonyprr.mvc.model.cart.Marca",{
    extend		: "Tonyprr.abstract.Model",
    fields		: [
        {name:"idmarca", type:"integer"},
        "nombre",
        "logo",
        {name:"estado", type:"boolean"},
        {name:"orden", type:"integer"},
        {name:"fechaActualizacion", type:"date", dateFormat:'Y-m-d H:i:s'},
        {name:"fechaRegistro", type:"date", dateFormat:'Y-m-d H:i:s'},
        
        "detalleMarca"
    ]
});