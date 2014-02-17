Ext.define('Tonyprr.mvc.store.cart.ProductoCategoriaTipo', {
        extend  : 'Ext.data.Store',
        model  : "Tonyprr.mvc.model.cart.ProductoCategoriaTipo",
        pageSize: 15,
        method : 'POST',
        autoLoad: false,
        autoSync: true,
        proxy: {
            type: 'ajax',
            actionMethods: {
                read: 'POST'
            },
            api: {
                read: Tonyprr.BASE_URL+ '/admin/cart-producto-categoria-tipo/list',
                create: Tonyprr.BASE_URL+ '/admin/cart-producto-categoria-tipo/save',
                update: Tonyprr.BASE_URL+ '/admin/cart-producto-categoria-tipo/save',
                destroy: Tonyprr.BASE_URL+ '/admin/cart-producto-categoria-tipo/delete'
            },
            reader: {
                type: 'json',
                idProperty : 'idProductocateTipo',
                successProperty: 'success',
                root: 'data',
                messageProperty: 'msg',
                totalProperty	: "total"
            },
            writer: {
                type: 'json',
                writeAllFields: true,
                root: 'data'
            },
            listeners: {
                exception: function(proxy, response, operation){
                    Ext.MessageBox.show({
                        title: 'REMOTE EXCEPTION',
                        msg: operation.getError(),
                        icon: Ext.MessageBox.ERROR,
                        buttons: Ext.Msg.OK
                    });
                }
            }
        },
        listeners: {
            write: function(proxy, operation){
//                if (operation.action == 'destroy') {
//                    main.child('#form').setActiveRecord(null);
//                }
                if (operation.action != 'create') {
                    this.load();
                }
//                Ext.Msg.alert(operation.action, operation.resultSet.msg);
            }
        }
});
