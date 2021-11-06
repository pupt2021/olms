@include('Landingpage.partials._head')
	<body>

	<div class="gtco-loader"></div>

	<div id="page">
		<nav class="gtco-nav" role="navigation">
			<div class="gtco-container">
				<div class="row">
					<div class="col-xs-2">
						<div id="gtco-logo"><img src="{{ asset('landing/images/logo.png') }}" alt="" style="height:50px;width:50px;"><a href="{{URL::to('')}}">OLMS.</a></div>
					</div>
					<div class="col-xs-10 text-right menu-1">
						<ul>
							<li><a href="{{URL::to('')}}">Home</a></li>
							<li  class="active"><a href="{{URL::to('/Services')}}">Services</a></li>
							<li><a href="{{URL::to('/About-Us')}}">About Us</a></li>
							<li><a href="{{URL::to('/Register')}}" id="signuploginbutton">Sign up</a></li>
							<li><a href="{{URL::to('/Login')}}" id="signuploginbutton">Login</a></li>
						</ul>
					</div>
				</div>

			</div>
		</nav>

	<header id="gtco-header" class="gtco-cover gtco-cover-sm" role="banner" style="background-image:url({{ asset('img/landing/background.png') }});">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center">
					<div class="display-t">
						<div class="display-tc animate-box" data-animate-effect="fadeIn">
							<h1>ONLINE LIBRARY MANAGEMENT SYSTEM</h1><br>
							<h2>Services Offered</h2>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	<div id="gtco-features">
		<div class="gtco-container">
			<div class="row">
				<!-- ////////////////////////////// -->
				<center><h1 data-animate-effect="fadeIn" style="font-family:trajan_reg;"><b>PUPT Students Utilization of MULTIMEDIA Services</b></h1></center>
				<div class="col-md-6 col-sm-6 animate-box" data-animate-effect="fadeIn">
					<div class="feature-center">
						<span class="">
							<img id="service" src="{{ asset('landing/images/google/dost.png') }}" alt="">
						</span>
						<h3 id="servicetitle">DOST STARBOOK DIGITAL LIBRARY</h3>
					</div>
				</div>

				<div class="col-md-6 col-sm-6 animate-box" data-animate-effect="fadeIn">
					<div class="feature-center">
						<span class="">
							<img id="service" src="{{ asset('landing/images/google/1.png') }}" alt="">
						</span>
						<h3 id="servicetitle">Internet searching (Multimedia)/ access to online database</h3>
					</div>
				</div>
			</div>
<!-- ///////////////////// -->
			<div class="row">
				<center><h1 data-animate-effect="fadeIn" style="font-family:trajan_reg;"><b>Other Library Services</b></h1></center>
				<div class="col-md-6 col-sm-6 animate-box" data-animate-effect="fadeIn">
					<div class="feature-center">
						<span class="">
							<img id="service1" src="{{ asset('landing/images/service1.JPG') }}" alt="">
						</span>
						<h3 data-animate-effect="fadeIn" id="servicetitle" >Reader Services</h3>
					</div>
				</div>

				<div class="col-md-6 col-sm-6 animate-box" data-animate-effect="fadeIn">
					<div class="feature-center">
						<span class="">
							<img id="service1" src="{{ asset('landing/images/google/charging.png') }}" alt="">
						</span>
						<h3 data-animate-effect="fadeIn" id="servicetitle">Charging and Discharging Books</h3>
					</div>
				</div>

				<div class="col-md-6 col-sm-6 animate-box" data-animate-effect="fadeIn">
					<div class="feature-center">
						<span class="">
							<img id="service1" src="{{ asset('landing/images/google/readingbook.png') }}" alt="">
						</span>
						<h3 data-animate-effect="fadeIn" id="servicetitle">Reference and Research Services</h3>
					</div>
				</div>

				<div class="col-md-6 col-sm-6 animate-box" data-animate-effect="fadeIn">
					<div class="feature-center">
						<span class="">
							<img id="service1" src="{{ asset('landing/images/google/research.png') }}" alt="">
						</span>
						<h3 data-animate-effect="fadeIn" id="servicetitle">Research Books</h3>
					</div>
				</div>

			</div>


		</div>
	</div>
<!-- /////////////////////////////// -->
	<div class="gtco-cover1 gtco-cover-sm1" style="background-image:url({{ asset('img/landing/divider.png') }});">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-center">
					<div class="display-t">
						<div class="display-tc animate-box" data-animate-effect="fadeIn">
							<h1><strong>CITIZENS CHAPTER</strong></h1>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- /////////////////////////////// -->
