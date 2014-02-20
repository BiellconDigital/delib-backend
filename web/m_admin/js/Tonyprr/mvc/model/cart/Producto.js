Ext.define("Tonyprr.mvc.model.cart.Producto",{
    extend		: "Tonyprr.abstract.Model",
    fields		: [
        {name:"idproducto",type:"integer"},
        {name: 'codigoProducto'},
        {name:"precio",type:"float"},
        {name:"cantidad",type:"integer"},
        {name: 'cantidadVendidos', type: 'integer'},
        {name:"peso",type:"float"},
        "imagen",
        "adjunto",
        {name:"orden",type:"integer"},
        {name:"estado",type:"boolean"},
        {name:"fechainipub",type:"date",dateFormat:'Y-m-d H:i:s'},
        {name:"fechafinpub",type:"date",dateFormat:'Y-m-d H:i:s'},
        {name:"fechamodif",type:"date",dateFormat:'Y-m-d H:i:s'},
        {name:"fechareg",type:"date",dateFormat:'Y-m-d H:i:s'},
        
        {name : 'nombre_producto'},
        {name : 'intro_producto'},
        {name : 'ficha'},
        
        {name:"idcontcate",type:"integer"},
        {name:"idmarca",type:"integer"},
        {name:"idTipo",type:"integer"},
        {name : 'nameCate'},
        {name : 'nombreMarca'},
        {name : 'nombreTipo'}
    ]
//    ,associations: [
//        {type: 'hasMany', model: 'Post',    name: 'posts'}
//    ]
});