$(document).ready(function() {
    $('#countdown').countdown($('#until').html(), function(event) {
        $(this).html(event.strftime('%H Jam %M Menit %S Detik'));
    });
});