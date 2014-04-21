Ext.define("Tonyprr.mvc.store.cart.ProductoTipo",{
    extend : 'Tonyprr.abstract.Store',
    autoLoad: true,
    model  : "Tonyprr.mvc.model.cart.ProductoTipo",
    url     : '/admin/cart-producto-tipo/list/'
});