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

const addContrat = () => {
    const collectionHolder = document.querySelector('personnels_contrats');
    console.log(collectionHolder.dataset.prototype);
};

document.querySelector('#new-contrat').addEventListener('click', addContrat);

/*const newItem = (e) =>{
    const collectionHolder = document.querySelector(e.currentTarget.dataset.collection);

    const item = document.createElement("div");
    item.classList.add("col-12");

    item.innerHTML = collectionHolder
    .dataset
    .prototype
    .replace(/__name__/g,collectionHolder.dataset.index);
    
    item.querySelector('.btn-remove').addEventListener('click', () => item.remove());

    collectionHolder.appendChild(item);

    collectionHolder.dataset.index++;
    
};


document
.querySelectorAll('.btn-remove')
.forEach(btn=>btn.addEventListener("click",(e) => e.currentTarget.closest(".col-12").remove()));

document
.querySelectorAll('.btn-new')
.forEach(btn=>btn.addEventListener("click",newItem));

*/