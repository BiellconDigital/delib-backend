Ext.define("Tonyprr.mvc.store.cart.ProductoCategoriaTree", {
    extend : 'Ext.data.TreeStore',
    model: 'Tonyprr.mvc.model.cart.ProductoCategoria',
    proxy: {
        type: 'ajax',
        actionMethods: {
            read: 'POST'
        },
        url: Tonyprr.BASE_URL + '/admin/Cart-Producto-Categoria/list'
    },
    root: {
        expanded: true
    },
    autoSync : true,
    folderSort: false,
    autoLoad : false
});