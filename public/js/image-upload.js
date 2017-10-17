$(document).ready(function () {

     $(".upload_button").click(function(e){
      
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="_token"]').attr('content')
                }
            });//end ajax setup

            e.preventDefault();

             var processing_url = "/upload-image";


             $.ajax({
                 url: processing_url,
                 type: 'POST',
                 data: new FormData($("#image-upload-form")[0]),
                 dataType: 'json',
                 contentType: false,
                 processData: false,
                 beforeSend: function (xhr) {
                     xhr.setRequestHeader('X-CSRF-TOKEN', $("#token").attr('content'));
                 },
                 success: function (feedback) {
                     alert('Image uploaded!');
                 },
                 error: function (feedback) {
                     alert("error");
                 }
             });

     });
   
});