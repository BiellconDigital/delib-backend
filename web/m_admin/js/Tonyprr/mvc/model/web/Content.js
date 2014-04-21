Ext.define("Tonyprr.mvc.model.web.Content",{
    extend		: "Tonyprr.abstract.Model",
//    idProperty	: "user_k",
    fields		: [
        {name:"idcontent",type:"integer"},
        {name:"idcontcate",type:"integer"},
        {name : 'nameCate'},
        {name : 'nombreTipo'},
        
        {name:"idTipo",type:"integer"},
        "nombre_content",
        "intro_content",
//        "detalle",
        "imagen",
        "imagen2",
        "adjunto",
        "url",
        "adicional1",
        "adicional2",
        "adicional3",
        {name:"orden",type:"integer"},
        {name:"estado",type:"boolean"},
        {name:"fechainipub",type:"date",dateFormat:'Y-m-d H:i:s'},
        {name:"fechafinpub",type:"date",dateFormat:'Y-m-d H:i:s'},
        {name:"fechamodf",type:"date",dateFormat:'Y-m-d H:i:s'},
        {name:"fechareg",type:"date",dateFormat:'Y-m-d H:i:s'}
    ]
});