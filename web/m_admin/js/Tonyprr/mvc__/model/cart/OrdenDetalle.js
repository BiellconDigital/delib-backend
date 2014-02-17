Ext.define("Tonyprr.mvc.model.cart.OrdenDetalle",{
    extend : "Tonyprr.abstract.Model",
    fields : [
        {name:"idOrdenDetalle", type:"integer"},
        "productoNombre",
        {name:"cantidad", type:"float"},
        {name:"precioUnitario", type:"float"},
        {name:"precioTotal", type:"float"},
        {name:"impuestoTotal", type:"float"},
        {name:"impuestoRatio", type:"float"},
        {name:"fechaRegistro", type:"date", dateFormat:'Y-m-d H:i:s'},
        {name:"fechaModificacion", type:"date", dateFormat:'Y-m-d H:i:s'},
        {name:"idproducto", type:"integer"},
        {name:"idOrden", type:"integer"}
    ]
});