Ext.define("Tonyprr.mvc.model.cart.ProductoGaleria",{
    extend		: "Tonyprr.abstract.Model",
    fields		: [
        {name:"idcontgale",type:"integer"},
        {name:"idproducto",type:"integer"},
        {name: "ordenGale", type: 'integer'},
        "imagenGale",
        {name:"fecharegGale",type:"date",dateFormat:'Y-m-d H:i:s'}
    ]
});