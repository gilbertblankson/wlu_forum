@include('includes.page-meta-data')

    <title>Welcome Community Page | WALULEL</title>
    <!-- Plugin CSS -->

    <!-- Custom CSS -->
    <link rel="stylesheet" href="/css/community.css" type="text/css">

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
	                    <h3 class="padding">Your Search Results</h3>
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


                <form class="hidden-md hidden-lg"><!-- beginning of form for small screen -->
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
                <div class="col-md-2 hidden-sm hidden-xs" id="myScrollspy">
                    <ul class="list-unstyled" data-spy="affix" data-offset-top="205">
                    <h3>Categories</h3>
                     @foreach($categories as $category)
                      <li><a href="/community/{{$category->id}}/{{$category->category_alias}}">{{ucfirst($category->category_alias)}} <span class="badge">{{$category->posts_count}}</span></a></li>
                     @endforeach
                    </ul>
                </div>

                <div class="col-xs-12 hidden-md hidden-lg">
                    
                </div>

                <div class="col-md-10">
                    <h3>Topics</h3>

                    @foreach($posts as $post)
                      
                      @php
                        $first_placeholder = strtoupper(substr($post->owner->firstname,0,1));
                        $second_placeholder = strtoupper(substr($post->owner->lastname,0,1));
                        $user_placeholder = $first_placeholder.$second_placeholder;
                      @endphp

                    <div class="post"><!-- start of every post -->

                        <div class="post-left pull-left"><!-- start of the column containing the avatar, username and post -->
                            <div class="userinfo pull-left">
                                <div class="avatar">
                                    <h2 class="circle center-block">{{$user_placeholder}}</h2>
                                </div>
                                <div class="username">
                                    {{ucfirst($post->owner->firstname)}}  {{ucfirst($post->owner->lastname)}}
                                </div>
                            </div>
                            <div class="posttext pull-left">
                                <a href="/single-post/{{$post->id}}/{{$post->post_title}}" class="link"><h2>{{$post->post_title}}</h2></a>
                                <p>{{substr($post->post_body,0,80)."..."}}</p>
                            </div>
                            <div class="clearfix"></div>
                        </div><!-- end of the column containing the avatar, username and post -->

                        <div class="postinfo pull-left"><!-- start of the column containing the comments, views and time -->
                            <div class="comments">{{$post->postReaction->number_of_likes}} <br /> Likes</div>
                            <div class="views"><i class="fa fa-eye"></i> {{$post->numberOfViews->count()}}</div>
                            <div class="time">{{\Carbon\Carbon::parse($post->created_at)->diffforHumans()}}</div>
                        </div><!-- end of the column containing the comments, views and time -->

                        <div class="clearfix"></div>

                    </div><!-- end of every post -->
                  @endforeach
                   

                    <nav aria-label="Page navigation" class="text-center">
                        <ul class="pagination">
                         {{$posts->links()}}
                        </ul>
                    </nav>

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
    <script>
       
    </script>

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