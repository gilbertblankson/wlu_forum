
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link rel="shortcut icon" href="img/favicon.png" />

    <title>PHOTO SEARCH RESULTS | WALULEL</title>

    <!-- Bootstrap Core CSS -->
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css">-->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    
    <!-- Normalise CSS CDN -->
<!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.css" type="text/css">-->

    <!-- Custom Fonts -->
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" type="text/css">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="/css/ekko-lightbox.css" type="text/css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="/css/photo-search.css" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <header>
        
       @include('includes.logged-in-navigation')
        
        <div class="photo-search">
            <div class="container-fluid">
                <div class="row">                
	                <div class="col-md-12 col-sm-12 text-center">
	                    <form method="post" action="/search-image" class="browse">
                         {{csrf_field()}}
                            <div class="form-group col-md-10 col-xs-8">
                                <input type="text" name="search_keyword" id="exampleInputFile" class="form-control" placeholder="enter postcode 'BR1', 'BR2' or hashtag">
                            </div>
                            <button type="submit" class="btn btn-outline">SEARCH</button>
                        </form>
	                </div>
                </div>
            </div>
        </div>
        
    </header>


    <section class="content">
        <div class="container">
            <div class="gallery">

                <div class="row">

                <?php $a=0; ?>
                @foreach($photos as $photo)
                 <?php $a++; ?>
                 <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <a class="lightbox" href="uploaded_photos/{{$photo->file_name}}" data-gallery="{{$postcode_gallery}}" data-toggle="lightbox" data-type="image">
                                <img src="uploaded_photos/{{$photo->file_name}}" alt="Park">
                            </a>
                            <div class="caption">
                                <h3>{{$photo->hashtag}}</h3>
                            </div>
                        </div>
                    </div>
                    @if($a%3==0)
                     <div class="clearfix"></div>
                    @endif
                @endforeach

                </div>

            </div>
        </div>
    </section>
    
    
    <footer>
        
        <div class="container">
        
            <div class="row">
            
                <div class="col-md-offset-3 col-md-6 col-sm-12 text-center">
                    
                    <p>
                    
                        <ul class="list-inline list-social">
                    
                            <li class="social-twitter"><a href="https://www.twitter.com/walulel" target="_blank"><i class="fa fa-twitter"></i></a></li>
	                    
	                        <li class="social-linkedin"><a href="https://www.linkedin.com/company-beta/11023236" target="_blank"><i class="fa fa-linkedin"></i></a></li>
	                    
	                        <li class="social-email"><a href="mailto:info@walulel.com"><i class="fa fa-envelope"></i></a></li>
                            
                        </ul>
                    
                    </p>
                
                    <p style="color:#fff">Your locale like you've never known. &copy; Walulel Limited 2017.</p>
                
                </div>
            
            </div>
        
        </div>
        
    </footer>

    <!-- jQuery -->
    <script src="/js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="/js/scripts.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="/js/ekko-lightbox.js"></script>
    
    <script>
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox();
        });
    </script>


   
</body>

</html>