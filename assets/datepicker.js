const jquery = require('jquery');

require('bootstrap-datepicker/js/bootstrap-datepicker')
require('bootstrap-datepicker/js/locales/bootstrap-datepicker.fr')
require('bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')
/*$(document).ready(function (){
    $('.input-daterange input').each(function () {
        $(this).datepicker({
            format: 'dd/mm/YYYY'
        });
    });
});*/

jQuery(function ($) {
    $('.naiss-js-datepicker').datepicker({
        format: 'yyyy-mm-dd',
        language: 'fr',
        todayHighlight: true,
        todayBtn: 'linked',
        startDate: new Date(),
        autoclose: true,
        todayHighlight: true,
        //minDate: new Date(new Date().setDate(new Date().getDate() - 5)), //this will be today's date
        //maxDate: new Date(new Date().setDate(new Date().getDate() + 5))
        startDate: new Date(new Date().setDate(new Date().getDate() - 20075)), //this will be today's date
        endDate: new Date(new Date().setDate(new Date().getDate() - 7300))
    });

});

jQuery(function ($) {
    $('.debut-js-datepicker').datepicker({
        format: 'yyyy-mm-dd',
        language: 'fr',
        todayHighlight: true,
        todayBtn: 'linked',
        daysOfWeekDisabled: [0, 6],

        startDate: new Date(),
        autoclose: true,
        todayHighlight: true,
        //minDate: new Date(new Date().setDate(new Date().getDate() - 5)), //this will be today's date
        //maxDate: new Date(new Date().setDate(new Date().getDate() + 5))
        startDate: new Date(new Date().setDate(new Date().getDate() - 20075)), //this will be today's date
        endDate: new Date(new Date().setDate(new Date().getDate() - 7300))
    });

});


