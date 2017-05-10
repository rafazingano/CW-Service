$('select[name=state], select[name=state_id]').change(function () {
    var idEstado = $(this).val();
    $.get('/get-cities/' + idEstado, function (cidades) {
        $('select[name=city], select[name=city_id]').empty();
        $.each(cidades, function (key, value) {
            $('select[name=city], select[name=city_id]').append('<option value=' + key + '>' + value + '</option>');
        });
    });
});

$('select[name=city], select[name=city_id]').change(function () {
    var idCity = $(this).val();
    $.get('/get-neighborhoods/' + idCity, function (bairros) {
        $('select[name=neighborhood], select[name=neighborhood_id]').empty();
        $.each(bairros, function (key, value) {
            $('select[name=neighborhood], select[name=neighborhood_id]').append('<option value=' + key + '>' + value + '</option>');
        });
    });
});

$('.mais').click(function () {
    var rand_number = Math.floor((Math.random() * 10000) + 10);
    $('.form-localizacao-prestador').append('<input type="hidden" name="location[' + rand_number + '][state_id]" value="' + $('#estado').val() + '">');
    $('.form-localizacao-prestador').append('<input type="hidden" name="location[' + rand_number + '][city_id]" value="' + $('#cidade').val() + '">');
    $('.form-localizacao-prestador').append('<input type="hidden" name="location[' + rand_number + '][neighborhood_id]" value="' + $('#bairro').val() + '">');
});

$('.address').click(function () {
    var d = $(this).val();
    if (d === 'my') {
        $('div.other-location').css('display', 'none');
    } else {
        $('div.other-location').css('display', 'block');
    }
});