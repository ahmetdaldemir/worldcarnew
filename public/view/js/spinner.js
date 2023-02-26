(function ($) {
    $.fn.spinner = function (opts) {
        return this.each(function () {
            var defaults = {value:0, min:0}
            var options = $.extend(defaults, opts)
            var keyCodes = {up:38, down:40}
            var container = $('<div></div>')
            container.addClass('spinner')
            var textField = $(this).addClass('value').attr('maxlength', '2').val(options.value)
                .bind('keyup paste change', function (e) {
                    var field = $(this)
                    if (e.keyCode == keyCodes.up) changeValue(1)
                    else if (e.keyCode == keyCodes.down) changeValue(-1)
                    else if (getValue(field) != container.data('lastValidValue')) validateAndTrigger(field)
                })
            textField.wrap(container)

            var increaseButton = $('<button type="button" class="extras-list__btn btn btn-link increase"><i class="extras-list__btn-icon fas fa-plus"></i></button>').click(function () { changeValue(1) })
            var decreaseButton = $('<button type="button" class="extras-list__btn btn btn-link decrease"><i class="extras-list__btn-icon fas fa-minus"></i></button>').click(function () { changeValue(-1) })

            validate(textField)
            container.data('lastValidValue', options.value)
            textField.before(decreaseButton)
            textField.after(increaseButton)

            function changeValue(delta) {
                textField.val(getValue() + delta)
                validateAndTrigger(textField)
            }

            function validateAndTrigger(field) {
                clearTimeout(container.data('timeout'))
                var value = validate(field)
                if (!isInvalid(value)) {
                    textField.trigger('update', [field, value])
                }
            }

            function validate(field) {
                var value = getValue()
                if (value == 0){
                    increaseButton.removeAttr('disabled');
                    decreaseButton.attr('disabled', 'disabled');
                }else if (value >= options.max){
                    decreaseButton.removeAttr('disabled');
                    increaseButton.attr('disabled', 'disabled');}
                else if(value < options.max){ decreaseButton.removeAttr('disabled'); }

                field.toggleClass('invalid', isInvalid(value)).toggleClass('passive', value === 0)

                if (isInvalid(value)) {
                    var timeout = setTimeout(function () {
                        textField.val(container.data('lastValidValue'))
                        validate(field)
                    }, 500)
                    container.data('timeout', timeout)
                } else {
                    container.data('lastValidValue', value)
                }
                return value
            }

            function isInvalid(value) { return isNaN(+value) || value < options.min; }

            function getValue(field) {
                field = field || textField;
                return parseInt(field.val() || 0, 10)
            }
        })
    }
})(jQuery)
