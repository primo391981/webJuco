<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles 
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<script src="{{ asset('js/app.js') }}"></script>-->
	
	<!-- Bootstrap-->
	
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	
	<!-- MetisMenu CSS -->
    <link href="{{ asset('css/metisMenu.min.css')}}" rel="stylesheet">
	<script src="{{ asset('js/metisMenu.min.js')}}"></script>
	<!-- Custom CSS -->
    <link href="{{ asset('css/sb-admin-2.css')}}" rel="stylesheet">
    <script src="{{ asset('js/sb-admin-2.js')}}"></script>
    <!-- Morris Charts CSS utilizado para graficas-->
    <link href="{{ asset('css/morris.css')}}" rel="stylesheet">
	<!-- Timeline-->
    <link href="{{ asset('css/timeline.css')}}" rel="stylesheet">
	<!-- Selects-->
    <link href="{{ asset('css/bootstrap-select.css')}}" rel="stylesheet">
    <!-- Iconos -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
	<script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
		
	<!--SCRIPTS SUMMERNOTE-->
	<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
	<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
<!--TABLAS DINAMICAS-->	
	
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">

<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
	
<!--SELECTS DINAMICOS-->	
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

@yield('librerias')
		
</head>
<body>    
	<div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                @yield('navbar')
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
					<li class="nav-item"> 
						<button class="btn btn-link" data-toggle="modal" data-target="#modalAyuda" title="Ayuda"><i class="fas fa-question-circle"></i> </button>
					</li>
					
					<li class="nav-item"> 
						<button class="btn btn-link" data-toggle="modal" data-target="#modalAcerca" title="Acerca"><i class="fas fa-info-circle"></i> </button>
					</li>
			</ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                       	<!-- CONTENIDO DEL MENU LATERAL DINAMICO -->
						@yield('menu-lateral')
						
						<li class="nav-item"> 
							 <a class="dropdown-item" href="{{ route('logout') }}"
							 onclick="event.preventDefault();
							 document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
						</li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

		<div id="page-wrapper">
			<!-- CONTENIDO DE LA INTRANET DINAMICO  -->
			@yield('content')
		</div>
    </div>
    <!-- /#wrapper -->    
	
	<!-- Modal Acerca-->
<div class="modal fade" id="modalAcerca" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Acerca de Sistema JUCO (Jurídico - Contable)</h4>
      </div>
      <div class="modal-body">
        Versión: 1.02<br>
		Equipo de proyecto: Martín Ghiglia, Fabián Sellanes, Diego Unibazo<br>
		Universidad de la Empresa<br>
		2018<br>
      </div>
    </div>
  </div>
</div>
	<!-- Modal Ayuda-->
<div class="modal fade" id="modalAyuda" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Ayuda de Sistema JUCO (Jurídico - Contable)</h4>
      </div>
      <div class="modal-body">
        @yield('contentAyuda')
      </div>
    </div>
  </div>
</div>
	
	
	<script>
      $('#summernote').summernote({
        placeholder: 'Texto del contenido',
        tabsize: 2,
        height: 100,
		toolbar: [
			// [groupName, [list of button]]
			['style', ['bold', 'italic', 'underline', 'clear']],
			['font', ['strikethrough', 'superscript', 'subscript']],
			['fontsize', ['fontsize']],
			['color', ['color']],
			['para', ['ul', 'ol', 'paragraph']],
			['height', ['height']]
		  ]
      });
	  
	$('.form-avoid-double-submit').on('submit', function(){        
		$('.btn-avoid-double-submit').attr('disabled', true);
	});

    </script>
	
</body>
</html>