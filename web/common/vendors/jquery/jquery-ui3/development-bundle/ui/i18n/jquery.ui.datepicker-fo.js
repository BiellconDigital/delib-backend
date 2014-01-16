/* Faroese initialisation for the jQuery UI date picker plugin */
/* Written by Sverri Mohr Olsen, sverrimo@gmail.com */
jQuery(function($){
	$.datepicker.regional['fo'] = {
		closeText: 'Lat aftur',
		prevText: '&#x3c;Fyrra',
		nextText: 'N�sta&#x3e;',
		currentText: '� dag',
		monthNames: ['Januar','Februar','Mars','Apr�l','Mei','Juni',
		'Juli','August','September','Oktober','November','Desember'],
		monthNamesShort: ['Jan','Feb','Mar','Apr','Mei','Jun',
		'Jul','Aug','Sep','Okt','Nov','Des'],
		dayNames: ['Sunnudagur','M�nadagur','T�sdagur','Mikudagur','H�sdagur','Fr�ggjadagur','Leyardagur'],
		dayNamesShort: ['Sun','M�n','T�s','Mik','H�s','Fr�','Ley'],
		dayNamesMin: ['Su','M�','T�','Mi','H�','Fr','Le'],
		weekHeader: 'Vk',
		dateFormat: 'dd-mm-yy',
		firstDay: 0,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['fo']);
});
