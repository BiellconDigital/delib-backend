Ext.define("Tonyprr.mvc.model.web.Cliente",{
    extend		: "Tonyprr.abstract.Model",
    fields		: [
        {name:"idCliente", type:"integer"},
        {name:"idtipoDocumento", type:"integer"},
        "nombreTdoc",
        {name:"idPais", type:"integer"},
        "nombre_pais",
        "nombres",
        "apellidoPaterno",
        "apellidoMaterno",
        "email",
        "nroDocumento",
        "genero",//
        {name:"fechaNacimiento", type:"date", dateFormat:'Y-m-d H:i:s'},
        "telefonoCasa",
        "telefonoOficina",
        "movil",
        "clave",
        "foto",
        {name:"recibirOfertasMail", type:"boolean"},
        {name:"recibirOfertasMovil", type:"boolean"},
        {name:"estado", type:"boolean"},
        {name:"fechaRegistro", type:"date", dateFormat:'Y-m-d H:i:s'},
        {name:"fechaModificacion", type:"date", dateFormat:'Y-m-d H:i:s'}
    ]
});