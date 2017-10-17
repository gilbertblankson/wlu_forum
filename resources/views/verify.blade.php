@include('includes.page-meta-data')

    <title>Account Verification | WALULEL</title>
    <!-- Plugin CSS -->

    <!-- Custom CSS -->
    <link rel="stylesheet" href="/css/verify.css" type="text/css">

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
                    <a class="navbar-brand" href="index.html">
                    	<img src="img/logo_brand.png" alt="Walulel Limited" class="img-responsive">
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
                        <li><a href="/login">LOGIN</a></li> 
                        <!-- <li><a href="search.html">SEARCH &nbsp;<i class="fa fa-search"></i></a></li> -->
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        
    </header>


    <section class="content">
        
        <div class="container">
        
            <div class="row">
                
                <div class="col-md-8 col-md-offset-2 text-center">

                    <div class="alert alert-black"><i class="fa fa-checked"></i> &nbsp; <h3>Your account has been activated successfully. Page will automatically redirect in 5 seconds...</h3></div>

                </div>
                
            </div>
        
        </div>
        
    </section>
    
    
    <footer class="navbar-fixed-bottom">
        
        <div class="container">
        
            <div class="row">
            
                <div class="col-md-offset-3 col-md-6 col-sm-12 text-center">
                    
                    <p>
                    
                        <ul class="list-inline list-social">
                    
                            <li class="social-twitter"><a href="https://twitter.com/walulel" target="_blank"><i class="fa fa-twitter"></i></a></li>
	                    
	                        <li class="social-linkedin"><a href="https://www.linkedin.com/company-beta/11023236" target="_blank"><i class="fa fa-linkedin"></i></a></li>
	                    
	                        <li class="social-email"><a href="mailto:info@walulel.com"><i class="fa fa-envelope"></i></a></li>
                            
                        </ul>
                    
                    </p>
                
                    <p style="color:#fff">Your locale like you've never known. &copy; Walulel Limited 2017.</p>
                    
                    <a id="back-to-top" href="#" class="btn back-to-top" role="button"><i class="fa fa-arrow-up"></i></a>
                
                </div>
            
            </div>
        
        </div>
        
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/scripts.js"></script>

    <!-- Custom Theme JavaScript -->

    <script type="text/javaScript">
        $(document).ready(function () {
            window.setTimeout(function (){
                location.href = "/login";
            }, 5000);
        });
    </script>

</body>

</html>
