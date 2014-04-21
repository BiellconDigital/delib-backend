Ext.define("Tonyprr.mvc.model.cart.ProductoCategoriaTipo",{
    extend		: "Tonyprr.abstract.Model",
    fields		: [
        {name:"idProductocateTipo",type:"integer"},
        {name:"idcontcate",type:"integer"},
        {name:"idTipo",type:"integer"},
        {name:"cantidad",type:"float"},
        {name:"estado",type:"boolean"},
        
        {name : 'descripcion_tipo'}
    ]
});