$(document).ready(function(){

    $(".news-type-select").change(function(){
        $selectValue = $(this).val();

        if($selectValue == "image")
        {
            $('.image-upload-container').fadeIn();
            $('.video-url-container').fadeOut();
        }
        else if($selectValue == "video")
        {
            $('.image-upload-container').fadeOut();
            $('.video-url-container').fadeIn();
        }
    })
})