/**
 * @class Tonyprr.core.Lib
 * @extends Object
 * requires 
 * @autor Antonio Ramos
 * @date 2011-10-18  12:50
 *
 * Description
 *
 *
 **/

Ext.define("Tonyprr.core.Lib", {
    singleton	 : true,
    checkRender  : function (data) {
        if(data === true)
            return '<img src="'+Tonyprr.Constants.IMAGE_ACEPT+'">';
        else
            return '<img src="'+Tonyprr.Constants.IMAGE_CROSS+'">';
    },
    exceptionAlert : function (var_error) {
	if(var_error.description)
		Ext.MessageBox.alert('Error!', 'Problemas con el Sistema: '+var_error.description);
	else
		Ext.MessageBox.alert('Error!', 'Problemas con el Sistema: '+var_error);
    }

});

