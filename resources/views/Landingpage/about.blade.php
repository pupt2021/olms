@include('Landingpage.partials._head')
	<body>

	<div class="gtco-loader"></div>

	<div id="page">
		<nav class="gtco-nav" role="navigation">
			<div class="gtco-container">
				<!-- //////////////////////// -->
				<div class="row">
					<div class="col-xs-2">
						<div id="gtco-logo"><img src="{{ asset('img/logo.png') }}" alt="" style="height:50px;width:50px;"><a href="{{URL::to('')}}">OLMS.</a></div>
					</div>
					<div class="col-xs-10 text-right menu-1">
						<ul>
							<li><a href="{{URL::to('')}}">Home</a></li>
							<li><a href="{{URL::to('/Services')}}">Services</a></li>
							<li  class="active"><a href="{{URL::to('/About-Us')}}">About Us</a></li>
							<li><a href="{{URL::to('/Register')}}" id="signuploginbutton">Sign up</a></li>
							<li><a href="{{URL::to('/Login')}}" id="signuploginbutton">Login</a></li>
						</ul>
					</div>
				</div>
				<!-- //////////////////////// -->

			</div>
		</nav>

		<header id="gtco-header" class="gtco-cover gtco-cover-sm" role="banner" style="background-image:url({{ asset('img/landing/background.png') }});">
			<div class="overlay"></div>
			<div class="gtco-container">
				<div class="row">
					<div class="col-md-12 col-md-offset-0 text-center">
						<div class="display-t">
							<div class="display-tc animate-box" data-animate-effect="fadeIn">
								<h1>ONLINE LIBRARY MANAGEMENT SYSTEM</h1><br>
								<h2>About Us</h2>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>

		<!-- //////////////////////////// -->
		<div id="gtco-features-2">
			<div class="gtco-container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
						<h2 style="font-family:trajan_reg;">Library</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="feature-left animate-box" data-animate-effect="fadeInLeft">
							<div class="feature-copy">
								<p style="font-size:20px;">In order to have a more efficient way of giving library services, PUP Taguig is now using a computerized library system
									that features all the services a library has. It includes: locating library resources for study and research purposes, lend
									books and other reading materials, and facilitates acquisition of books.</p>
							</div>
						</div>

					</div>

					<div class="col-md-6">
						<img id="abouts" src="{{ asset('landing/images/service2.JPG') }}" alt="">
					</div>
				</div>
			</div>
		</div>
<!-- ////////////////////////////////// -->
		<div class="gtco-cover1 gtco-cover-sm1" style="background-image:url({{ asset('img/landing/divider.png') }});">
			<div class="overlay"></div>
			<div class="gtco-container">
				<div class="row">
					<div class="col-md-12 col-md-offset-0 text-center">
						<div class="display-t">
							<div class="display-tc animate-box" data-animate-effect="fadeIn">
								<h1><center><strong>History of Library</strong></center></h1>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
<!-- ///////////////////////////////////////// -->
	<div class="gtco-section">
		<div class="gtco-container">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 gtco-heading">
					<h2><center></center></h2><br>
					<p>PUP-Taguig Library started in 1994 at the 2nd Floor of building A where the DOST lab is located today. Headed by Ms. Elsa Pambuena and when she left for
					a month leave, Ms. Liwanag Maliksi has took charge in the Operations of the Library. Due to Ms. Maliksi’s educational attainment that doesn’t align with the
					library operations, she became an officer in-charge for the library until 1997.</p>
					<br>
					<p>In year 1997, Mrs. Gina Dela Cruz has taken over the library as Head of Library Services. During her time, books were limited but arranged and fixed, the
					tables are round and the space is limited. She was assisted by Mr. Sigmund Heinrich Sese in 2003 and Mrs. Charolyn V. De Luna in 2008.</p>
					<br>
					<p>Library was transferred in 2nd floor of Building B that occupied two rooms requested by Mrs. Dela Cruz. Before the current library system (Online
					Public Access Catalog), Mr. Arlan Deluta, a graduate of Bachelor of Science in Information Technology made a library system same as the
					current system but older version wherein there’s a picture for each student who borrows a book from the library. Due to the system overload and a lot of
					bugs, the system wasn’t used anymore today. Mrs. De Luna and the other past student assistants help Mrs. Dela Cruz to manage the library.</p>
					<br>
					<p>In early 2010, Library was transferred to its current location in 2nd floor of Building C but the library is still under renovations such as the floor has no tiles
					and sometimes the floor was filled with mud. Most of the books that are in the PUP-Taguig Library are donated by other schools, came from PUP-Main,
					donated by Alumni’s and sponsorships.</p>
					<br>
					<p>Year 2015 when Mrs. Elena C. Mamansag became the Head Librarian, she organized the books and used the Library of Congress Classification System to
					re-organized the Core Collection of the Library. She adopted a  new local Library System done by Jericho Gregorio… et al, that is user friendly and can
					generate report easily. Until now the PUPT Library System is still working and maintained by the Librarian and assisted by the IT/  DICT students assigned
					by BSIT Coordinator Ms. Gecille Almirañez. So far the Library have improved and become conducive to learning. The reading area have two (2) Air
					conditioning units, curtains, printer, steel shelves and vinyled floor, 3 units of computers for technical works and 2 units of high end computers for the
					STARBOOKS and three units of laptop for students use.</p>
				</div>
			</div>

		</div>
	</div>
