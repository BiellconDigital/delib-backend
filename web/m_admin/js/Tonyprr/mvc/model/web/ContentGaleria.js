Ext.define("Tonyprr.mvc.model.web.ContentGaleria",{
    extend		: "Tonyprr.abstract.Model",
    fields		: [
        {name:"idcontgale",type:"integer"},
        {name:"idcontent",type:"integer"},
        {name: "ordenGale", type: 'integer'},
        "imagenGale",
        {name:"fecharegGale",type:"date",dateFormat:'Y-m-d H:i:s'}
    ]
});