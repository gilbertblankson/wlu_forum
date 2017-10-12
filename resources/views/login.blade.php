@include('includes.page-meta-data')

    <title>LOG-IN | WALULEL</title>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="/css/login.css" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <header>
        
    @include('includes.site-navigation')
        
        <div class="hero-bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
    			 		<h2 class="">Coming Soon</h2>

                        <br />
                    </div>
                </div>
            </div>
        </div>
        
    </header>


    <section class="content">
       <div class="container">
		    <div class="row">
		        <div class="col-md-6 col-md-offset-3">
		            <form class="login" role="form" method="post">
						<div class="row">
		              		<div class="col-md-12 form-group">
		                        <input type="email" name="email" class="form-control" id="email" placeholder="email address">
		                    </div>
		                    <div class="col-md-12 form-group">
		                        <input type="password" name="password" class="form-control" id="password" placeholder="Password">
		                    </div>
		                    <div class="col-md-6 col-md-offset-3">
                              <!-- <input type="hidden" name="submit" value="login"> -->
		                      <button type="submit" name="submit" class="btn btn-default btn-block">LOGIN</button> 
		                    </div>
		                    <div class="col-md-6">
		                      <div class="checkbox pull-left">
		                          <label>
		                          <input type="checkbox">Remember me</label>
		                      </div>
		                    </div>
		                    <div class="col-md-6">
		                      <div class="pull-right">
		                        <a href="#0" class="link">Forgot your password?</a>
		                      </div>
		                    </div>
		                </div>
		            </form>
		        </div>
		    </div>
		</div>
    </section>
    
    
   @include('includes.site-footer')

</body>

</html>
