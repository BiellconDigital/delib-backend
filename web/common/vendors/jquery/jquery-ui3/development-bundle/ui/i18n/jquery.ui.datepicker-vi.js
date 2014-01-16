/* Vietnamese initialisation for the jQuery UI date picker plugin. */
/* Translated by Le Thanh Huy (lthanhhuy@cit.ctu.edu.vn). */
jQuery(function($){
	$.datepicker.regional['vi'] = {
		closeText: 'ƒêÛng',
		prevText: '&#x3c;Tr∆∞·ªõc',
		nextText: 'Ti·∫øp&#x3e;',
		currentText: 'HÌ¥m nay',
		monthNames: ['Th·ng M·ªôt', 'Th·ng Hai', 'Th·ng Ba', 'Th·ng T∆∞', 'Th·ng NƒÉm', 'Th·ng S·u',
		'Th·ng B·∫£y', 'Th·ng T·m', 'Th·ng ChÌ≠n', 'Th·ng M∆∞·ªùi', 'Th·ng M∆∞·ªùi M·ªôt', 'Th·ng M∆∞·ªùi Hai'],
		monthNamesShort: ['Th·ng 1', 'Th·ng 2', 'Th·ng 3', 'Th·ng 4', 'Th·ng 5', 'Th·ng 6',
		'Th·ng 7', 'Th·ng 8', 'Th·ng 9', 'Th·ng 10', 'Th·ng 11', 'Th·ng 12'],
		dayNames: ['Ch·ªß Nh·∫≠t', 'Th·ª© Hai', 'Th·ª© Ba', 'Th·ª© T∆∞', 'Th·ª© NƒÉm', 'Th·ª© S·u', 'Th·ª© B·∫£y'],
		dayNamesShort: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
		dayNamesMin: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
		weekHeader: 'Tu',
		dateFormat: 'dd/mm/yy',
		firstDay: 0,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['vi']);
});
