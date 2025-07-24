if($('[role=datetimepicker]').length) {
    $('[role=datetimepicker]').each(function() {
        $(this).datetimepicker
        ({
            setDate: new Date(),
            allowInputToggle: true,
            autoclose: true,
            showTodayButton: true,
            format: 'DD-MMMM-YYYY HH:mm',
            icons: {
                time: 'fas fa-clock',
                date: 'fas fa-calendar',
                up: 'fas fa-arrow-up',
                down: 'fas fa-arrow-down',
                previous: 'fas fa-arrow-circle-left',
                next: 'fas fa-arrow-circle-right',
                today: 'far fa-calendar-check-o',
                clear: 'fas fa-trash',
                close: 'far fa-times'
            }
        })
    })

    function getFormattedDate(date) {
        var day   = date.getDate();
        var month = date.getMonth() + 1;
        var year  = date.getFullYear().toString().slice(2);
        return day + '-' + month + '-' + year;
    }
}
$('textarea').each(function() {
    this.setAttribute('style', 'height:' + (this.scrollHeight) + 'px;min-height:50px;overflow-y:hidden;');
}).on('input', function() {
    this.style.height = 'auto';
    this.style.height = (this.scrollHeight) + 'px';
});
if($('[role=datepicker]').length) {
    $('[role=datepicker]').each(function() {
        $(this).datetimepicker
        ({
            setDate: new Date(),
            allowInputToggle: true,
            showClose: true,
            showTodayButton: true,
            format: 'DD-MMMM-YYYY',
            icons: {
                time: 'fas fa-clock',
                date: 'fas fa-calendar',
                up: 'fas fa-arrow-up',
                down: 'fas fa-arrow-down',
                previous: 'fas fa-arrow-circle-left',
                next: 'fas fa-arrow-circle-right',
                today: 'far fa-calendar-check-o',
                clear: 'fas fa-trash',
                close: 'far fa-times'
            }
        })
    })
}
if($('[role=timepicker]').length) {
    $('[role=timepicker]').each(function() {
        $(this).attr('readonly', true),
            $(this).datetimepicker({
                allowInputToggle: true,
                ignoreReadonly: true,
                showClose: true,
                showTodayButton: true,
                format: 'HH:mm'
            })
    })
}

function decimal(nominal) {
    if(nominal < 0) {
        neg     = true;
        nominal = Math.abs(nominal);
    }
    return parseFloat(nominal, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString();
}

