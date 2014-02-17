Ext.define("Tonyprr.mvc.model.web.ContentGaleriaLanguage",{
    extend : "Tonyprr.abstract.Model",
    fields : [
        {name:"idContentgaleLanguage",type:"integer"},
        {name:"idcontgale",type:"integer"},
        {name:"idLanguage",type:"integer"},
        {name : 'titulo'},
        {name : 'descripcion'},
        
        {name : 'idioma'}
    ]
    ,idProperty	: 'idContentgaleLanguage'
});