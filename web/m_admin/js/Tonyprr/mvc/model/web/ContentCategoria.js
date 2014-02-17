Ext.define("Tonyprr.mvc.model.web.ContentCategoria",{
    extend		: "Tonyprr.abstract.Model",
    fields		: [
        {name:"idcontcate",type:"integer"},
        {name:"idcontcatePadre",type:"integer"},
        "nameCate",
        "nombre_padre",
        "imagenCate",
        {name: "nivelCate", type: 'integer'},
        {name: "ordenCate", type: 'integer'},
        {name: "estadoCate", type: 'boolean'},
        {name:"fechamodfCate",type:"date",dateFormat:'Y-m-d H:i:s'},
        {name:"fecharegCate",type:"date",dateFormat:'Y-m-d H:i:s'}
    ]
});