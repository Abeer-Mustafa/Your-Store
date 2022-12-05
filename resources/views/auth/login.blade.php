@extends('front.layouts.main')

<!-- *************************** -->
<!-- ***** Head | Sections ***** -->
<!-- *************************** -->
@section('htmlClass')
desktop win mozilla oc30 is-guest route-account-register store-0 skin-1 desktop-header-active compact-sticky mobile-sticky layout-6 one-column column-right
@endsection

@section('Title')
{{__('home.Login')}}
@endsection

@section('TitleURL')
  {{ url('/login')}}
@endsection

@section('TitleImage')
  {{ URL::to('/front') }}/image/catalog/logo/10-2x-600x315h.png
@endsection

@section('TitleDesc')
Login
@endsection

@section('cssAssets')
7e57e9b00b1eabc084a21e4dd7387162fdc9.css?v=7f711446
@endsection

@section('cssfile')
style
@endsection

@section('jsAssets')
c4cd4981133c7c0f792cf762de2922c8fdc9.js?v=7f711446
@endsection


@section('jsLibraries')
@endsection


@section('content')
    <ul class="breadcrumb">
      <li><a href="{{ url('/') }}"><i class="fa fa-home"></i>{{__('home.Home')}}</a></li>
      <li><a href="">{{__('home.Login')}}</a></li>
    </ul>
    <h1 class="title page-title"><span>{{__('home.Login')}}</span></h1>


    <div id="account-register" class="container">
      <div class="row">
        <div id="content" class="col-sm-9 register-page">

          <p>{{__('home.Why account')}}</p>
            <p> {{__('home.have no account')}}
            <a href="{{ route('register')}} " class="RedHover">{{__('home.Register page')}} </a>.
            </p>
          <form action="{{ route('login') }}" method="post"
            enctype="multipart/form-data" class="register-form form-horizontal" name = "registerForm" onsubmit = "return(LoginValidate());">
            @csrf
            <!-- Your Personal Details -->
            <div id="account">
              <legend>{{__('home.Returning Customer')}}</legend>

              <div class="form-group required padLeft2 account-email">
                <label class="col-sm-2 control-label" for="input-email">{{__('home.E-Mail')}}</label>
                <div class="col-sm-12 StyleErrorMessage">
                  <input type="email" name="email" value="{{ old('email') }}" placeholder="{{__('home.E-Mail')}}" id="input-email"
                    class="form-control @error('email') is-invalid @enderror" />
                    <strong id="emailMessage" class="ErrorMessage"></strong>
                    @error('email')
                    <span class="invalid-feedback ErrorMessage" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="form-group required padLeft2">
                <label class="col-sm-2 control-label account-pass" for="input-password">{{__('home.Password')}}</label>
                <div class="col-sm-12 StyleErrorMessage">
                  <input type="password" name="password" value="{{ old('password') }}" placeholder="{{__('home.Password')}}" id="input-password"
                    class="form-control @error('password') is-invalid @enderror" />
                    <strong id="passwordMessage" class="ErrorMessage"></strong>
                  @error('password')
                    <span class="invalid-feedback ErrorMessage" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>   

              <div class="form-group padLeft2">
                <label class="col-sm-2 control-label account-pass" for="input-password">{{__('home.Remember Me')}}</label>
                <div class="col-sm-12">
                  <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                </div>
              </div>
              
            </div>

            <div class="mt-4 text-center">
              <button type="submit" class="btn btn-block btn-danger" ><span>{{__('home.Login')}}</span></button>
            </div>
            </br>
            @if (Route::has('password.request'))
              <div class="mt-4 text-center" style="margin-top: 2%;">
                <a href="{{ route('password.request') }}" class="text-muted"><i class="mdi mdi-lock mr-1"></i> {{__('home.Forgot your password?')}}</a>
              </div>
            @endif

          </form>
        </div>
      </div>
    </div>
@endsection

<!-- ******************* -->
<!-- ***** Scripts ***** -->
<!-- ******************* -->
@section('jsFooterScripts')
<script  src="{{ asset('front') }}/theme/assets/608bdd2a8e5cf8cd74b96d306c67d941fdc9.js?v=7f711446" defer></script>
@include('front.includes.trans_auth') 
</body>
</html>
@endsection
