<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="">
        <meta name="description" content="@yield('description')">
        <title>@yield('title')</title>
		
		@include('partials._styles')
    </head>

    <body>
        @include('partials._header')

        @yield('content')

        @include('partials._footer')

        @include('partials._scripts')

        @yield('additional_scripts')
    </body>
</html>