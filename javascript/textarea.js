function start(){$('#characterLeft').innerHTML='255 characters left';}
$('#description').keyup(function () {
    alert("Test2");
    var max = 255;
    var len = $(this).val().length;
    if (len >= max) {
        $('#characterLeft').text(' No characters left');
    } else {
        var ch = max - len;
        $('#characterLeft').text(ch + ' characters left');
    }
    alert("Test3");
});