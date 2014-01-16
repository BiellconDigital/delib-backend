/**
 * @class Tonyprr.abstract.Form
 * @extends Ext.form.Panel
 * @autor Antonio Ramos
 * @date 14-10-2011
 *
 * Form panel
 *
 **/

Ext.define("Tonyprr.abstract.Form",{
    extend 		: "Ext.form.Panel",
    columns		: 1,
    border		: false,
    defaultType		: 'textfield',
    layout              : 'anchor',
    frame               : false,
    fieldDefaults	: {
        labelAlign	: 'left',
        labelWidth      : 90,
        msgTarget	: 'side',
        anchor          : '99%'
//        width		: 250
    },
    bodyPadding		: 3,
//    autoScroll		: true,
    initComponent	: function(){
        this.layout.columns = this.columns;
        this.callParent();
    }
});