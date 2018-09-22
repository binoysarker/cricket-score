<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>CricketScore | @yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('/css/app.css')}}">
  </head>
  <body>
    <div id="app">
      <header class="container-fluid">
        @include('CricketScore.layouts.partials.navbar')
      </header>
      <div class="container">
        <div class="row">
          @yield('main-content')
        </div>
      </div>
    </div>
    <script type="text/javascript" src="{{asset('/js/app.js')}}">

    </script>
  </body>
</html>
