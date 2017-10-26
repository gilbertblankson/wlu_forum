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
                        <li><a href="/community">COMMUNITY</a></li>
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