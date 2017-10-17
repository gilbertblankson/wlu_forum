$(document).ready(function () {

     $(".upload_button").click(function(e){
      
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="_token"]').attr('content');
                }
            });//end ajax setup

            e.preventDefault();

     });
   
});