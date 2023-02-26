mobiscroll.setOptions({
    locale: mobiscroll.localeTr,  // Specify language like: locale: mobiscroll.localePl or omit setting to use default
    theme: 'ios',                 // Specify theme like: theme: 'ios' or omit setting to use default
    themeVariant: 'light'     // More info about themeVariant: https://docs.mobiscroll.com/5-17-1/datetime#opt-themeVariant
});

$(function () {
    // Mobiscroll Date & Time initialization
    $('#demo-compact').mobiscroll().datepicker({
        controls: ['datetime']
    });
});
