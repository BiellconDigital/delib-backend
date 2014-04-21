Ext.define("Tonyprr.mvc.model.web.TipoDocumento",{
    extend		: "Tonyprr.abstract.Model",
    fields		: [
        {name:"idtipoDocumento", type:"integer"},
        "nombreTdoc",
        "descripcionTdoc",
        {name:"longitudTdoc", type:"integer"},
        {name:"estadoTipodoc", type:"boolean"},
        {name:"tiempoModif", type:"date", dateFormat:'Y-m-d H:i:s'}
    ]
});