@include('Landingpage.partials._head')
	<body>

	<div class="gtco-loader"></div>

	<div id="page">
	<nav class="gtco-nav" role="navigation">
		<div class="gtco-container">
			<div class="row">
				<div class="col-xs-2">
					<div id="gtco-logo"><img src="{{ asset('img/logo.png') }}" alt="" style="height:50px;width:50px;"><a href="{{URL::to('')}}">OLMS.</a></div>
				</div>
				<div class="col-xs-10 text-right menu-1">
					<ul>
						<li class="active"><a href="{{URL::to('')}}">Home</a></li>
						<li><a href="{{URL::to('/Services')}}">Services</a></li>
						<li><a href="{{URL::to('/About-Us')}}">About Us</a></li>
						<li><a href="{{URL::to('/Register')}}" id="signuploginbutton">Sign up</a></li>
						<li><a href="{{URL::to('/Login')}}" id="signuploginbutton">Login</a></li>
					</ul>
				</div>
			</div>

		</div>
	</nav>

	<header id="gtco-header" class="gtco-cover" role="banner" style="background-image:url({{ asset('img/landing/background.png') }})">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-center">
					<div class="display-t">
						<div class="display-tc animate-box" data-animate-effect="fadeIn">
							<center><img id="title" src="{{ asset('landing/images/Title.png') }}" alt=""></center>
							<img class="calendarheader" src="{{ asset('landing/images/calendar.png') }}" alt="">
						</div>

					</div>
				</div>
			</div>
		</div>
	</header>
<!-- ////////////////////////////// -->
<div id="gtco-features">
	<div class="gtco-container">
		<div class="row">
			<!-- ////////////////////////////// -->
			<div class="col-md-4 col-sm-4 animate-box" data-animate-effect="fadeIn">
				<div class="feature-center">
					<span class="">
						<img id="service" src="{{ asset('img/bulletinboard.PNG') }}" alt="">
					</span>
					<h3 id="servicetitle">PUPT Library Bulletin Board</h3>
				</div>
			</div>

			<div class="col-md-4 col-sm-4 animate-box" data-animate-effect="fadeIn">
				<div class="feature-center">
					<span class="">
						<img id="service" src="{{ asset('img/schedule.PNG') }}" alt="">
					</span>
					<h3 id="servicetitle">Library Schedule</h3>
				</div>
			</div>

			<div class="col-md-4 col-sm-4 animate-box" data-animate-effect="fadeIn">
				<div class="feature-center">
					<span class="">
						<img id="service" src="{{ asset('img/location.PNG') }}" alt="">
					</span>
					<h3 id="servicetitle">Library Location Map</h3>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- //////////////////////////// -->
	<div id="gtco-counter" class="gtco-bg gtco-cover gtco-counter" style="background-image:url({{ asset('img/landing/divider.png') }});">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="display-t">
					<div class="display-tc">
						<div class="col-md-6 col-sm-12 animate-box">
							<div class="feature-center">
								<span class="icon">
									<i class="icon-open-book"></i>
								</span>

								<span class="counter js-counter" data-from="0" data-to="97" data-speed="5000" data-refresh-interval="50">1</span>
								<span class="counter-label">Books</span>
							</div>
						</div>
						<div class="col-md-6 col-sm-12 animate-box">
							<div class="feature-center">
								<span class="icon">
									<i class="icon-book2"></i>
								</span>
								<span class="counter js-counter" data-from="0" data-to="402" data-speed="5000" data-refresh-interval="50">1</span>
								<span class="counter-label">Ebooks</span>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>

