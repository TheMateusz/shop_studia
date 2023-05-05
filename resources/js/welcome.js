import './app'
$(function (){

    console.log('welcome.js');

    $('.products-count').change(function(event) {
        event.preventDefault();
        const selectedValue = $(this).find(":selected").val();
        $('.products-count').each(function() {
            $(this).val(selectedValue);
        });
        getProducts($(this).find(":selected").val());
    });

    $('body').on('click', 'button.add-cart-button', function(){
        console.log('click');
        event.preventDefault();
        $.ajax({
            method: "POST",
            url: window.location.origin + window.location.pathname + 'cart/' + $(this).data('id')
        })
        .done(function (){
            Swal.fire({
                title: 'Brawo!',
                text: 'Produkt dodany do koszyka!',
                icon: 'success',
                showCancelButton: true,
                confirmButtonText: '<i class="fas fa-cart-plus"></i> Przejdź do koszyka',
                cancelButtonText: '<i class="fas fa-shopping-bag"></i> Kontynuuj zakupy'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = window.location.origin + window.location.pathname + 'cart/';
                }
            })
        })
        .fail(function () {
            Swal.fire('Oops...', 'Wystąpił błąd', 'error');
        });
    });

    $('a#filter-button').click(function (){
        getProducts($('.products-count').find(":selected").val());
    })

    function getProducts(paginate){
        const form = $('form.sidebar-filter').serialize();
        $.ajax({
            method: "GET",
            url: "/",
            data: form + "&" + $.param({paginate: paginate}),
        }).done(function(response) {
            $('div#products-wrapper').empty();
            $.each(response.data, function (index, product){
                const html =
                    '<div class="col-6 col-md-6 col-lg-4 mb-3">' +
                    '<div class="card h-100 border-0">' +
                    '<div class="card-img-top">' +
                    '<img src="'+ getImage(product) +'" class="img-fluid mx-auto d-block" alt="Zdjęcie '+ product.name +'">' +
                    '</div>' +
                    '<div class="card-body text-center">' +
                    '<h4 class="card-title">' + product.name +
                    '</h4>' +
                    '<h5 class="small">' + product.category.name +
                    '</h5>' +
                    '<h5 class="card-price small text-danger">' +
                    '<i>'+ product.price +' zł</i>' +
                    '</h5>' +
                    '</div>' +
                    '<button class="btn btn-success btn-sm add-cart-button" data-id="' + product.id + '" >' +
                    '<i class="fa-solid fa-cart-plus"></i> Dodaj do koszyka' +
                    '</button>' +
                    '</div>' +
                    '</div>';
                $('div#products-wrapper').append(html);
            })
        })
    }
    function getImage(product,){
        const StoragePath = $('div#products-wrapper').data('storepath');
        const DefaultImage = $('div#products-wrapper').data('defaultimage');

        if (!!product.image_path){
            return StoragePath + '/' + product.image_path;
        }
        return DefaultImage;
    }
})
