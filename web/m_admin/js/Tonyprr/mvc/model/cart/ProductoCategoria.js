Ext.define("Tonyprr.mvc.model.cart.ProductoCategoria",{
    extend		: "Tonyprr.abstract.Model",
    fields		: [
        {name:"idcontcate",type:"integer"},
        {name:"idcontcatePadre",type:"integer"},
        "nameCate",
        "nombre_padre",
        "imagenCate",
        {name: "precioTotal", type: 'float'},
        {name: "nivelCate", type: 'integer'},
        {name: "ordenCate", type: 'integer'},
        {name: "stateCate", type: 'boolean'},
        {name:"fechamodfCate",type:"date",dateFormat:'Y-m-d H:i:s'},
        {name:"fecharegCate",type:"date",dateFormat:'Y-m-d H:i:s'}
    ]
});