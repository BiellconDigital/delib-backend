Ext.define("Tonyprr.mvc.model.cart.MarcaLanguage",{
    extend		: "Tonyprr.abstract.Model",
    fields		: [
        {name:"idMarcaLanguage",type:"integer"},
        {name:"idmarca",type:"integer"},
        {name:"idLanguage",type:"integer"},
        {name : 'detalle'},
        {name : 'adjunto'},
        
        {name : 'idioma'}
    ]
});