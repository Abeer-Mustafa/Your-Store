<!DOCTYPE html>
<html dir="ltr" lang="en"
  class="@yield('htmlClass')"
  data-jb="7f711446" data-jv="3.1.2.1" data-ov="3.0.2.0">

<head typeof="og:website">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('Title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base />
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <meta property="fb:app_id" content="" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="E-Commerce" />
    <meta property="og:url" content="@yield('TitleURL')" />
    <meta property="og:image" content="@yield('TitleImage')" />
    <meta property="og:image:width" content="600" />
    <meta property="og:image:height" content="315" />
    <meta property="og:description" content="@yield('TitleDesc')" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="@yield('Title')" />
    <meta name="twitter:image" content="@yield('TitleImage')" />
    <meta name="twitter:image:width" content="200" />
    <meta name="twitter:image:height" content="200" />
    <meta name="twitter:description" content="@yield('TitleDesc')" />
  
  <script src="{{ asset('front') }}/js/bundle.min.js" ntegrity="sha384-lowBFC6YTkvMIWPORr7+TERnCkZdo5ab00oH5NkFLeQUAmBTLGwJpFjF6djuxJ/5" crossorigin="anonymous"> </script>
  
  <script src="{{ asset('front') }}/js/script1.js"></script>
  <script src="{{ asset('front') }}/js/script2.js"></script>

  <link href="https://fonts.googleapis.com/css?family=Roboto:400,700%7CPoppins:700&amp;subset=latin-ext" type="text/css" rel="stylesheet" />
  
  <link href="{{ asset('front') }}/theme/assets/@yield('cssAssets')" type="text/css" rel="stylesheet" media="all" /> 
  
  <link href="{{ asset('front') }}/image/catalog/logo/fav.png" rel="icon" />
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-89408750-1"></script>
  <script src="{{ asset('front') }}/js/script3.js"></script>

  <link href="{{ asset('front') }}/css/@yield('cssfile').css" rel="stylesheet" />
  <link href="{{ asset('front') }}/css/common.css" rel="stylesheet" />
  <link href="{{ asset('front') }}/css/mycss.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('front') }}/css/lang_{{ currentLang() }}.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
  <script src="{{ asset('front') }}/theme/assets/@yield('jsAssets')"></script>
  <?php
    if(!session()->has('cur_currency')){
      session()->put('cur_currency', 1);
      session()->put('cur_symbol', '$');
      session()->put('cur_title', __('controller.US Dollar'));
      session()->put('cur_code', 'USD');
    } 
  ?>
  @yield('jsLibraries')

</head>