@include('includes.page-meta-data')

    <title>Welcome | WALULEL</title>
    <meta id="token" name="csrf-token" content="{{csrf_token()}}">
    <!-- Plugin CSS -->

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
                        <form enctype="multipart/form-data" id="image-upload-form">
                        {{csrf_field()}}
                            <div class="form-group col-md-12">
                                <label for="exampleInputFile">File input</label>
                                <input type="file" name="input-file" id="exampleInputFile">
                                <p class="help-block">Image relating to the Postcode.</p>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputFile">#HashTag</label>
                                <input type="text" name="hash-tag" id="exampleInputFile" class="form-control" placeholder="#hashtag">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputFile">Postcode</label>
                                <input type="text" name="post-code" id="exampleInputFile" class="form-control" placeholder="Postcode">
                            </div>
                            <div class="form-group col-md-6 col-md-offset-6 pull-right">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn upload_button">Upload</button>
                            </div>
                        </form>
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
</body>

</html>