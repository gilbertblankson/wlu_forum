var likePost;
var dislikePost;

$(document).ready(function(){
 
 likePost = function(a,b){
     /*
        a-user id
        b- post id
      */

      $.ajaxSetup({
          headers:{
              'X-CSRF-TOKEN':$('meta[name="_token"]').attr('content')
          }
      });//end ajax setup

      var requestData = {
          user_id:a,
          post_id:b,
      };

      var processing_url = "/likepost";

      $.ajax({
          url:processing_url,
          type:'POST',
          data:requestData,
          dataType:'json',
          beforeSend: function(xhr){
            xhr.setRequestHeader('X-CSRF-TOKEN',$("#token").attr('content'));
          },
          success:function(feedback){
            location.reload();
          },
          error:function(feedback){
              alert("error");
          }
      });

        
      
 };

 /***dislike post */
 dislikePost = function (a, b) {
     /*
        a-user id
        b- post id
      */

     $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
         }
     });//end ajax setup

     var requestData = {
         user_id: a,
         post_id: b,
     };

     var processing_url = "/dislikepost";

     $.ajax({
         url: processing_url,
         type: 'POST',
         data: requestData,
         dataType: 'json',
         beforeSend: function (xhr) {
             xhr.setRequestHeader('X-CSRF-TOKEN', $("#token").attr('content'));
         },
         success: function (feedback) {
             location.reload();
             //alert('good');
         },
         error: function (feedback) {
             alert("error");
         }
     });



 };

});