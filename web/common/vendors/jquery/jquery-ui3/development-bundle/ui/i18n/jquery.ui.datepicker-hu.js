/* Hungarian initialisation for the jQuery UI date picker plugin. */
/* Written by Istvan Karaszi (jquery@spam.raszi.hu). */
jQuery(function($){
	$.datepicker.regional['hu'] = {
		closeText: 'bez·r·s',
		prevText: '&laquo;&nbsp;vissza',
		nextText: 'el≈ëre&nbsp;&raquo;',
		currentText: 'ma',
		monthNames: ['Janu·r', 'Febru·r', 'M·rcius', 'ÌÅprilis', 'M·jus', 'JÌ∫nius',
		'JÌ∫lius', 'Augusztus', 'Szeptember', 'OktÛber', 'November', 'December'],
		monthNamesShort: ['Jan', 'Feb', 'M·r', 'ÌÅpr', 'M·j', 'JÌ∫n',
		'JÌ∫l', 'Aug', 'Szep', 'Okt', 'Nov', 'Dec'],
		dayNames: ['Vas·rnap', 'HÈtfÌ∂', 'Kedd', 'Szerda', 'CsÌºtÌ∂rtÌ∂k', 'PÈntek', 'Szombat'],
		dayNamesShort: ['Vas', 'HÈt', 'Ked', 'Sze', 'CsÌº', 'PÈn', 'Szo'],
		dayNamesMin: ['V', 'H', 'K', 'Sze', 'Cs', 'P', 'Szo'],
		weekHeader: 'HÈ',
		dateFormat: 'yy-mm-dd',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: true,
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['hu']);
});
