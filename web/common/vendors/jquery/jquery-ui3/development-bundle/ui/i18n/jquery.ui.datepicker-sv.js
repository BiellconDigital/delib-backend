/* Swedish initialisation for the jQuery UI date picker plugin. */
/* Written by Anders Ekdahl ( anders@nomadiz.se). */
jQuery(function($){
    $.datepicker.regional['sv'] = {
		closeText: 'Stí¤ng',
        prevText: '&laquo;Fí¶rra',
		nextText: 'Ní¤sta&raquo;',
		currentText: 'Idag',
        monthNames: ['Januari','Februari','Mars','April','Maj','Juni',
        'Juli','Augusti','September','Oktober','November','December'],
        monthNamesShort: ['Jan','Feb','Mar','Apr','Maj','Jun',
        'Jul','Aug','Sep','Okt','Nov','Dec'],
		dayNamesShort: ['Sí¶n','Mí¥n','Tis','Ons','Tor','Fre','Lí¶r'],
		dayNames: ['Sí¶ndag','Mí¥ndag','Tisdag','Onsdag','Torsdag','Fredag','Lí¶rdag'],
		dayNamesMin: ['Sí¶','Mí¥','Ti','On','To','Fr','Lí¶'],
		weekHeader: 'Ve',
        dateFormat: 'yy-mm-dd',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''};
    $.datepicker.setDefaults($.datepicker.regional['sv']);
});
