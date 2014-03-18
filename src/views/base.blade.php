<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Pangea</title>

		@yield('header.styles')
		@yield('header.scripts')

		@if (App::environment() == 'production')
		<script>
			//Google Analytics
		</script>
		@endif
		<link rel="shortcut icon" href="/favicon.ico" />
	</head>
	<body>
		<!--[if lte IE 8]>
		    <p class="browsehappy">Stai utilizzando un browser <strong>vecchio</strong>. Ti consigliamo di effettuarne <a href="http://browsehappy.com/">l'aggiornamento</a> per migliorare la tua esperienza di navigazione.</p>
		<![endif]-->
		@yield('header')
		@yield('body')
		@yield('footer')

		@yield('footer.styles')
		@yield('footer.scripts')
	</body>
</html>