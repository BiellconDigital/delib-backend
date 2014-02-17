Ext.define("Tonyprr.mvc.store.web.ContentCategoriaTree", {
    extend : 'Ext.data.TreeStore',
    model: 'Tonyprr.mvc.model.web.ContentCategoria',
    proxy: {
        type: 'ajax',
        actionMethods: {
            read: 'POST'
        },
        url: Tonyprr.BASE_URL + '/admin/Web-Content-Categoria/list'
    },
    root: {
        expanded: true
    },
    autoSync : false,
    folderSort: false
//    ,autoLoad : false
});