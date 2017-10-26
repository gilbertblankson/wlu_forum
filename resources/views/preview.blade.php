@include('includes.page-meta-data')

    <title>Welcome | WALULEL</title>
    <meta id="token" name="csrf-token" content="{{csrf_token()}}">
    <!-- Plugin CSS -->
    <link rel="stylesheet" href="/css/owl.carousel.css" type="text/css">
    <link rel="stylesheet" href="/css/owl.theme.css" type="text/css">
    <link rel="stylesheet" href="/css/owl.transitions.css" type="text/css">
    <link rel="stylesheet" href="/css/ekko-lightbox.css" type="text/css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="/css/preview.css" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <header>
       <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/preview">
                    	<img src="/img/logo_brand.png" alt="Walulel Limited" class="img-responsive">
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                       <li class="active hidden"><a href="index.html">HOME</a></li>
                        <li><a href="/about">ABOUT</a></li>
                        <li><a href="/team">TEAM</a></li>
                        <li><a href="/survey">SURVEY</a></li>
                        <li><a href="/contact">CONTACT</a></li>
                        <li><a href="/search-vor-1">SEARCH &nbsp;<i class="fa fa-search"></i></a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{strtoupper(Auth::user()->firstname)}}&nbsp; <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="/logout">Log Out</a></li>
                            </ul>
                        </li>

                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        
        <div class="hero-bg">
            <div class="container">
                <div class="row">                
	                <div class="col-md-12 col-sm-12 text-center">
	                    <h3 class="padding">Welcome to Walulel Limited Preview page sample</h3>
	                </div>
                </div>
            </div>
        </div>
        
    </header>


    <section class="content">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4 image-container">
                    <a href="#"><img src="img/img-1.jpg" class="img-responsive thumbnail image" alt="Walulel Limited" data-toggle="modal" data-target="#upload"></a>
                    <div class="middle">
                        <div class="text">
                            <i class="fa fa-camera fa-2x" data-toggle="modal" data-target="#upload"></i>
                        </div>
                    </div>
                    <h4>Upload or View Photos</h4>
                </div>
                <div class="col-md-4 image-container">
                    <a href="/community"><img src="img/img-2.jpg" class="img-responsive thumbnail image" alt="Walulel Limited"></a>
                    <div class="middle">
                        <div class="text">
                            <i class="fa fa-comments fa-2x"></i>
                        </div>
                    </div>
                    <h4>Join the Community</h4>
                </div>
                <div class="col-md-4 image-container">
                    <a href="#"><img src="img/img-3.jpg" class="img-responsive thumbnail image" alt="Walulel Limited"></a>
                    <div class="middle">
                        <div class="text">
                            <i class="fa fa-search fa-2x"></i>
                        </div>
                    </div>
                    <h4>Search Page</h4>
                </div>
            </div>
        </div>
    </section>
    
    
     @include('includes.site-footer')

  
    <!-- Modal for the uploading on a picture to the postcode -->
    <div class="modal fade" id="upload" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Upload a photo</h4>
                </div>
                  <div class="modal-body">
                    <div class="row">
                        <div role="tabpanel">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#uploadTab" aria-controls="uploadTab" role="tab" data-toggle="tab">Upload</a>

                                </li>
                                <li role="presentation"><a href="#browseTab" aria-controls="browseTab" role="tab" data-toggle="tab">Browse</a>

                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="uploadTab" style="min-height: 300px; padding-top: 10px; padding-bottom: 10px;">
                                    <form method="post" enctype="multipart/form-data" id="image-upload-form" class="upload">
                                        {{csrf_field()}}
                                        <div class="form-group col-md-12">
                                            <label for="exampleInputFile">File input</label>
                                            <input type="file" name="image_file" class="image_file" id="exampleInputFile">
                                            <p class="help-block">Image relating to the Postcode.</p>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="exampleInputFile">Tell us what this picture is</label>
                                            <input type="text" name="hash-tag" id="exampleInputFile" class="hash-tag form-control" placeholder="#hashtag">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="exampleInputFile">Tell us where this photo is</label>
                                            <input type="text" name="post-code" id="exampleInputFile" class="form-control" placeholder="postcode 'BR1', 'BR2'">
                                        </div>
                                        <div class="form-group col-md-6 col-md-offset-6 pull-right">
                                            <button type="button" class="btn upload_button">Upload</button>
                                        </div>
                                    </form>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="browseTab" style="min-height: 300px; padding-top: 10px; padding-bottom: 10px;">
                                    <form method="post" id="search_image_form" class="browse">
                                    {{csrf_field()}}
                                        <div class="form-group col-sm-9">
                                            <input type="text" name="search_keyword" id="exampleInputFile" class="form-control search-keyword" placeholder="enter postcode 'BR1', 'BR2'">
                                        </div>
                                        <button type="submit" class="btn btn-outline search-image-button">SEARCH</button>
                                    </form>
                                    
                                    <div class="showcase">
                                        <div id="postcode">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-outline" data-dismiss="modal">Close</button>
                </div> -->
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

   <!-- Custom Theme JavaScript -->
    <script type="text/javascript" src="/js/image-upload.js"></script>
    <script type="text/javascript" src="/js/search-image.js"></script>
      <!-- Custom Theme JavaScript -->
    <script src="/js/owl.carousel.js"></script>
    <script src="/js/ekko-lightbox.js"></script>
        <script>
       $(document).ready(function() {
          $("#postcode").owlCarousel({
              autoPlay: 3000, //Set AutoPlay to 3 seconds
              items : 3,
              itemsDesktop : [1199,3],
              itemsDesktopSmall : [979,3]
          });
        });
        
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox();
        });
    </script>
</body>

</html>