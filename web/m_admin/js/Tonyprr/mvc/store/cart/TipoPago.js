Ext.define("Tonyprr.mvc.store.cart.TipoPago",{
    extend : 'Tonyprr.abstract.Store',
    model  : "Tonyprr.mvc.model.cart.TipoPago",
    data : [
         {tipoPago: 1, descripcion: 'Transferencia Bancaria'},
         {tipoPago: 2, descripcion: 'PayPal'},
         {tipoPago: 3, descripcion: 'VISA'}
   ]
});