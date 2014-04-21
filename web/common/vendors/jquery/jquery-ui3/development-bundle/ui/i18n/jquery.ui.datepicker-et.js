/* Estonian initialisation for the jQuery UI date picker plugin. */
/* Written by Mart Síµmermaa (mrts.pydev at gmail com). */
jQuery(function($){
	$.datepicker.regional['et'] = {
		closeText: 'Sulge',
		prevText: 'Eelnev',
		nextText: 'Jí¤rgnev',
		currentText: 'Tí¤na',
		monthNames: ['Jaanuar','Veebruar','Mí¤rts','Aprill','Mai','Juuni',
		'Juuli','August','September','Oktoober','November','Detsember'],
		monthNamesShort: ['Jaan', 'Veebr', 'Mí¤rts', 'Apr', 'Mai', 'Juuni',
		'Juuli', 'Aug', 'Sept', 'Okt', 'Nov', 'Dets'],
		dayNames: ['Pí¼hapí¤ev', 'Esmaspí¤ev', 'Teisipí¤ev', 'Kolmapí¤ev', 'Neljapí¤ev', 'Reede', 'Laupí¤ev'],
		dayNamesShort: ['Pí¼hap', 'Esmasp', 'Teisip', 'Kolmap', 'Neljap', 'Reede', 'Laup'],
		dayNamesMin: ['P','E','T','K','N','R','L'],
		weekHeader: 'Sm',
		dateFormat: 'dd.mm.yy',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['et']);
}); 