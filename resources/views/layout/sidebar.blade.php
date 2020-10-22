<!-- Main sidebar -->
		<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

			<!-- Sidebar mobile toggler -->
			<!-- <div class="sidebar-mobile-toggler text-center">
				<a href="#" class="sidebar-mobile-main-toggle">
					<i class="icon-arrow-left8"></i>
				</a>
				Navigation
				<a href="#" class="sidebar-mobile-expand">
					<i class="icon-screen-full"></i>
					<i class="icon-screen-normal"></i>
				</a>
			</div> -->
			<!-- /sidebar mobile toggler -->


			<!-- Sidebar content -->
			<div class="sidebar-content">
				
				<div class="sidebar-user-material">
					<div class="sidebar-user-material-body">
						<div class="card-body text-center">
							<a href="#">
								<img src="{{ asset('global_assets/images/image.png') }}" class="img-fluid rounded-circle shadow-1 mb-3" width="80" height="80" alt="">
							</a>
							<h6 class="mb-0 text-white text-shadow-dark">{{ session('user')['first_name'] . ' ' . session('user')['last_name'] }}</h6>

						</div>
													
						<div class="sidebar-user-material-footer">
							<a href="#user-nav" class="d-flex justify-content-between align-items-center text-shadow-dark dropdown-toggle" data-toggle="collapse"><span>Navigation</span></a>
						</div>
					</div>

					<div class="collapse" id="user-nav">
						<ul class="nav nav-sidebar">
							<li class="nav-item">
								<a href="{{ route('api_logout') }}" class="nav-link">
									<i class="icon-switch2"></i>
									<span>Logout</span>
								</a>
							</li>
							
						
							
						</ul>
					</div>
				</div>

				<!-- User menu -->
				<!-- <div class="sidebar-user-material">
					<div class="sidebar-user-material-body">
						<div class="card-body text-center">
							<a href="#">
								<img src="{{ asset('global_assets/images/image.png') }}" class="img-fluid rounded-circle shadow-1 mb-3" width="80" height="80" alt="">
							</a>
							<h6 class="mb-0 text-white text-shadow-dark">{{ session('user')['first_name'] . ' ' . session('user')['last_name'] }}</h6>

						</div>
													
						<div class="sidebar-user-material-footer">
							<a href="#user-nav" class="d-flex justify-content-between align-items-center text-shadow-dark dropdown-toggle" data-toggle="collapse"><span>Navigation</span></a>
						</div>
					</div>

					<div class="collapse" id="user-nav">
						<ul class="nav nav-sidebar">
							<li class="nav-item">
								<a href="{{ route('api_logout') }}" class="nav-link">
									<i class="icon-switch2"></i>
									<span>Logout</span>
								</a>
							</li>
							
						
							
						</ul>
					</div>
				</div> -->
				<!-- /user menu -->


				<!-- Main navigation -->
				<div class="card card-sidebar-mobile">
					<ul class="nav nav-sidebar" data-nav-type="accordion">

						<!-- Main -->
					
						@if(in_array(session('user')['user_type_id'], array(55)))
						<li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">INQUIRIES</div> <i class="icon-menu" title="Main"></i></li>
						<li class="nav-item">
							<a target="_blank" href="traviz2020" class="nav-link">
								<i class="icon-user-plus"></i>
								<span>New inquiry</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('inquiries') }}" class="nav-link">
								<i class="icon-list"></i>
								<span>Inquiries</span>
							</a>
						</li>
			
					
						@endif 
						
						@if(in_array(session('user')['user_type_id'], array(55)))
					
					
						<li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">REPORTS</div> <i class="icon-menu" title="Main"></i></li>
						<li class="nav-item">
							<a href="{{ route('affected-units') }}" class="nav-link">
								<i class="icon-truck"></i>
								<span>Affected Units</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('reports.export_travis_rs') }}" class="nav-link">
								<i class="icon-list-unordered"></i>
								<span>TRAVIZ RS</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('reports.export_travis_pullout') }}" class="nav-link">
								<i class="icon-list-unordered"></i>
								<span>TRAVIZ PULLOUT</span>
							</a>
						</li>
						@endif 
						<!-- /main -->

					</ul>
				</div>
				<!-- /main navigation -->

			</div>
			<!-- /sidebar content -->
			
		</div>
		<!-- /main sidebar -->