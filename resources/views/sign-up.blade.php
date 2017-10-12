@include('includes.page-meta-data')

    <title>SIGN-UP | WALULEL</title>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="/css/sign-up.css" type="text/css">

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
	                <div class="col-md-12 col-sm-12 text-center">
	                    <h3 class="padding">Join us as we build Walulel. The world’s first company to introduce you to your locale through a new lens.</h3>
	                </div>
	                
	                <div class="col-md-offset-2 col-md-8 col-sm-12 text-center">
	                    <p class="padding">Sign up to receive our monthly bulletin which will always remain free to early adopters.</p>
	                </div>
                </div>
            </div>
        </div>
        
    </header>


    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-3 col-md-6 col-sm-12 text-center">
	                <form class="sign-in" role="form" method="post">
						<div class="row">
		              		<div class="col-md-6 form-group">
		                        <input type="text" name="first_name" class="form-control" id="first_name" placeholder="first name">
		                    </div>
		              		<div class="col-md-6 form-group">
		                        <input type="text" name="last_name" class="form-control" id="last_name" placeholder="last name">
		                    </div>
		              		<div class="col-md-12 form-group">
		                        <input type="email" name="email" class="form-control" id="email" placeholder="email address" value="<?php if(isset($error)){echo $user_email;}?>">
		                    </div>
                            <div class="col-md-6 form-group">
                                <input type="password" name="password" class="form-control" id="password" placeholder="password">
                            </div>
                            <div class="col-md-6 form-group">
                             <input type="password" name="comfirm_password" class="form-control" id="confirm_password" placeholder="comfirm password">
                            </div>
                            <div class="col-md-12 form-group">
                            <input type="text" name="street" class="form-control" id="street" placeholder="Street Name">
                            </div>
		                    <div class="col-md-8 col-md-offset-2">
		                      <input type="hidden" name="submit" value="signup">
		                      <button type="submit" name="submit" class="btn btn-default btn-block">SIGN ME UP</button>
		                    </div>
		                    <div class="col-md-12">
		                    	<p class="text-muted">
		             				Already have an account? <a href="login.php" class="link">Login</a>
								</p>
		                    </div>
		                    <div class="col-md-12 col-sm-offset-2">
	                            
	                         </div>
		                </div>
		            </form>
                </div>
            </div>
        </div>
    </section>
    
    
    @include('includes.site-footer')

    <!-- Custom Theme JavaScript -->

</body>

</html>
