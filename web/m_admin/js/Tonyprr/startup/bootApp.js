Ext.Loader.setConfig({
    enabled : true,
    paths   : {
        Tonyprr : Tonyprr.Constants.JS_PATH+"/Tonyprr",
        ux     : Tonyprr.Constants.JS_PATH+"/vendors/ux",
        'Ext.ux.form.field': Tonyprr.Constants.JS_PATH+"/vendors/ux/form/field"
    } 
});

//Ext.require("Tonyprr.abstract.MessageBox");
Ext.require("Tonyprr.mvc.App");
Ext.require("Tonyprr.core.Lib");
Ext.require("ux.RowExpander");
Ext.require([ 'Ext.ux.form.field.TinyMCE' ]);

function closeSessionInac() {
    Tonyprr.App.getLogoutButton().exitSystem(false);
}

Ext.onReady(function() {
    Tonyprr.App = Ext.create("Tonyprr.mvc.App", {
            name		: "Tonyprr.App",

            listeners : {
                ready : function(){
                    setTimeout(function(){
                        Ext.get("loading").remove();
                        Ext.get("loading-mask").fadeOut({remove:true});
                    },250);
                }
            }
    });
});
