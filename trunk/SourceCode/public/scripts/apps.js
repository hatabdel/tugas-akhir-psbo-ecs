var i = 0;
$(document).ready(function() {
    $('#countdown').countdown($('#until').html(), function(event) {
        $(this).html(event.strftime('%H Jam %M Menit %S Detik'));
        var until = $('#until_timestamp').html();
        var time_now = event.timeStamp;
        
        if ((until*1000) < time_now) {
            $("#form_quiz").submit();
        }
    });
});