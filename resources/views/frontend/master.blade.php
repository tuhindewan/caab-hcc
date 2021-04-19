<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'Laravel') }}  @yield('title')</title>

  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="hold-transition layout-top-nav" style="height: 2000px; padding-top:56px;">
<div class="wrapper">

    @include('frontend.partials.navbar')

  @yield('content')

  @include('frontend.partials.footer')
</div>

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
@stack('page-js')
</body>
</html>
