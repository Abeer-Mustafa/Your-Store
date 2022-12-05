<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="keywords" content="Shop, E-Commerce, online, book, Clothes, Elctronics, Shopping">
   <meta name="description" content="E-Commerce Website">
   <meta name="author" content="Abeer Mustafa">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <title>{{ __('dashboard.Dashboard') }}</title>
  <link href="{{ asset('front') }}/image/catalog/logo/fav.png" rel="icon" />
    <script src="{{ asset('admin') }}/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('admin') }}/bower_components/jquery-ui/jquery-ui.min.js"></script>
    <script src="{{ asset('admin') }}/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    
   <link rel="stylesheet" href="{{ asset('admin') }}/bower_components/bootstrap/dist/css/bootstrap.min.css">
   <link rel="stylesheet" href="{{ asset('admin') }}/bower_components/font-awesome/css/font-awesome.min.css">
   <link rel="stylesheet" href="{{ asset('admin') }}/dist/css/AdminLTE.min.css">
   <!-- <link rel="stylesheet" href="{{ asset('admin') }}/dist/css/skins/_all-skins.min.css"> -->
   <link rel="stylesheet" href="{{ asset('admin') }}/dist/css/skins/skin-green.css">
   <!-- bootstrap wysihtml5 - text editor -->
   <link rel="stylesheet" href="{{ asset('admin') }}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
   <link rel="stylesheet" href="{{ asset('admin') }}/bower_components/Ionicons/css/ionicons.min.css">
   <link rel="stylesheet" href="{{ asset('admin') }}/plugins/iCheck/all.css">
   
   <!-- <link rel="stylesheet" href="{{ asset('admin') }}/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css"> -->
   <!-- <link rel="stylesheet" href="{{ asset('admin') }}/bower_components/bootstrap-daterangepicker/daterangepicker.css"> -->
   <!-- <link rel="stylesheet" href="{{ asset('admin') }}/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css"> -->
   <!-- <link rel="stylesheet" href="{{ asset('admin') }}/bower_components/select2/dist/css/select2.min.css"> -->
   <!-- <link rel="stylesheet" href="{{ asset('admin') }}/plugins/timepicker/bootstrap-timepicker.min.css"> -->
   <!-- <link rel="stylesheet" href="{{ asset('admin') }}/bower_components/morris.js/morris.css"> -->
   <!-- <link rel="stylesheet" href="{{ asset('admin') }}/bower_components/jvectormap/jquery-jvectormap.css"> -->
   
   <!-- DataTabels -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />

    <!-- Google Font -->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
   <!-- Custom Style -->
   <link rel="stylesheet" href="{{ asset('admin') }}/style.css">
  <link rel="stylesheet" href="{{ asset('admin') }}/dist/css/AdminLTE_{{ currentLang() }}.min.css">
  <script src="https://kit.fontawesome.com/d2b7f212e6.js" crossorigin="anonymous"></script>

</head>
