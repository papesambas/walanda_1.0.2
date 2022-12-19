$(document).on('change', '#personnels_region, #personnels_cercle, #personnels_commune', function () {
    let $field = $(this)
    let $form = $field.closest('form')
    let $regionField = $('#personnels_region')
    let $cercleField = $('#personnels_cercle')
    let target = '#' + $field.attr('id').replace('commune', 'lieuNaissance').replace('cercle', 'commune').replace('region', 'cercle')
    let data = {}
    data[$regionField.attr('name')] = $regionField.val()
    data[$cercleField.attr('name')] = $cercleField.val()
    data[$field.attr('name')] = $field.val()

    $.ajax({
        url: $form.attr('action'),
        type: $form.attr('method'),
        data: data,
        complete: function (html) {
            let $input = $(html.responseText).find(target)
            $(target).replaceWith($input);
        }
    });
})
