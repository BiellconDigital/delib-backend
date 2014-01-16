/* Norwegian initialisation for the jQuery UI date picker plugin. */
/* Written by Naimdjon Takhirov (naimdjon@gmail.com). */

jQuery(function($){
  $.datepicker.regional['no'] = {
    closeText: 'Lukk',
    prevText: '&laquo;Forrige',
    nextText: 'Neste&raquo;',
    currentText: 'I dag',
    monthNames: ['januar','februar','mars','april','mai','juni','juli','august','september','oktober','november','desember'],
    monthNamesShort: ['jan','feb','mar','apr','mai','jun','jul','aug','sep','okt','nov','des'],
    dayNamesShort: ['sí¸n','man','tir','ons','tor','fre','lí¸r'],
    dayNames: ['sí¸ndag','mandag','tirsdag','onsdag','torsdag','fredag','lí¸rdag'],
    dayNamesMin: ['sí¸','ma','ti','on','to','fr','lí¸'],
    weekHeader: 'Uke',
    dateFormat: 'dd.mm.yy',
    firstDay: 1,
    isRTL: false,
    showMonthAfterYear: false,
    yearSuffix: ''
  };
  $.datepicker.setDefaults($.datepicker.regional['no']);
});
