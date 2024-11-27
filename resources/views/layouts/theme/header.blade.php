<div class="header">
	<div class="header-content" >
		<nav class="navbar navbar-expand">
			<div class="collapse navbar-collapse justify-content-between">
				<div class="header-left" style="margin: auto;">
				</div>

				<ul class="navbar-nav header-right">

					<li class="nav-item">

						<livewire:search />
					
					</li>
				

					<li class="nav-item dropdown header-profile">
						<a class="nav-link" href="#" role="button" data-toggle="dropdown" style="color:#487EB4">
							<div class="header-info" id="user-profile">
								<span class="fs-20 font-w500">
									@auth
									{{ Auth::user()->name }}
									@endauth
								</span>
								<small style="color: #60060F;">
									@auth
									{{ Auth::user()->role }}
									@endauth
								</small>
							</div>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<a href="{{ route('logout') }}" 
							onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
							class="dropdown-item ai-icon">
								<svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
								<span class="ml-2">Cerrar Sesión </span>
							<form id="logout-form" action="{{ route('logout') }}" method="POST">
								@csrf
							</form>
							<a>
						</div>
					</li>
				</ul>
			</div>
		</nav>
	</div>
</div>