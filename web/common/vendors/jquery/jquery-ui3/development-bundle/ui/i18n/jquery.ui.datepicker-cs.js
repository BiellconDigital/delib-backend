/* Czech initialisation for the jQuery UI date picker plugin. */
/* Written by Tomas Muller (tomas@tomas-muller.net). */
jQuery(function($){
	$.datepicker.regional['cs'] = {
		closeText: 'ZavÅ™í­t',
		prevText: '&#x3c;DÅ™í­ve',
		nextText: 'PozdÄ›ji&#x3e;',
		currentText: 'Nyní­',
		monthNames: ['leden','íºnor','bÅ™ezen','duben','kvÄ›ten','Äerven',
        'Äervenec','srpen','záÅ™í­','Å™í­jen','listopad','prosinec'],
		monthNamesShort: ['led','íºno','bÅ™e','dub','kvÄ›','Äer',
		'Ävc','srp','záÅ™','Å™í­j','lis','pro'],
		dayNames: ['nedÄ›le', 'pondÄ›lí­', 'íºterí½', 'stÅ™eda', 'Ätvrtek', 'pátek', 'sobota'],
		dayNamesShort: ['ne', 'po', 'íºt', 'st', 'Ät', 'pá', 'so'],
		dayNamesMin: ['ne','po','íºt','st','Ät','pá','so'],
		weekHeader: 'Tí½d',
		dateFormat: 'dd.mm.yy',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['cs']);
});
