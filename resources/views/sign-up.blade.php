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
                         
                         @if(count($errors)>0)
                            @foreach($errors->all() as $error)
                               <div class="alert alert-danger"><i class="fa fa-warning-sign"></i> &nbsp; {{$error}}</div>
                            @endforeach
                        @endif
                        
                        @if($flash=session('message'))
                        <div class="alert alert-black"><i class="fa fa-checked"></i> &nbsp; {{$flash}}</div>
                        @endif

                    </div><!--end md-offset-2 div-->
                </div>
            </div>
        </div>
        
    </header>


    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-3 col-md-6 col-sm-12 text-center">
	                <form class="sign-in" action="/register-new-user" role="form" method="post">
						{{csrf_field()}}
                        <div class="row">
		              		<div class="col-md-6 form-group">
		                        <input required type="text" value="{{old('firstname')}}" name="firstname" class="form-control" id="first_name" placeholder="first name">
		                    </div>
		              		<div class="col-md-6 form-group">
		                        <input required type="text" value="{{old('lastname')}}" name="lastname" class="form-control" id="last_name" placeholder="last name">
		                    </div>
		              		<div class="col-md-12 form-group">
		                        <input required type="email" value="{{old('email')}}" name="email" class="form-control" id="email" placeholder="email address">
		                    </div>
                            <div class="col-md-6 form-group">
                                <input required type="password" name="password" class="form-control" id="password" placeholder="password (Min: 8 characters)">
                            </div>
                            <div class="col-md-6 form-group">
                             <input required type="password" name="password_confirmation" class="form-control" id="confirm_password" placeholder="confirm password">
                            </div>
                            <div class="col-md-12 form-group">
                            <input required type="text" value="{{old('street_name')}}" name="street_name" class="form-control" id="street" placeholder="Street Name">
                            </div>
		                    <div class="col-md-8 col-md-offset-2">
		                      <input type="hidden" name="submit" value="signup">
		                      <button type="submit" name="submit" class="btn btn-default btn-block">SIGN ME UP</button>
		                    </div>
		                    <div class="col-md-12">
		                    	<p class="text-muted">
		             				Already have an account? <a href="/login" class="link">Login</a>
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