<!-- ///////////////////////////////////////// -->
	<div class="gtco-cover1 gtco-cover-sm1" style="background-image:url({{ asset('img/landing/divider.png') }});">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-center">
					<div class="display-t">
						<div class="display-tc animate-box" data-animate-effect="fadeIn">
							<h1><strong>Officials and Staff</strong></h1>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- /////////////////////////////////////////// -->
	<div id="gtco-team" class="gtco-section">
		<div class="gtco-container">
			<div class="row animate-box">
			</div>
			<div class="row row-pb-md">
				<div class="col-md-6 animate-box" data-animate-effect="fadeIn">
					<div class="gtco-staff">
						<img src="{{ asset('landing/images/ferrer.PNG') }}">
						<h3>Dr. Marissa B. Ferrer</h3>
						<strong class="role">Branch Director</strong>
						<ul class="gtco-social-icons">
							<li><a href="#"><i class="icon-facebook"></i></a></li>
							<li><a href="#"><i class="icon-twitter"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-6 animate-box" data-animate-effect="fadeIn">
					<div class="gtco-staff">
						<img src="{{ asset('landing/images/che.png') }}">
						<h3>Cecilia R. Alagon, LPT, Ed. D</h3>
						<strong class="role">Head of Accademic Programs</strong>
						<ul class="gtco-social-icons">
							<li><a href="#"><i class="icon-facebook"></i></a></li>
							<li><a href="#"><i class="icon-twitter"></i></a></li>
						</ul>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6 animate-box" data-animate-effect="fadeIn">
					<div class="gtco-staff">
						<img src="{{ asset('landing/images/elena.PNG') }}">
						<h3>Elena C. Mamansag</h3>
						<strong class="role">Librarian</strong>
						<ul class="gtco-social-icons">
							<li><a href="#"><i class="icon-facebook"></i></a></li>
							<li><a href="#"><i class="icon-twitter"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-6 animate-box" data-animate-effect="fadeIn">
					<div class="gtco-staff">
						<img src="{{ asset('landing/images/charo.PNG') }}">
						<h3>Charolyn V. De Luna</h3>
						<strong class="role">Library Staff</strong>
						<ul class="gtco-social-icons">
							<li><a href="#"><i class="icon-facebook"></i></a></li>
							<li><a href="#"><i class="icon-twitter"></i></a></li>
						</ul>
					</div>
				</div>
			</div>

		</div>
	</div>

	<footer id="gtco-footer" role="contentinfo">
		<div class="gtco-container">
			<hr>
			<div class="row copyright">
				<div class="col-md-12">
					<p class="pull-left">
						<small class="block">&copy; 2021. All Rights Reserved.</small>
						<small class="block">Designed by <a href="">BNK Developers</a></small>
					</p>
					<p class="pull-right">
						<ul class="gtco-social-icons pull-right">
							<li><a href="#"><i class="icon-twitter"></i></a></li>
							<li><a href="#"><i class="icon-facebook"></i></a></li>
						</ul>
					</p>
				</div>
			</div>

		</div>
	</footer>
	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>
	
@include('Landingpage.partials._footer')