<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/basic_css.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    @section('head_area')
        @yield('head_area')
    @show
</head>

<body>
    @section('nav')
        @include('partials.nav')
    @show

    @section('aside')
        @include('partials.aside')
    @show

    <div class="container">
        @section('content')
            @yield('content')
        @show
    </div>

    @section('message')
		@yield('message')
	@show

    @section('js_area')
    	@yield('js_area')
    @show
</body>

</html>