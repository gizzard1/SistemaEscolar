<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=0.5">
    <title>SIPE</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/momo/chuchis.png') }}">
	@include('layouts.theme.styles')
	
    <livewire:styles />

</head>
<body>
    
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1" style="background-color: #E2BBB4;"></div>
            <div class="sk-child sk-bounce2" style="background-color: #E2BBB4;"></div>
            <div class="sk-child sk-bounce3" style="background-color: #E2BBB4;"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

		<!--**********************************
            Header start
        ***********************************-->
		@include('layouts.theme.header')
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->        

        <!--**********************************
            Sidebar start
        ***********************************-->
		@include('layouts.theme.sidebar')
        <!--**********************************
            Sidebar end
        ***********************************-->
		
		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				{{ $slot ?? '' }}
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

		<!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


	</div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    @include('layouts.theme.scripts')
    <livewire:scripts />
</body>
</html>