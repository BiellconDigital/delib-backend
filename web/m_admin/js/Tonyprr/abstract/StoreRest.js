Ext.define("Tonyprr.abstract.StoreRest",{
    extend : 'Ext.data.Store',
    model  : "Tonyprr.abstract.Model",
    autoLoad: false,
    autoSync: true,
    pageSize: 15,
    method : 'POST',
    constructor	: function(options) {
        var me = this;
        Ext.apply(me,options || {});
        me.proxy = {
            type	: "ajax",
            url		: Tonyprr.BASE_URL + me.url,
            actionMethods: {
                read: 'POST'
            },
            extraParams: {},
            reader	: {
                type            : "json",
                root            : "data",
                successProperty	: "success",
                totalProperty	: "total"
            },
            writer: {
                type: 'json'
            }
        };
        me.callParent(arguments);
    }
    
});