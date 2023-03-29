$(function() {
    $('.delete').click(function (){
        Swal.fire({
            title: 'Czy na pewno chcesz usunąć rekord?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Tak',
            cancelButtonText: 'Nie'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    method: "DELETE",
                    url: "/users/"+ $(this).data('id')
                }).done(function(response) {
                    window.location.reload();
                }).fail(function (data){
                    Swal.fire('Oops...', data.responseJSON.message, data.responseJSON.status)
                });
            }
        })
    })
});
