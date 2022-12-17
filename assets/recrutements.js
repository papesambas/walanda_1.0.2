$(document).on('change', '#recrutements_region, #recrutements_cercle, #recrutements_commune', function () {
    let $field = $(this)
    let $form = $field.closest('form')
    let $regionField = $('#recrutements_region')
    let $cercleField = $('#recrutements_cercle')
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
