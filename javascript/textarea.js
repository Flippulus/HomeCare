function start() {
    $('#characterLeft').text('2048 characters left');
    $('#description').keyup(function() {
        var max = 2048;
        var len = $(this).val().length;
        if (len >= max) {
            $('#characterLeft').text(' No characters left');
        } else {
            var ch = max - len;
            $('#characterLeft').text(ch + ' characters left');
        }
    });
}