<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

   <!-- ============================= -->
   <!-- =========== Header ========== -->
   <!-- ============================= -->
   <header class="main-header">
      <!-- Logo -->
      <a href="{{ route('dashboard') }}" class="logo">
         <span class="logo-mini"><b><i class="fa fa-gears"></i><b/></span>
         <span class="logo-lg"><i class="fa fa-dashboard"></i>  {{ __('dashboard.Dashboard') }}</span>
      </a>

      <!-- Navbar -->
      <nav class="navbar navbar-static-top">
         <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">{{ __('dashboard.Toggle navigation') }}</span>
         </a>
         
         <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
               <li class="dropdown messages-menu" >
                  <a href="{{ url('/') }}" >
                     {{ __('dashboard.Home') }}
                  </a>
               </li>

               <!-- Languages -->
               <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                     <span class="hidden-xs">{{ __('dashboard.Languages') }}</span>
                  </a>
                  <ul class="dropdown-menu">
                     <li>
                       <a class="" href="{{ url('/setlocale/en') }}">
                         <img src="{{ asset('front/image/catalog/flags/en.jpg') }}" width="25" height="20" alt="English-image" height="12">
                         &nbsp; &nbsp;
                         <span>{{ __('home.English') }}</span>
                       </a>
                     </li>
                     <li>
                       <a class="" href="{{ url('/setlocale/ar') }}">
                         <img src="{{ asset('front/image/catalog/flags/ar.png') }}"  width="25" height="20" alt="Arabic-image" height="12">
                         &nbsp; &nbsp;
                         <span >{{ __('home.Arabic') }}</span>
                       </a>
                     </li>
                  </ul>
               </li>

               <!-- User Account -->
               <li class="dropdown user user-menu">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                     @if(Auth::user()->image)
                        <img src="{{ URL::to('/storage') }}/images/users/{{Auth::user()->image}}"  class="user-image" alt="User Image" />
                     @else
                        <img src="{{ URL::to('/front') }}/image/catalog/default_user.png"  class="user-image" alt="User Image" />
                     @endif
                     <span class="hidden-xs">{{ Auth::user()->name}}</span>
                  </a>
                  <ul class="dropdown-menu">
                     <li class="user-header">
                        @if(Auth::user()->image)
                           <img src="{{ URL::to('/storage') }}/images/users/{{Auth::user()->image}}"  class="img-circle" alt="User Image" />
                        @else
                           <img src="{{ URL::to('/front') }}/image/catalog/default_user.png"  class="img-circle" alt="User Image" />
                        @endif
                        <p>
                           {{ Auth::user()->name}}
                           <small>{{ __('dashboard.MemberSince') }} {{ Auth::user()->created_at }}</small>
                        </p>
                    </li>
                     <li class="user-footer">
                        <div class="pull-left">
                           <a href="{{ route('profile')}}" class="btn btn-default btn-flat">{{ __('dashboard.Profile') }}</a>
                        </div>
                        <div class="pull-right">
                           <a class="btn btn-default btn-flat"
                              href="{{ route('logout') }}"
                              onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                               {{ __('dashboard.SignOut') }}
                           </a>
                           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                           </form>
                        </div>
                     </li>
                  </ul>
               </li>


            </ul>
         </div>
      </nav>
   </header>
    <input type="hidden" value="{{FILE}}json/countries.json" id="jsonFiel" name="jsonFiel">
   