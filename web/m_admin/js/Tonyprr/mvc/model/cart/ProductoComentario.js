Ext.define("Tonyprr.mvc.model.cart.ProductoComentario",{
    extend		: "Tonyprr.abstract.Model",
    fields		: [
        {name:"idProductoComentario",type:"integer"},
        {name: 'titulo'},
        "comentario",
        {name:"idCliente",type:"integer"},
        "nombre_cliente",
        {name:"idproducto",type:"integer"},
        "tituloConte",
        {name:"estado",type:"boolean"},
        {name:"fechaRegistro",type:"date",dateFormat:'Y-m-d H:i:s'}
    ]
});