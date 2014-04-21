/* Czech initialisation for the jQuery UI date picker plugin. */
/* Written by Tomas Muller (tomas@tomas-muller.net). */
jQuery(function($){
	$.datepicker.regional['cs'] = {
		closeText: 'Zavř�t',
		prevText: '&#x3c;Dř�ve',
		nextText: 'Později&#x3e;',
		currentText: 'Nyn�',
		monthNames: ['leden','�nor','březen','duben','květen','červen',
        'červenec','srpen','z�ř�','ř�jen','listopad','prosinec'],
		monthNamesShort: ['led','�no','bře','dub','kvě','čer',
		'čvc','srp','z�ř','ř�j','lis','pro'],
		dayNames: ['neděle', 'ponděl�', '�ter�', 'středa', 'čtvrtek', 'p�tek', 'sobota'],
		dayNamesShort: ['ne', 'po', '�t', 'st', 'čt', 'p�', 'so'],
		dayNamesMin: ['ne','po','�t','st','čt','p�','so'],
		weekHeader: 'T�d',
		dateFormat: 'dd.mm.yy',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['cs']);
});
