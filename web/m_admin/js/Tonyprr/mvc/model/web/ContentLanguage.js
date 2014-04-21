Ext.define("Tonyprr.mvc.model.web.ContentLanguage",{
    extend : "Tonyprr.abstract.Model",
    fields : [
        {name:"idContentLanguage",type:"integer"},
        {name:"idcontent",type:"integer"},
        {name:"idLanguage",type:"integer"},
        {name : 'descripcion'},
        {name : 'intro'},
        {name : 'detalle'},
        {name : 'imagen'},
        {name : 'adjunto'},
        "url",
        "adicional1",
        "adicional2",
        
        {name : 'idioma'}
    ]
});