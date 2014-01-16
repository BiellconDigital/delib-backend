/* Turkish initialisation for the jQuery UI date picker plugin. */
/* Written by Izzet Emre Erkan (kara@karalamalar.net). */
jQuery(function($){
	$.datepicker.regional['tr'] = {
		closeText: 'kapat',
		prevText: '&#x3c;geri',
		nextText: 'ileri&#x3e',
		currentText: 'bugí¼n',
		monthNames: ['Ocak','Åžubat','Mart','Nisan','MayÄ±s','Haziran',
		'Temmuz','AÄŸustos','Eylí¼l','Ekim','KasÄ±m','AralÄ±k'],
		monthNamesShort: ['Oca','Åžub','Mar','Nis','May','Haz',
		'Tem','AÄŸu','Eyl','Eki','Kas','Ara'],
		dayNames: ['Pazar','Pazartesi','SalÄ±','í‡arÅŸamba','PerÅŸembe','Cuma','Cumartesi'],
		dayNamesShort: ['Pz','Pt','Sa','í‡a','Pe','Cu','Ct'],
		dayNamesMin: ['Pz','Pt','Sa','í‡a','Pe','Cu','Ct'],
		weekHeader: 'Hf',
		dateFormat: 'dd.mm.yy',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['tr']);
});