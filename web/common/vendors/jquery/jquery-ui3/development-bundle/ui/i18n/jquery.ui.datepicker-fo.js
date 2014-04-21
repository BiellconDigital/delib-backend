/* Faroese initialisation for the jQuery UI date picker plugin */
/* Written by Sverri Mohr Olsen, sverrimo@gmail.com */
jQuery(function($){
	$.datepicker.regional['fo'] = {
		closeText: 'Lat aftur',
		prevText: '&#x3c;Fyrra',
		nextText: 'NÌ¶sta&#x3e;',
		currentText: 'Ìç dag',
		monthNames: ['Januar','Februar','Mars','AprÌ≠l','Mei','Juni',
		'Juli','August','September','Oktober','November','Desember'],
		monthNamesShort: ['Jan','Feb','Mar','Apr','Mei','Jun',
		'Jul','Aug','Sep','Okt','Nov','Des'],
		dayNames: ['Sunnudagur','M·nadagur','TÌΩsdagur','Mikudagur','HÛsdagur','FrÌ≠ggjadagur','Leyardagur'],
		dayNamesShort: ['Sun','M·n','TÌΩs','Mik','HÛs','FrÌ≠','Ley'],
		dayNamesMin: ['Su','M·','TÌΩ','Mi','HÛ','Fr','Le'],
		weekHeader: 'Vk',
		dateFormat: 'dd-mm-yy',
		firstDay: 0,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['fo']);
});
