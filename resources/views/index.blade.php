@include('includes.page-meta-data')

   <title>LOG-IN | WALULEL</title>
   <link rel="stylesheet" href="/css/getin.css" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>


<body>
    
    <section class="getin">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <img src="/img/Mini-Logo.png" class="img-responsive center-block" alt="Walulel Limited" width="150" height="150" style="margin-top: 45px;">
                    <form role="form" method="post" action="/no-auth-login">
                    {{csrf_field()}}
                        <div class="col-sm-12 form-group">
                            <label for="instant-login">Username:</label>
                            <input type="text" id="instant-login" name="username" class="form-control" placeholder="Username ...">
                        </div>
                        <div class="col-sm-12 form-group">
                            <label for="instant-password">Password:</label>
                            <input name="password" type="password" id="instant-password" class="form-control" placeholder="Password ...">
                        </div>
                        <div class="col-sm-12 form-group">
                            <button type="submit" class="btn btn-outline btn-block">SIGN IN</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.1.1.js" integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA=" crossorigin="anonymous"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>

</html>
