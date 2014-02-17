Ext.define("Tonyprr.mvc.store.web.ContentGaleriaLanguage",{
    extend  : 'Ext.data.Store',//Tonyprr.abstract.StoreRest
    autoLoad: true,
    autoSync: true,
    model  : "Tonyprr.mvc.model.web.ContentGaleriaLanguage",
    //url     : '/admin/web-content-galeria/list-language/',
    proxy: {
        type: 'rest',
        url     : Tonyprr.BASE_URL + '/admin/web-content-galeria/language/',
        actionMethods: {
                create  : 'POST',
                read    : 'GET',
                update  : 'POST',
                destroy : 'DELETE'
        },
        reader: {
            type: 'json',
            root: 'data'
        },
        writer: {
            type: 'json'
        }
    },
    listeners: {
        write: function(store, operation){
            var record = operation.getRecords()[0],
                name = Ext.String.capitalize(operation.action),
                verb;
            if (name == 'Destroy') {
                record = operation.records[0];
                verb = 'Eliminado';
            } else {
                verb = name + 'd';
            }
            //alert(record)
            Tonyprr.App.showNotification({message: Ext.String.format("{0} foto: {1}", verb, record.get('idContentgaleLanguage'))});
        }
    }
});