$(document).ready(function(){

    $('.remove-btn').click(function(e){

        var $data_url = $(this).data("url");

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: 'btn btn-success',
              cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
          })
          
          swalWithBootstrapButtons.fire({
            title: 'Silmek istediğinizden emin misiniz?',
            text: "Bu işlem geri alınamaz!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sil',
            cancelButtonText: 'İptal',
            reverseButtons: true
          }).then((result) => {
            if (result.value) 
            {
              window.location.href = $data_url;
            }
          })
    })
    
})
