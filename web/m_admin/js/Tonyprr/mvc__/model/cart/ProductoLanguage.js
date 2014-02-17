Ext.define("Tonyprr.mvc.model.cart.ProductoLanguage",{
    extend : "Tonyprr.abstract.Model",
    fields : [
        {name:"idProductoLanguage",type:"integer"},
        {name:"idproducto",type:"integer"},
        {name:"idLanguage",type:"integer"},
        {name : 'nombre'},
        {name : 'intro'},
        {name : 'ficha'},
        {name : 'adjunto'},
        
        {name : 'idioma'}
    ]
});