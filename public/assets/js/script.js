$('select#state').change(function () {
    var idEstado = $(this).val();
    $.get('/get-cities/' + idEstado, function (cidades) {
        $('select#city').empty();
        $.each(cidades, function (key, value) {
            $('select#city').append('<option value=' + key + '>' + value + '</option>');
        });
    });
});

$('select#city').change(function () {
    var idCity = $(this).val();
    $.get('/get-neighborhoods/' + idCity, function (bairros) {
        $('select#neighborhood').empty();
        $.each(bairros, function (key, value) {
            $('select#neighborhood').append('<option value=' + key + '>' + value + '</option>');
        });
    });
});

$('.mais').click(function () {
    var rand_number = Math.floor((Math.random() * 10000) + 10);
    $('.form-localizacao-prestador').append('<input type="hidden" name="location[' + rand_number + '][state_id]" value="' + $('#state').val() + '">');
    $('.form-localizacao-prestador').append('<input type="hidden" name="location[' + rand_number + '][city_id]" value="' + $('#city').val() + '">');
    $('.form-localizacao-prestador').append('<input type="hidden" name="location[' + rand_number + '][neighborhood_id]" value="' + $('#neighborhood').val() + '">');
});

$('.mais-tag').click(function () {
    var rand_number = Math.floor((Math.random() * 10000) + 10);
    $('.form-tag-prestador').append('<input type="hidden" name="tag[' + rand_number + ']" value="' + $('#tag').val() + '">');
});

$('.address').click(function () {
    var d = $(this).val();
    if (d === 'my') {
        $('div.other-location').css('display', 'none');
    } else {
        $('div.other-location').css('display', 'block');
    }
});