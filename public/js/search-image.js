$(document).ready(function () {

    $(".search-image-button").click(function (e) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });//end ajax setup

        e.preventDefault();

        var processing_url = "/search-image";

        var search_keyword = $('.search_keyword').val();

        $.ajax({
            url: processing_url,
            type: 'POST',
            data: new FormData($("#search_image_form")[0]),
            dataType: 'json',
            contentType: false,
            processData: false,
            beforeSend: function (xhr) {
                xhr.setRequestHeader('X-CSRF-TOKEN', $("#token").attr('content'));
            },
            success: function (feedback) {
                var images="";
               // console.log(feedback);
               $.each(feedback,function(key,item){
                   images += "<div class='item'><a href='/uploaded_photos/"+item.file_name+"' data-toggle='lightbox' data-gallery='postcode' data-type='image'>";
                   images += "<img src='/uploaded_photos/"+item.file_name+"' class='img-responsive' alt='Owl Image'>";
                   images += "</a></div >";
               }); 
              // console.log(images);
               //$('.sth').html(images);
            },
            error: function (feedback) {
                alert("error");
            }
        });

    });

});