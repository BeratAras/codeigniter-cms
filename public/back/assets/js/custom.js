$(document).ready(function(){

    $('.remove-btn').click(function(){

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

    $('.is-active').change(function(){
        var $data     = $(this).prop("checked");
        var $data_url = $(this).data("url");

        if(typeof $data !== "undefined" && typeof $data_url !== "undefined")
        {
            $.post($data_url, {data : $data});
        }
    })
    
    $('.is-cover').change(function(){
        var $data     = $(this).prop("checked");
        var $data_url = $(this).data("url");

        if(typeof $data !== "undefined" && typeof $data_url !== "undefined")
        {
            $.post($data_url, {data : $data}, function(response){
              $(".image-list-container").html(response);
            });
        }
    })

    var uploadSection = Dropzone.forElement("#dropzone");

    uploadSection.on("complete", function(file){

    })
    
})
