@include('includes.page-meta-data')

    <meta id="token" name="csrf-token" content="{{csrf_token()}}">
    <title>Welcome Single Post | WALULEL</title>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="/css/single-post.css" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body data-spy="scroll" data-target="#myScrollspy" data-offset="15">

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
                        <li><a href="/community">COMMUNITY</a></li>
                        <li><a href="search-vor-1.php">SEARCH &nbsp;<i class="fa fa-search"></i></a></li>
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
	                    <h3 class="padding">Welcome to Walulel Community Page</h3>
	                </div>
                </div>
            </div>
        </div>
        
    </header>


    <div class="nav-search">
        <div class="container">
            <div class="row">
                <form action="/search-results" method="post" class="hidden-xs hidden-sm"><!-- beginning of form for desktop screen -->
                    {{csrf_field()}}
                    <div class="col-md-8">
                        <div class="form-group">
                            <input type="text" id="comm-search" name="comm-search" class="form-control" placeholder="Search topics">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn comm_search">SEARCH TOPIC</button>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn comm_search" data-toggle="modal" data-target="#new_post">MAKE A POST</button>
                    </div>
                </form><!-- end of form for desktop screen -->


                <form action="/search-results" method="post" class="hidden-md hidden-lg"><!-- beginning of form for small screen -->
                     {{csrf_field()}}
                    <div class="col-xs-12">
                        <div class="form-group">
                            <input type="text" id="comm-search" name="comm-search" class="form-control" placeholder="Search topics">
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <button type="button" class="btn comm_search">SEARCH TOPIC</button>
                    </div>
                    <div class="col-xs-6">
                        <button type="button" class="btn comm_search" data-toggle="modal" data-target="#new_post">MAKE A POST</button>
                    </div>
                </form><!-- end of form for small screen -->
            </div>
        </div>
    </div>
    
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-xs-12">
                    <div class="col-md-2 profile hidden-xs hidden-sm">
                         <h2 class="circle center-block">{{$user_placeholder}}</h2>
                        <h5>{{$selected_post->owner->firstname}}</h5>
                    </div>

                    <div class=" col-xs-3 profile hidden-md hidden-lg" style="margin-right: 10px">
                        <h2 class="circle center-block">{{$user_placeholder}}</h2>
                        <h5>{{$selected_post->owner->firstname}}</h5>
                    </div>

                    <div class="col-md-10">

                        <div class="post"><!-- start of every post -->

                            <div class="post_header">

                                <h2 class="hidden-sm hidden-xs">{{$selected_post->post_title}}</h2>
                                <h2 class="hidden-lg hidden-md" style="margin-top: 5px;">{{$selected_post->post_title}}</h2>

                                <p>{{$selected_post->post_body}}</p>
                            </div>

                            <div class="post_footer">
                                <a href="#" onclick="likePost('{{$selected_post->owner->id}}','{{$selected_post->id}}');"><span class="fa fa-thumbs-o-up"></span></a><span class="likes-counter"> {{$selected_post->postReaction->number_of_likes}} Likes</span>
                                <a href="#" onclick="dislikePost('{{$selected_post->owner->id}}','{{$selected_post->id}}');"><span class="fa fa-thumbs-o-down"></span></a><span class="dislikes-counter"> {{$selected_post->postReaction->number_of_dislikes}} Dislike</span>
                                <span class="pull-right">{{\Carbon\Carbon::parse($selected_post->created_at)->diffforHumans()}}</span>
                            </div>

                        </div><!-- end of every post -->

                        <div class="comment-reply">
                            @foreach($replies as $reply)
                               <blockquote class="blockquote-reverse">
                                <p>{{$reply->reply_body}}</p>
                                <footer>{{$reply->replyOwner->firstname}} {{$reply->replyOwner->lastname}}<br /> <span>{{\Carbon\Carbon::parse($reply->created_at)->diffforHumans()}}</span></footer>
                             </blockquote> 
                            @endforeach
                        </div>

                        <div class="comment-form">
                            <form method="post" action="/create-reply/{{$selected_post->id}}/{{$selected_post->post_title}}">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <textarea name="reply" class="form-control" rows="4" placeholder="Post a reply ..."></textarea>
                                </div>
                                <button type="submit" class="btn comm_reply pull-right">REPLY</button>
                            </form>
                        </div>

                    </div>

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
                
                    <p style="color:#000">Your locale like you've never known. &copy; Walulel Limited 2017.</p>
                
                </div>
            
            </div>
        
        </div>
        
    </footer>

    <!-- jQuery -->
<!--    <script src="https://code.jquery.com/jquery-3.1.1.js" integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA=" crossorigin="anonymous"></script>-->
    <script src="/js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
<!--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
    <script src="/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="/js/scripts.js"></script>

    <!-- Custom Theme JavaScript -->
    <script type="text/javascript" src="/js/post_reaction.js"></script>

    <!-- Modal for the making a new post -->
    <div class="modal fade" id="new_post" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Make a post</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                       <form action="/create-post" method="post">
                        {{csrf_field()}}
                            <div class="form-group col-md-12">
                                <label for="exampleInputFile">Topic:</label>
                                <input type="text" name="post_title" id="exampleInputFile" class="form-control" placeholder="What is the topic...">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="exampleInputFile">Select a Category:</label>
                                <select name="category" class="form-control">
                                <option value="">Choose post category</option>
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{ucfirst($category->category_alias)}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="exampleInputFile">Post message:</label>
                                <textarea name="post_body" class="form-control" rows="5" placeholder="What's on your mind..."></textarea>
                            </div>
                               <div class="modal-footer">
                                    <button type="submit" class="btn btn_post">POST TOPIC</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

</body>

</html>