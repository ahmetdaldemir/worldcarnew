mobiscroll.setOptions({
    locale: mobiscroll.localeTr,
    theme: 'ios',
    themeVariant: 'light'
});

$('#date-time-picker').mobiscroll().datepicker({
    controls: ['date', 'time'],
    touchUi: true
});