<!-- ///////////////////////////// -->
<div class="gtco-section">
	<div class="gtco-container">
		<div class="row animate-box">
			<div class="col-md-8 col-md-offset-2 gtco-heading">
				<h2><center>Vision</center></h2><br>
				<p>Clearing the paths while laying new foundations to transform the Polytechnic University of the Philippines into an epistemic community.</p>
				<br>
				<p>In year 1997, Mrs. Gina Dela Cruz has taken over the library as Head of Library Services. During her time, books were limited but arranged and fixed, the
				tables are round and the space is limited. She was assisted by Mr. Sigmund Heinrich Sese in 2003 and Mrs. Charolyn V. De Luna in 2008.</p>
				<br>
				<h2><center>Mission</center></h2><br>
				<p>Reflective of the great emphasis being given by the country's leadership aimed at providing appropriate attention to the alleviation of the plight of the poor,
				the development of the citizens, and of the national economy to become globally competitive, the University shall commit its academic resources and
				manpower to achieve its goals through:</p>
				<p>1. Provision of undergraduate and graduate education which meet international standards of quality and excellence;</p>
				<p>2. Generation and transmission of knowledge in the broad range of disciplines relevant and responsive to the dynamically changing domestic and international environment;</p>
				<p>3. Provision of more equitable access to higher education opportunities to deserving and qualified Filipinos; and</p>
				<p>4. Optimization, through efficiency and effectiveness, of social, institutional, and individual returns and benefits derived from the utilization of higher education resources.</p>
			</div>
		</div>

	</div>
</div>
<!-- ////////////////////////////// -->
<!-- /////////////////////////////// -->
	<div class="gtco-cover1 gtco-cover-sm1" style="background-image:url({{ asset('img/landing/divider.png') }});">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-center">
					<div class="display-t">
						<div class="display-tc animate-box" data-animate-effect="fadeIn">
							<h1><strong>PUP Taguig Library Goal and Objectives</strong></h1>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- /////////////////////////////// -->
	<div class="gtco-section">
		<div class="gtco-container">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 gtco-heading">
					<h2><center>Goal</center></h2><br>
					<p>To develop and manage PUP Taguig Library collections that are relevant to the university's curricular program and responsive to student and faculty needs.</p>
					<br><br>
					<h2><center>Vision</center></h2><br>
					<p>1. To determine PUPT student and faculty needs.</p>
					<p>2. To build a balanced collection of information in all and subject areas. PUPT library material budgets are targeted for allocations:	40% books,  40% subscription, 10% audiovisuals, 10% computer files.</p>
					<p>3. To support PUPT faculty and library staff to remain current in the selection process.</p>
					<p>4. To remove worn, outdated, and unnecessary material from the PUPT Library collection.</p>
					<p>5. To evaluate the quality of the collection and its effectiveness in meeting student and faculty needs.</p>
					<p>6. To evaluate effectiveness of selection and acquisition processes.</p>
				</div>
			</div>

		</div>
	</div>
<!-- /////////////////////////////// -->
	<div class="gtco-cover1 gtco-cover-sm1" style="background-image:url({{ asset('img/landing/divider.png') }});">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-center">
					<div class="display-t">
						<div class="display-tc animate-box" data-animate-effect="fadeIn">
							<h1><strong>Service</strong></h1>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- /////////////////////////////// -->
	<div class="gtco-section">
		<div class="gtco-container">
			<div class="row animate-box">
				<div class="col-md-18 gtco-heading">

					<div class="col-md-6">
						<h2><center>LIBRARY SERVICES</center></h2><br>
						<p>The heart of the university, the Library is one of the major service centers of the Polytechnic University of the Philippines
						  Taguig Branch. As such, it strives to meet the academic and related needs of its clientele through the provision of adequate and
						  efficient library and information services.
						  The PUP Taguig Library serves as the University’s gateway to the global information society, and provides various services and
						  development of program to its clientele. For donation of books and other library resources and other information and assistance, please see:
						  ELENA C. MAMANSAG
						  Librarian I
						  </p>
					</div>
					<div class="col-md-6">
						<h2><center>SERVICE HOURS</center></h2><br>
						<p>The Library is open from Monday to Friday from 8:00 AM to 8:00 PM. It is also open during Saturdays from 8:00 AM to
						  5:00 PM. Service stops fifteen (15) minutes before the regular closing time to enable the staff member to check
						  records and the collection in preparation for the next day’s routine. Changes in service hours are posted in advance
						  at the entrance of the library. The library is closed during Sundays and Holidays.
						  </p>
					</div>

				</div>
			</div>

		</div>
	</div>
<!-- ////////////////////////////////// -->
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