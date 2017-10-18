@include('includes.page-meta-data')

    <title>SURVEY | WALULEL</title>

    <!-- Bootstrap Core CSS -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css"> -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.min.css" type="text/css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="/css/survey.css" type="text/css">

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
                        <h3>First and foremost, we at Walulel want to say a huge thank you for taking the time out of your day to help us with a little bit of market research. We have already decided on over 150 of the urban quality metrics we will analyse. However, whilst we’re crunching through the numbers on those metrics, we’d love to hear your views on the following questions that relate to your views on neighbourhoods. It’s only a short survey and shouldn’t take any longer than 10 minutes.</h3>
                    </div>
                </div>
            </div>
        </div>

    </header>

	<section class="content">

        <div class="container">

            <div class="row">

                <div class="col-md-offset-1 col-md-10">

                	<form class="survey" role="form" method="post" action="process/survey-process.php">
                	
                	<!-- Questions with Radio Buttons to work on 1,2,3,9,10,11,12,13,14,15,16,17,18,19,21,22,23,24 -->
                    <!-- Questions with Radio Buttons to work on 14 -->

                		<div class="col-md-12">
                			<div class="form-group">
                				<label for="">1. Are you currently a homeowner or in rented accommodation?</label>
                                <div class="radio" style="margin-left:40px">
                                  <label>
                                    <input type="radio" name="ownership_info" id="" value="I own or partially own my home" style="margin-top: -12px;">
                                    I own or partially own my home
                                  </label>
                                </div>
                				
								<div class="radio" style="margin-left:40px">
								  <label>
								    <input type="radio" name="ownership_info" id="" value="I am in rented accommodation" style="margin-top: -12px;">
								    I am in rented accommodation
								  </label>
								</div>
                			</div>
                		</div><!-- End of Question 1 -->

                		<div class="col-md-12">
                			<div class="form-group">
                				<label for="">2. If when looking for a HOME TO BUY OR RENT, you research into a neighbourhood before deciding to live there, how long do you spend researching the neighbourhoods:</label>
                                <div class="radio" style="margin-left:40px" name="new_neighbourhood_research_time">
								  <label>
								    <input type="radio" name="new_neighbourhood_research_time" id="" value="Less than 1 hour because I already know lots about the area" style="margin-top: -12px;">
								    Less than 1 hour because I already know lots about the area
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="new_neighbourhood_research_time">
								  <label>
								    <input type="radio" name="new_neighbourhood_research_time" id="" value="1 – 3 hours just to make sure I’ve not missed anything" style="margin-top: -12px;">
								    1 – 3 hours just to make sure I’ve not missed anything
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="new_neighbourhood_research_time">
								  <label>
								    <input type="radio" name="new_neighbourhood_research_time" id="" value="3 – 8 hours as I like to know a fair bit but I’m happy to discover more later." style="margin-top: -12px;">
								    3 – 8 hours as I like to know a fair bit but I’m happy to discover more later.
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="new_neighbourhood_research_time">
								  <label>
								    <input type="radio" name="new_neighbourhood_research_time" id="" value="I spend absolutely ages trying to figure out the best neighbourhood" style="margin-top: -12px;">
								    I spend absolutely ages trying to figure out the best neighbourhood
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="new_neighbourhood_research_time">
								  <label>
								    <input type="radio" name="new_neighbourhood_research_time" id="" value="I don’t research into the neighbourhood" style="margin-top: -12px;">
								    I don’t research into the neighbourhood
								  </label>
								</div>
                			</div>
                		</div><!-- End of Question 2 -->

                		<div class="col-md-12">
                			<div class="form-group">
                				<label for="">3. If when looking for a SHORT-TERM PLACE TO STAY, such as on Airbnb, you research into a neighbourhood before deciding to stay there, how long do you spend researching the neighbourhood:</label>
                                <div class="radio" style="margin-left:40px" name="short_term_stay_research_time">
								  <label>
								    <input type="radio" name="short_term_stay_research_time" id="" value="Less than 1 hour because I already know lots about the area" style="margin-top: -12px;">
								    Less than 1 hour because I already know lots about the area
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="short_term_stay_research_time">
								  <label>
								    <input type="radio" name="short_term_stay_research_time" id="" value="1 – 2 hours just to make sure I’ve not missed anything" style="margin-top: -12px;">
								    1 – 2 hours just to make sure I’ve not missed anything
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="short_term_stay_research_time">
								  <label>
								    <input type="radio" name="short_term_stay_research_time" id="" value="2 – 4 hours as I like to know a fair bit but I’m happy to discover more later" style="margin-top: -12px;">
								    2 – 4 hours as I like to know a fair bit but I’m happy to discover more later.
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="short_term_stay_research_time">
								  <label>
								    <input type="radio" name="short_term_stay_research_time" id="" value="I spend absolutely ages trying to figure out the best neighbourhood" style="margin-top: -12px;">
								    I spend absolutely ages trying to figure out the best neighbourhood
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="short_term_stay_research_time">
								  <label>
								    <input type="radio" name="short_term_stay_research_time" id="" value="I don’t research into the neighbourhood" style="margin-top: -12px;">
								    I don’t research into the neighbourhood
								  </label>
								</div>
                			</div>
                		</div><!-- End of Question 3 -->

                		<div class="col-md-12">
                			<div class="form-group">
                				<label for="">4. When looking for a HOME TO BUY OR RENT, apart from the price, what are the 5 things that most influence your decision on where to live (such as location of friends and family, transport accessibility and/or local schools)? Please rank the most important as number 1 and the least important as number 5.</label>
                				<div class="row">
                					<div class="col-sm-1 col-xs-2">
	                					<p style="padding-top: 20px">1</p>
	                				</div>
	                				<div class="col-sm-11 col-xs-10">
	                					<textarea name="buy_rent_criterion[1]" class="form-control" style="margin-top: 4px; margin-bottom: 4px" placeholder="in 100 characters"></textarea>
	                				</div>
	                				<div class="clearfix"></div>
                					<div class="col-sm-1 col-xs-2">
	                					<p style="padding-top: 20px">2</p>
	                				</div>
	                				<div class="col-sm-11 col-xs-10">
	                					<textarea name="buy_rent_criterion[2]" class="form-control" style="margin-top: 4px; margin-bottom: 4px" placeholder="in 100 characters"></textarea>
	                				</div>
	                				<div class="clearfix"></div>
                					<div class="col-sm-1 col-xs-2">
	                					<p style="padding-top: 20px">3</p>
	                				</div>
	                				<div class="col-sm-11 col-xs-10">
	                					<textarea name="buy_rent_criterion[3]" class="form-control" style="margin-top: 4px; margin-bottom: 4px" placeholder="in 100 characters"></textarea>
	                				</div>
	                				<div class="clearfix"></div>
                					<div class="col-sm-1 col-xs-2">
	                					<p style="padding-top: 20px">4</p>
	                				</div>
	                				<div class="col-sm-11 col-xs-10">
	                					<textarea name="buy_rent_criterion[4]" class="form-control" style="margin-top: 4px; margin-bottom: 4px" placeholder="in 100 characters"></textarea>
	                				</div>
	                				<div class="clearfix"></div>
                					<div class="col-sm-1 col-xs-2">
	                					<p style="padding-top: 20px">5</p>
	                				</div>
	                				<div class="col-sm-11 col-xs-10">
	                					<textarea name="buy_rent_criterion[5]" class="form-control" style="margin-top: 4px; margin-bottom: 4px" placeholder="in 100 characters"></textarea>
	                				</div>
                				</div>
                			</div>
                		</div><!-- End of Question 4 -->

                		<div class="col-md-12">
                			<div class="form-group">
                				<label for="">5. When looking for a SHORT-TERM PLACE TO STAY, such as on Airbnb, apart from the price, what are the 5 things that most influence your decision on where to stay (such as local shops, transport accessibility)? Please rank the most important as number 1 and the least important as number 5.</label>
                				<div class="row">
                					<div class="col-sm-1 col-xs-2">
                						<p style="padding-top: 20px">1</p>
                					</div>
                					<div class="col-sm-11 col-xs-10">
                						<textarea name="short_term_stay_criterion[1]" class="form-control" style="margin-top: 4px; margin-bottom: 4px" placeholder="in 100 characters"></textarea>
                					</div>
	                				<div class="clearfix"></div>
                					<div class="col-sm-1 col-xs-2">
                						<p style="padding-top: 20px">2</p>
                					</div>
                					<div class="col-sm-11 col-xs-10">
                						<textarea name="short_term_stay_criterion[2]" class="form-control" style="margin-top: 4px; margin-bottom: 4px" placeholder="in 100 characters"></textarea>
                					</div>
	                				<div class="clearfix"></div>
                					<div class="col-sm-1 col-xs-2">
                						<p style="padding-top: 20px">3</p>
                					</div>
                					<div class="col-sm-11 col-xs-10">
                						<textarea name="short_term_stay_criterion[3]" class="form-control" style="margin-top: 4px; margin-bottom: 4px" placeholder="in 100 characters"></textarea>
                					</div>
	                				<div class="clearfix"></div>
                					<div class="col-sm-1 col-xs-2">
                						<p style="padding-top: 20px">4</p>
                					</div>
                					<div class="col-sm-11 col-xs-10">
                						<textarea name="short_term_stay_criterion[4]" class="form-control" style="margin-top: 4px; margin-bottom: 4px" placeholder="in 100 characters"></textarea>
                					</div>
	                				<div class="clearfix"></div>
                					<div class="col-sm-1 col-xs-2">
                						<p style="padding-top: 20px">5</p>
                					</div>
                					<div class="col-sm-11 col-xs-10">
                						<textarea name="short_term_stay_criterion[5]" class="form-control" style="margin-top: 4px; margin-bottom: 4px" placeholder="in 100 characters"></textarea>
                					</div>
                				</div>
                			</div>
                		</div><!-- End of Question 5 -->

                		<div class="col-md-12">
                			<div class="form-group">
                				<label for="">6. When looking for a place to live, LONG TERM OR SHORT TERM, please tell us what websites, publications and/or other sources (such as personal recommendations) you use to research the neighbourhood or area?</label>
                				<div class="row">
                					<div class="col-sm-2">
	                					<input id="5" name="location_research_sources[1]" type="text" class="form-control" placeholder="">
	                				</div>
	                				<div class="col-sm-2">
	                					<input id="5i" name="location_research_sources[2]" type="text" class="form-control" placeholder="">
	                				</div>
	                				<div class="col-sm-2">
	                					<input id="5ii" name="location_research_sources[3]" type="text" class="form-control" placeholder="">
	                				</div>
	                				<div class="col-sm-2">
	                					<input id="5iii" name="location_research_sources[4]" type="text" class="form-control" placeholder="">
	                				</div>
	                				<div class="col-sm-2">
	                					<input id="5iv" name="location_research_sources[5]" type="text" class="form-control" placeholder="">
	                				</div>
	                				<div class="col-sm-2">
	                					<a id="5x" class="btn btn-default btn-block">Opt Out</a>
	                				</div>
                				</div>
                			</div>
                		</div><!-- End of Question 6 -->

                		<div class="col-md-12">
                			<div class="form-group">
                				<label for="">7. When looking for a place to live, what do you wish you could find out about the people/population already in the neighbourhood you are planning on moving into?</label>
                				<div class="row">
                					<div class="col-sm-10">
                            			<textarea id="6" class="form-control" maxlength="500" name="new_neighbourhood_info" rows="3" placeholder="in 500 characters"></textarea>
	                				</div>
	                				<div class="col-sm-2">
	                					<a id="6x" class="btn btn-default btn-block">Opt Out</a>
	                				</div>
                				</div>
                			</div>
                		</div><!-- End of Question 7 -->

                		<div class="col-md-12">
                			<div class="form-group">
                				<label for="">8. If you have MOVED HOME WITHIN THE LAST 5 YEARS, what three things do you wish you had known about your neighbourhood before moving?</label>
                				<div class="row">
                					<div class="col-sm-10">
	                					<textarea id="7" class="form-control" maxlength="500" name="neighbourhood_info_wished_knew" rows="3" placeholder="in 500 characters"></textarea>
	                				</div>
	                				<div class="col-sm-2">
	                					<a id="7x" class="btn btn-default btn-block">Opt Out</a>
	                				</div>
                				</div>
                			</div>
                		</div><!-- End of Question 8 -->

                		<div class="col-md-12">
                			<div class="form-group">
                				<label for="">9. Carrying on from the previous question, would you have paid £10 to know those three things before moving?</label>
                                <div class="radio" style="margin-left:40px" name="would_pay_for_neighbourhood_info">
								  <label>
								    <input type="radio" name="would_pay_for_neighbourhood_info" id="" value="Erm, Yes – of course I would" style="margin-top: -12px;">
								    Erm, Yes – of course I would
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="would_pay_for_neighbourhood_info">
								  <label>
								    <input type="radio" name="would_pay_for_neighbourhood_info" id="" value="Mmm – Possibly" style="margin-top: -12px;">
								    Mmm – Possibly
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="would_pay_for_neighbourhood_info">
								  <label>
								    <input type="radio" name="would_pay_for_neighbourhood_info" id="" value="Absolutely no way" style="margin-top: -12px;">
								    Absolutely no way
								  </label>
								</div>
                			</div>
                		</div><!-- End of Question 9 -->

                		<div class="col-md-12">
                			<div class="form-group">
                				<label for="">10. When LOOKING FOR A PLACE TO LIVE, to what extent do you consider a socially active local community to be an attraction to a neighbourhood?</label>
                                <div class="radio" style="margin-left:40px" name="social_activity_consideration">
								  <label>
								    <input type="radio" name="social_activity_consideration" id="" value="Yes - it is imperative to my decision" style="margin-top: -12px;">
								    Yes - it is imperative to my decision
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="social_activity_consideration">
								  <label>
								    <input type="radio" name="social_activity_consideration" id="" value="Mmm - I kind of look but not too important" style="margin-top: -12px;">
								    Mmm - I kind of look but not too important
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="social_activity_consideration">
								  <label>
								    <input type="radio" name="social_activity_consideration" id="" value="It had never really crossed my mind but it’s something I’d like information on" style="margin-top: -12px;">
								    It had never really crossed my mind but it’s something I’d like information on
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="social_activity_consideration">
								  <label>
								    <input type="radio" name="social_activity_consideration" id="" value="No - I don’t care" style="margin-top: -12px;">
								    No - I don’t care
								  </label>
								</div>
                			</div>
                		</div><!-- End of Question 10 -->

                		<div class="col-md-12">
                			<div class="form-group">
                				<label for="">11. When LOOKING FOR A PLACE TO LIVE do you consider the number of local parks or open spaces in a neighbourhood?</label>
                                <div class="radio" style="margin-left:40px" name="localParks_openSpaces_consideration">
								  <label>
								    <input type="radio" name="localParks_openSpaces_consideration" id="" value="Yes - it is imperative to my decision" style="margin-top: -12px;">
								    Yes - it is imperative to my decision
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="localParks_openSpaces_consideration">
								  <label>
								    <input type="radio" name="localParks_openSpaces_consideration" id="" value="Mmm - I kind of look but not too important" style="margin-top: -12px;">
								    Mmm - I kind of look but not too important
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="localParks_openSpaces_consideration">
								  <label>
								    <input type="radio" name="localParks_openSpaces_consideration" id="" value="It had never really crossed my mind but it’s something I’d like information on" style="margin-top: -12px;">
								    It had never really crossed my mind but it’s something I’d like information on
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="localParks_openSpaces_consideration">
								  <label>
								    <input type="radio" name="localParks_openSpaces_consideration" id="" value="No - I don’t care" style="margin-top: -12px;">
								    No - I don’t care
								  </label>
								</div>
                			</div>
                		</div><!-- End of Question 11 -->

                		<div class="col-md-12">
                			<div class="form-group">
                				<label for="">12. When LOOKING FOR A PLACE TO LIVE do you consider the range and combination of local shops on offer to you?</label>
                                <div class="radio" style="margin-left:40px" name="localShops_rangeCombination_consideration">
								  <label>
								    <input type="radio" name="localShops_rangeCombination_consideration" id="" value="Yes - it is imperative to my decision" style="margin-top: -12px;">
								    Yes - it is imperative to my decision
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="localShops_rangeCombination_consideration">
								  <label>
								    <input type="radio" name="localShops_rangeCombination_consideration" id="" value="Mmm - I kind of look but not too important" style="margin-top: -12px;">
								    Mmm - I kind of look but not too important
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="localShops_rangeCombination_consideration">
								  <label>
								    <input type="radio" name="localShops_rangeCombination_consideration" id="" value="It had never really crossed my mind but it’s something I’d like information on" style="margin-top: -12px;">
								    It had never really crossed my mind but it’s something I’d like information on
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="localShops_rangeCombination_consideration">
								  <label>
								    <input type="radio" name="localShops_rangeCombination_consideration" id="" value="No - I don’t care" style="margin-top: -12px;">
								    No - I don’t care
								  </label>
								</div>
                			</div>
                		</div><!-- End of Question 12 -->

                		<div class="col-md-12">
                			<div class="form-group">
                				<label for="">13. When LOOKING FOR A PLACE TO LIVE do you consider the amenities/activities on offer in a neighbourhood?</label>
                                <div class="radio" style="margin-left:40px" name="amenities_and_activities_consideration">
								  <label>
								    <input type="radio" name="amenities_and_activities_consideration" id="" value="Yes - it is imperative to my decision" style="margin-top: -12px;">
								    Yes - it is imperative to my decision
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="amenities_and_activities_consideration">
								  <label>
								    <input type="radio" name="amenities_and_activities_consideration" id="" value="Mmm - I kind of look but not too important" style="margin-top: -12px;">
								    Mmm - I kind of look but not too important
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="amenities_and_activities_consideration">
								  <label>
								    <input type="radio" name="amenities_and_activities_consideration" id="" value="It had never really crossed my mind but it’s something I’d like information on" style="margin-top: -12px;">
								    It had never really crossed my mind but it’s something I’d like information on
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="amenities_and_activities_consideration">
								  <label>
								    <input type="radio" name="amenities_and_activities_consideration" id="" value="No - I don’t care" style="margin-top: -12px;">
								    No - I don’t care
								  </label>
								</div>
                			</div>
                		</div><!-- End of Question 13 -->

                		<div class="col-md-12">
                			<div class="form-group">
                				<label for="">14. Please rank, IN ORDER OF PRIORITY AND IMPORTANCE TO YOU, the following transport matters as they affect your view of a neighbourhood? Please rank the most important as number one and the least important as number 5.</label>
                				<div class="row">
                					<div class="col-sm-1 col-xs-2">
                						<p style="padding-top: 15px">1</p>
                					</div>
                					<div class="col-sm-11 col-xs-10">
                						<select name="transportation_considerations_ranking[1]" class="form-control" style="margin-top: 4px; margin-bottom: 4px">
		                					<option value="">-- select option --</option>
		                					<option>Public transport frequency</option>
		                					<option>Public transport reliability</option>
		                					<option>Road network congestion</option>
		                					<option>Ease of access to the bus network</option>
		                					<option>Ease of access to the train or tube</option>
		                				</select>
                					</div>
                					<div class="col-sm-1 col-xs-2">
                						<p style="padding-top: 15px">2</p>
                					</div>
                					<div class="col-sm-11 col-xs-10">
                						<select name="transportation_considerations_ranking[2]" class="form-control" style="margin-top: 4px; margin-bottom: 4px">
		                					<option value="">-- select option --</option>
		                					<option>Public transport frequency</option>
		                					<option>Public transport reliability</option>
		                					<option>Road network congestion</option>
		                					<option>Ease of access to the bus network</option>
		                					<option>Ease of access to the train or tube</option>
		                				</select>
                					</div>
                					<div class="col-sm-1 col-xs-2">
                						<p style="padding-top: 15px">3</p>
                					</div>
                					<div class="col-sm-11 col-xs-10">
                						<select name="transportation_considerations_ranking[3]" class="form-control" style="margin-top: 4px; margin-bottom: 4px">
		                					<option value="">-- select option --</option>
		                					<option>Public transport frequency</option>
		                					<option>Public transport reliability</option>
		                					<option>Road network congestion</option>
		                					<option>Ease of access to the bus network</option>
		                					<option>Ease of access to the train or tube</option>
		                				</select>
                					</div>
                					<div class="col-sm-1 col-xs-2">
                						<p style="padding-top: 15px">4</p>
                					</div>
                					<div class="col-sm-11 col-xs-10">
                						<select name="transportation_considerations_ranking[4]" class="form-control" style="margin-top: 4px; margin-bottom: 4px">
		                					<option value="">-- select option --</option>
		                					<option>Public transport frequency</option>
		                					<option>Public transport reliability</option>
		                					<option>Road network congestion</option>
		                					<option>Ease of access to the bus network</option>
		                					<option>Ease of access to the train or tube</option>
		                				</select>
                					</div>
                					<div class="col-sm-1 col-xs-2">
                						<p style="padding-top: 15px">5</p>
                					</div>
                					<div class="col-sm-11 col-xs-10">
                						<select name="transportation_considerations_ranking[5]" class="form-control" style="margin-top: 4px; margin-bottom: 4px">
		                					<option value="">-- select option --</option>
		                					<option>Public transport frequency</option>
		                					<option>Public transport reliability</option>
		                					<option>Road network congestion</option>
		                					<option>Ease of access to the bus network</option>
		                					<option>Ease of access to the train or tube</option>
		                				</select>
                					</div>
                				</div>
                			</div>
                		</div><!-- End of Question 14 -->

                		<div class="col-md-12">
                			<div class="form-group">
                				<label for="">15. When looking for a place to live to what extent do you consider common journey travel times (such as commuting for work or the school run) when choosing a neighbourhood?</label>
                                <div class="radio" style="margin-left:40px" name="travel_time_importance">
								  <label>
								    <input type="radio" name="travel_time_importance" id="" value="Yes - it is imperative to my decision" style="margin-top: -12px;">
								    Yes - it is imperative to my decision
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="travel_time_importance">
								  <label>
								    <input type="radio" name="travel_time_importance" id="" value="Mmm - I kind of look but not too important" style="margin-top: -12px;">
								    Mmm - I kind of look but not too important
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="travel_time_importance">
								  <label>
								    <input type="radio" name="travel_time_importance" id="" value="It had never really crossed my mind but it’s something I’d like information on" style="margin-top: -12px;">
								    It had never really crossed my mind but it’s something I’d like information on
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="travel_time_importance">
								  <label>
								    <input type="radio" name="travel_time_importance" id="" value="No - I don’t care" style="margin-top: -12px;">
								    No - I don’t care
								  </label>
								</div>
                			</div>
                		</div><!-- End of Question 15 -->

                		<div class="col-md-12">
                			<div class="form-group">
                				<label for="">16. How long is an acceptable commuting time for you?</label>
                                <div class="radio" style="margin-left:40px" name="acceptable_commute_time">
								  <label>
								    <input type="radio" name="acceptable_commute_time" id="" value="10 – 20 minutes" style="margin-top: -12px;">
								    10 – 20 minutes
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="acceptable_commute_time">
								  <label>
								    <input type="radio" name="acceptable_commute_time" id="" value="20 – 40 minutes" style="margin-top: -12px;">
								    20 – 40 minutes
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="acceptable_commute_time">
								  <label>
								    <input type="radio" name="acceptable_commute_time" id="" value="40 – 60 minutes" style="margin-top: -12px;">
								    40 – 60 minutes
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="acceptable_commute_time">
								  <label>
								    <input type="radio" name="acceptable_commute_time" id="" value="1 hour" style="margin-top: -12px;">
								    1 hour
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="acceptable_commute_time">
								  <label>
								    <input type="radio" name="acceptable_commute_time" id="" value="I don't care" style="margin-top: -12px;">
								    I don't care
								  </label>
								</div>
                			</div>
                		</div><!-- End of Question 16 -->

                		<div class="col-md-12">
                			<div class="form-group">
                				<label for="">17. What is your preferred mode of transport for getting around London?</label>
                                <div class="radio" style="margin-left:40px" name="prefered_transport_mode">
								  <label>
								    <input type="radio" name="prefered_transport_mode" id="" value="Bus" style="margin-top: -12px;">
								    Bus
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="prefered_transport_mode">
								  <label>
								    <input type="radio" name="prefered_transport_mode" id="" value="London Underground" style="margin-top: -12px;">
								    London Underground
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="prefered_transport_mode">
								  <label>
								    <input type="radio" name="prefered_transport_mode" id="" value="London Overground" style="margin-top: -12px;">
								    London Overground
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="prefered_transport_mode">
								  <label>
								    <input type="radio" name="prefered_transport_mode" id="" value="National Rail" style="margin-top: -12px;">
								    National Rail
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="prefered_transport_mode">
								  <label>
								    <input type="radio" name="prefered_transport_mode" id="" value="Bicycle" style="margin-top: -12px;">
								    Bicycle
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="prefered_transport_mode">
								  <label>
								    <input type="radio" name="prefered_transport_mode" id="" value="Motorbike" style="margin-top: -12px;">
								    Motorbike
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="prefered_transport_mode">
								  <label>
								    <input type="radio" name="prefered_transport_mode" id="" value="Walking" style="margin-top: -12px;">
								    Walking
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="prefered_transport_mode">
								  <label>
								    <input type="radio" name="prefered_transport_mode" id="" value="Car" style="margin-top: -12px;">
								    Car
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="prefered_transport_mode">
								  <label>
								    <input type="radio" name="prefered_transport_mode" id="" value="Taxi" style="margin-top: -12px;">
								    Taxi
								  </label>
								</div>
                			</div>
                		</div><!-- End of Question 17 -->

                		<div class="col-md-12">
                			<div class="form-group">
                				<label for="">18. When looking for a place to live do you ever consider how pedestrian friendly a neighbourhood is?</label>
                                <div class="radio" style="margin-left:40px" name="neighbourhood_pedestrianFriendliness_consideration">
								  <label>
								    <input type="radio" name="neighbourhood_pedestrianFriendliness_consideration" id="" value="Yes - it is imperative to my decision" style="margin-top: -12px;">
								    Yes - it is imperative to my decision
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="neighbourhood_pedestrianFriendliness_consideration">
								  <label>
								    <input type="radio" name="neighbourhood_pedestrianFriendliness_consideration" id="" value="Mmm - I kind of look but not too important" style="margin-top: -12px;">
								    Mmm - I kind of look but not too important
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="neighbourhood_pedestrianFriendliness_consideration">
								  <label>
								    <input type="radio" name="neighbourhood_pedestrianFriendliness_consideration" id="" value="It had never really crossed my mind but it’s something I’d like information on" style="margin-top: -12px;">
								    It had never really crossed my mind but it’s something I’d like information on
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="neighbourhood_pedestrianFriendliness_consideration">
								  <label>
								    <input type="radio" name="neighbourhood_pedestrianFriendliness_consideration" id="" value="No - I don’t care" style="margin-top: -12px;">
								    No - I don’t care
								  </label>
								</div>
                			</div>
                		</div><!-- End of Question 18 -->

                		<div class="col-md-12">
                			<div class="form-group">
                				<label for="">19. When looking for a place to live, to what extent do you consider the architectural style(s) of a neighbourhood to be important?</label>
                                <div class="radio" style="margin-left:40px" name="neighbourhood_architecturalStyle_consideration">
								  <label>
								    <input type="radio" name="neighbourhood_architecturalStyle_consideration" id="" value="Yes - it is imperative to my decision" style="margin-top: -12px;">
								    Yes - it is imperative to my decision
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="neighbourhood_architecturalStyle_consideration">
								  <label>
								    <input type="radio" name="neighbourhood_architecturalStyle_consideration" id="" value="Mmm - I kind of look but not too important" style="margin-top: -12px;">
								    Mmm - I kind of look but not too important
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="neighbourhood_architecturalStyle_consideration">
								  <label>
								    <input type="radio" name="neighbourhood_architecturalStyle_consideration" id="" value="It had never really crossed my mind but it’s something I’d like information on" style="margin-top: -12px;">
								    It had never really crossed my mind but it’s something I’d like information on
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="neighbourhood_architecturalStyle_consideration">
								  <label>
								    <input type="radio" name="neighbourhood_architecturalStyle_consideration" id="" value="No - I don’t care" style="margin-top: -12px;">
								    No - I don’t care
								  </label>
								</div>
                			</div>
                		</div><!-- End of Question 19 -->

                		<div class="col-md-12">
                			<div class="form-group">
                				<label for="">20. What architectural style do you think makes a neighbourhood more attractive?</label>
                				<div class="row">
                					<div class="col-sm-10">
	                					<textarea id="19" name="preferred_neighbourhood_architecturalStyle" class="form-control" maxlength="50" rows="3" placeholder="in 50 characters"></textarea>
	                				</div>
	                				<div class="col-sm-2">
	                					<a id="19x" class="btn btn-default btn-block">Opt Out</a>
	                				</div>
                				</div>
                			</div>
                		</div><!-- End of Question 20 -->

                		<div class="col-md-12">
                			<div class="form-group">
                				<label for="">21. When looking for a place to live do you consider the average heights of the buildings in a neighbourhood?</label>
                                <div class="radio" style="margin-left:40px" name="neighbourhood_buildings_averageHeights_consideration">
								  <label>
								    <input type="radio" name="neighbourhood_buildings_averageHeights_consideration" id="" value="Yes - it is imperative to my decision" style="margin-top: -12px;">
								    Yes - it is imperative to my decision
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="neighbourhood_buildings_averageHeights_consideration">
								  <label>
								    <input type="radio" name="neighbourhood_buildings_averageHeights_consideration" id="" value="Mmm - I kind of look but not too important" style="margin-top: -12px;">
								    Mmm - I kind of look but not too important
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="neighbourhood_buildings_averageHeights_consideration">
								  <label>
								    <input type="radio" name="neighbourhood_buildings_averageHeights_consideration" id="" value="It had never really crossed my mind but it’s something I’d like information on" style="margin-top: -12px;">
								    It had never really crossed my mind but it’s something I’d like information on
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="neighbourhood_buildings_averageHeights_consideration">
								  <label>
								    <input type="radio" name="neighbourhood_buildings_averageHeights_consideration" id="" value="No - I don’t care" style="margin-top: -12px;">
								    No - I don’t care
								  </label>
								</div>
                			</div>
                		</div><!-- End of Question 21 -->

                		<div class="col-md-12">
                			<div class="form-group">
                				<label for="">22. When looking for a place to live, do you consider the presence of historic buildings and monuments in a neighbourhood?</label>
                                <div class="radio" style="margin-left:40px" name="neighbourhood_historicBuildingsAndMonuments_consideration">
								  <label>
								    <input type="radio" name="neighbourhood_historicBuildingsAndMonuments_consideration" id="" value="Yes - it is imperative to my decision" style="margin-top: -12px;">
								    Yes - it is imperative to my decision
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="neighbourhood_historicBuildingsAndMonuments_consideration">
								  <label>
								    <input type="radio" name="neighbourhood_historicBuildingsAndMonuments_consideration" id="" value="Mmm - I kind of look but not too important" style="margin-top: -12px;">
								    Mmm - I kind of look but not too important
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="neighbourhood_historicBuildingsAndMonuments_consideration">
								  <label>
								    <input type="radio" name="neighbourhood_historicBuildingsAndMonuments_consideration" id="" value="It had never really crossed my mind but it’s something I’d like information on" style="margin-top: -12px;">
								    It had never really crossed my mind but it’s something I’d like information on
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="neighbourhood_historicBuildingsAndMonuments_consideration">
								  <label>
								    <input type="radio" name="neighbourhood_historicBuildingsAndMonuments_consideration" id="" value="No - I don’t care" style="margin-top: -12px;">
								    No - I don’t care
								  </label>
								</div>
                			</div>
                		</div><!-- End of Question 22 -->

                		<div class="col-md-12">
                			<div class="form-group">
                				<label for="">23. When looking for a place to live, do you ever consider the town and country planning policies that affect a neighbourhood?</label>
                                <div class="radio" style="margin-left:40px" name="planningPolicies_consideration">
								  <label>
								    <input type="radio" name="planningPolicies_consideration" id="" value="Yes - it is imperative to my decision" style="margin-top: -12px;">
								    Yes - it is imperative to my decision
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="planningPolicies_consideration">
								  <label>
								    <input type="radio" name="planningPolicies_consideration" id="" value="Mmm - I kind of look but not too important" style="margin-top: -12px;">
								    Mmm - I kind of look but not too important
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="planningPolicies_consideration">
								  <label>
								    <input type="radio" name="planningPolicies_consideration" id="" value="It had never really crossed my mind but it’s something I’d like information on" style="margin-top: -12px;">
								    It had never really crossed my mind but it’s something I’d like information on
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="planningPolicies_consideration">
								  <label>
								    <input type="radio" name="planningPolicies_consideration" id="" value="No - I don’t care" style="margin-top: -12px;">
								    No - I don’t care
								  </label>
								</div>
                			</div>
                		</div><!-- End of Question 23 -->

                		<div class="col-md-12">
                			<div class="form-group">
                				<label for="">24. When looking to move home to what extent is the future of the neighbourhood you are moving into important to you (such as the major housing developments and transport infrastructure improvements that have been scheduled for the neighbourhood)?</label>
                                <div class="radio" style="margin-left:40px" name="neighbourhoodFuture_consideration">
								  <label>
								    <input type="radio" name="neighbourhoodFuture_consideration" id="" value="Yes - it is imperative to my decision" style="margin-top: -12px;">
								    Yes - it is imperative to my decision
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="neighbourhoodFuture_consideration">
								  <label>
								    <input type="radio" name="neighbourhoodFuture_consideration" id="" value="Mmm - I kind of look but not too important" style="margin-top: -12px;">
								    Mmm - I kind of look but not too important
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="neighbourhoodFuture_consideration">
								  <label>
								    <input type="radio" name="neighbourhoodFuture_consideration" id="" value="It had never really crossed my mind but it’s something I’d like information on" style="margin-top: -12px;">
								    It had never really crossed my mind but it’s something I’d like information on
								  </label>
								</div>
                                <div class="radio" style="margin-left:40px" name="neighbourhoodFuture_consideration">
								  <label>
								    <input type="radio" name="neighbourhoodFuture_consideration" id="" value="No - I don’t care" style="margin-top: -12px;">
								    No - I don’t care
								  </label>
								</div>
                			</div>
                		</div><!-- End of Question 24 -->

                		<div class="col-md-6 col-md-offset-3">
                			<div class="form-group">
                                <input id="subt" type="submit" name="submit_survey" class="btn btn-default btn-block" value="SUBMIT">
                			</div>
                		</div><!-- End of Submit Button -->

                	</form>

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
                            <li class="social-twitter"><a href="https://twitter.com/walulel" target="_blank"><i class="fa fa-twitter"></i></a></li>
	                        <li class="social-linkedin"><a href="https://www.linkedin.com/company-beta/11023236" target="_blank"><i class="fa fa-linkedin"></i></a></li>
	                        <li class="social-email"><a href="mailto:info@walulel.com"><i class="fa fa-envelope"></i></a></li>
                        </ul>
                    </p>
                    <p style="color:#fff">Your locale like you've never known. &copy; Walulel Limited 2017.</p>
                    <!--<button  class="btn btn-primary btn-block">Click me</button>-->
                </div>
            </div>
        </div>
    </footer>


    <!-- jQuery -->
    <!-- <script src="https://code.jquery.com/jquery-3.1.1.js" integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA=" crossorigin="anonymous"></script> -->
    <script src="/js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
    <script src="/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="/js/scripts.js"></script>
    
   <script>
    	$('#5x').click(function(){
    		$('#5,#5x').attr('disabled', 'disabled');
    	});
    	
    	$('#5x').click(function(){
    		$('#5i,#5x').attr('disabled', 'disabled');
    	});
    	
    	$('#5x').click(function(){
    		$('#5ii,#5x').attr('disabled', 'disabled');
    	});
    	
    	$('#5x').click(function(){
    		$('#5iii,#5x').attr('disabled', 'disabled');
    	});
    	
    	$('#5x').click(function(){
    		$('#5iv,#5x').attr('disabled', 'disabled');
    	});
    	
    	$('#6x').click(function(){
    		$('#6,#6x').attr('disabled', 'disabled');
    	});
    	
    	$('#7x').click(function(){
    		$('#7,#7x').attr('disabled', 'disabled');
    	});
    	
    	$('#19x').click(function(){
    		$('#19,#19x').attr('disabled', 'disabled');
    	});

    </script>

<?php if( $_GET['wl_s_s'] === 'script_ssf' ): ?>
    <script>
            swal({
                title: 'Survey Submitted!',
                text: 'Thank-you you hero, for taking our survey.',
                timer: 4000
            }).then(function() {
                window.location = "http://test.walulel.co.uk/sign-up.php";
            }, function(dismiss) {
                if (dismiss === 'timer'){
                    window.location = "http://test.walulel.co.uk/sign-up.php";
                }
            });
    </script>
<?php endif; ?>

</body>

</html>
