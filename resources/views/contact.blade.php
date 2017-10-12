@include('includes.page-meta-data')

    <title>CONTACT US | WALULEL</title>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="/css/contact.css" type="text/css">

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
                        <h2>Whether you want to receive further information, ask a question, make a suggestion, collaborate with us, report a problem or just to say hi, get in touch and we'll get back to you as soon as we can!</h2>
				         
                    </div>
                </div>
            </div>
        </div>
        
    </header>


    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
				         
				         <br>
                
                	<form class="contact" role="form" method="post" action="contact-submission.php">
				        <div class="form-group">
				          <input type="text" name="contact_name" class="form-control" id="contact_name" placeholder="Your Full Name" required>
				        </div>
				        <div class="form-group">
				          <input type="email" name="contact_email" class="form-control" id="contact_email" placeholder="Your Email" required>
				        </div>
				        <div class="form-group">
				          <textarea name="contact_message" class="form-control" rows="4" placeholder="Your message"></textarea>
				        </div>
				        <input type="hidden" name="save" value="contact">
				        <button type="submit" class="btn btn-default btn-block">Submit</button>
				      </form>
                </div>
            
                <div class="col-md-6 text-center">
                
                    <ul class="list-unstyled">
                    
                        <li><i class="fa fa-map-marker"></i>&nbsp; Unit 04 Granby Space,<br>
                                                                   114-118 Lower Marsh,<br>
                                                                   South Bank, Waterloo,<br>
                                                                   London, SE1 7AE.
                        </li>
                    
                        <li><i class="fa fa-map-marker"></i>&nbsp; Walulel Limited,<br>
                                                                   F 393/4, Otswe Street,<br>
                                                                   Osu Ako Adjei.
                        </li>
                    
                        <li><i class="fa fa-envelope"></i>&nbsp; info@walulel.com</li>
                    
                    </ul>
                    
                    <hr>
                
                </div>
                
            </div>
        
        </div>
        
    </section>
    
    
@include('includes.site-footer')

    <!-- Custom Theme JavaScript -->

</body>

</html>
