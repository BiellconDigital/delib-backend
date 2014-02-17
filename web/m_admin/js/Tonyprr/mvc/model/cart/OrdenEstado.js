Ext.define("Tonyprr.mvc.model.cart.OrdenEstado",{
    extend		: "Tonyprr.abstract.Model",
    fields		: [
        {name:"idOrdenEstado", type:"integer"},
        "nombre",
        "detalle",
        {name:"activo", type:"boolean"},
        "color",
        "envioEmail"
    ]
});