<!-- //////////////////////////// -->

	<div id="gtco-services" style="margin-top:-600px;">
		<div class="gtco-container">

			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
					<h2>What we offer</h2>
				</div>
			</div>

			<div class="row animate-box">

				<div class="gtco-tabs">
					<ul class="gtco-tab-nav">
						<li class="active"><a href="#" data-tab="1"><span class="icon visible-xs"><i class="icon-command"></i></span><span class="hidden-xs">Books</span></a></li>
						<li><a href="#" data-tab="2"><span class="icon visible-xs"><i class="icon-bar-graph"></i></span><span class="hidden-xs">Ebooks</span></a></li>
					</ul>

					<!-- Tabs -->
					<div class="gtco-tab-content-wrap">

						<div class="gtco-tab-content tab-content active" data-tab-content="1">
							<div class="col-md-9">
								<!-- list of books -->
								<div class="card-body table-responsive">
									<table id="datatable" class="table table-bordered table-striped">
										<thead class="text-center">
										<tr>
											<th class="text-center">ID</th>
											<th class="text-center">TITLE</th>
											<th class="text-center">ISBN</th>
										</tr>
										</thead>
										<tbody class="text-center">
										<tr>
											<td>213</td>
											<td>Book Title Sample</td>
											<td>SWA-21512-125125</td>
										</tr>
										<tr>
											<td>123</td>
											<td>Book Title Sample</td>
											<td>SWA-21512-125125</td>
										</tr>
										</tbody>
									</table>
								</div>
								<!-- //////////////// -->
							</div>
						</div>

						<div class="gtco-tab-content tab-content" data-tab-content="2">
							<div class="col-md-9">
								<!-- list of books -->
							</div>
						</div>

						<!-- <div class="gtco-tab-content tab-content" data-tab-content="3">
							<div class="col-md-8">
								list of books
							</div>
						</div>

						<div class="gtco-tab-content tab-content" data-tab-content="4">
							<div class="col-md-8">
								list of books
							</div>
						</div> -->
					</div>

				</div>
			</div>
		</div>
	</div>

<!-- /////////////////////////// -->
<div id="gtco-features-2">
	<div class="gtco-container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
				<h2>About The System</h2>
				<p>Presentation of the system</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="feature-left animate-box" data-animate-effect="fadeInLeft">
					<span class="icon">
						<i class="icon-check"></i>
					</span>
					<div class="feature-copy">
						<h3>Admin</h3>
						<p>Facilis ipsum reprehenderit nemo molestias. Aut cum mollitia reprehenderit. Eos cumque dicta adipisci architecto culpa amet.</p>
					</div>
				</div>

				<div class="feature-left animate-box" data-animate-effect="fadeInLeft">
					<span class="icon">
						<i class="icon-check"></i>
					</span>
					<div class="feature-copy">
						<h3>Student</h3>
						<p>Facilis ipsum reprehenderit nemo molestias. Aut cum mollitia reprehenderit. Eos cumque dicta adipisci architecto culpa amet.</p>
					</div>
				</div>

				<div class="feature-left animate-box" data-animate-effect="fadeInLeft">
					<span class="icon">
						<i class="icon-check"></i>
					</span>
					<div class="feature-copy">
						<h3>Professor</h3>
						<p>Facilis ipsum reprehenderit nemo molestias. Aut cum mollitia reprehenderit. Eos cumque dicta adipisci architecto culpa amet.</p>
					</div>
				</div>

			</div>

			<div class="col-md-6">
				<div class="gtco-video gtco-bg" style="background-image:url({{ asset('img/landing/background.png') }});">
					<a href="https://www.youtube.com/watch?v=mg4zrA47eIw" class="popup-vimeo"><i class="icon-video" style="color:maroon;"></i></a>
					<div class="overlay"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- ///////////////////////// -->

	<footer id="gtco-footer" role="contentinfo">
		<div class="gtco-container">
				<hr>
			<div class="row copyright">
				<div class="col-md-12">
					<p class="pull-left">
						<small class="block">&copy; 2021. All Rights Reserved.</small>
						<small class="block">Designed by <a href="" style="color:maroon;">BNK Developers</a></small>
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
	@section('scripts')
<script>
        $(document).ready(function(){
            $('.select2').select2({
                theme: "classic",
                width: "resolve"
            });

            var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                bjQueryUI: true,
                ajax : {
                    url : "{{ route('MaterialsDatatables') }}",
                    type : "GET",
                    dataType: 'JSON'
                },
                columns: [
                    {data: 'materials_id', name: 'materials_id'},
                    {data: 'accnum', name: 'accnum'},
                    {data: 'isbn', name: 'isbn'},
                    {data: 'title', name: 'title'},
                    {data: 'type', name: 'type'},
                ],
                dom: 'Bfrtip',
                responsive: true,  "autoWidth": false,
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        })
    </script>
@endsection
@include('Landingpage.partials._footer')
