@extends('front.layouts.main')

<!-- *************************** -->
<!-- ***** Head | Sections ***** -->
<!-- *************************** -->
@section('htmlClass')
desktop win mozilla oc30 is-guest route-account-register store-0 skin-1 desktop-header-active compact-sticky mobile-sticky layout-6 one-column column-right
@endsection

@section('Title')
{{__('home.Register Account')}}
@endsection

@section('TitleURL')
  {{ url('/login')}}
@endsection

@section('TitleImage')
  {{ URL::to('/front') }}/image/catalog/logo/10-2x-600x315h.png
@endsection

@section('TitleDesc')
Register Account
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
      <li><a href="">{{__('home.Register')}}</a></li>
    </ul>
    <h1 class="title page-title"><span>{{__('home.Register Account')}}</span></h1>


    <div id="account-register" class="container">
      <div class="row">
        <div id="content" class="col-sm-9 register-page">

          <p >{{__('home.have an account')}}
            <a href="{{ route('login')}} " class="RedHover">{{__('home.login page')}} </a>.
          </p>
          <form action="{{ route('register') }}" method="post"
            enctype="multipart/form-data" class="register-form form-horizontal" name = "registerForm" onsubmit = "return(RegisterValidate());">
            @csrf
            <input type="hidden" name="Country_ID" value="" id="Country_ID">
            <input type="hidden" name="State_ID" value="" id="State_ID">
            <input type="hidden" name="City_ID" value="" id="City_ID">
            <!-- Your Personal Details -->
            <div id="account">
              <legend>{{__('home.Your Personal Details')}}</legend>

              <div class="form-group required padLeft2 account-firstname" >
                <label class="col-sm-2 control-label" for="name">{{__('home.Full Name')}}</label>
                <div class="col-sm-12 StyleErrorMessage">
                  <input type="text" name="name" value="{{ old('name') }}" placeholder="{{__('home.Full Name')}}" id="name" 
                    class="form-control @error('name') is-invalid @enderror" autofocus/>
                  <strong id="nameMessage" class="ErrorMessage"></strong>
                  @error('name')
                    <span class="invalid-feedback ErrorMessage" role="alert">
                      <strong >{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

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

              <div class="form-group required padLeft2 account-telephone">
                <label class="col-sm-2 control-label" for="input-telephone">{{__('home.Phone')}}</label>
                <div class="col-sm-12 StyleErrorMessage">
                  <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="{{__('home.Phone')}}" id="input-telephone"
                    class="form-control @error('phone') is-invalid @enderror" />
                    <strong id="phoneMessage" class="ErrorMessage"></strong>
                    @error('phone')
                    <span class="invalid-feedback ErrorMessage" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
            </div>

            <!-- Your Password -->
            <fieldset>
              <legend>{{__('home.Your Password')}}</legend>
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
              <div class="form-group required padLeft2 account-pass2">
                <label class="col-sm-2 control-label" for="input-confirm">{{__('home.Confirm Password')}}</label>
                <div class="col-sm-12 StyleErrorMessage">
                  <input type="password" name="password_confirmation" placeholder="{{__('home.Confirm Password')}}" id="input-confirm"
                    class="form-control" />
                </div>
              </div>
            </fieldset>            

            <!-- Your Address -->
            <fieldset>
              <legend>{{__('home.Your Address')}}</legend>

              <div class="form-group required padLeft2">
                <label class="col-sm-2 control-label account-country" for="input-country">{{__('home.Country')}}</label>
                <div class="col-sm-12 StyleErrorMessage">
                  <select name="country" id="country" class="form-control @error('country') is-invalid @enderror">
                    <option value="">{{__('home.Select Country')}}</option>
                  </select>
                  <strong id="countryMessage" class="ErrorMessage"></strong>
                  @error('country')
                    <span class="invalid-feedback ErrorMessage" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="form-group required padLeft2 account-pass2">
                <label class="col-sm-2 control-label" for="input-region">{{__('home.Region/State')}}</label>
                <div class="col-sm-12 StyleErrorMessage">
                  <select name="state" id="state" class="form-control @error('state') is-invalid @enderror">
                    <option value="">{{__('home.Select State')}}</option>
                  </select>
                  <strong id="stateMessage" class="ErrorMessage"></strong>
                  @error('state')
                    <span class="invalid-feedback ErrorMessage" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>       

              <div class="form-group required padLeft2 account-pass2">
                <label class="col-sm-2 control-label" for="input-city">{{__('home.City')}}</label>
                <div class="col-sm-12 StyleErrorMessage">
                  <select name="city" id="city"  class="form-control @error('city') is-invalid @enderror">
                    <option value="">{{__('home.Select City')}}</option>
                  </select>
                  <strong id="cityMessage" class="ErrorMessage"></strong>
                  @error('city')
                    <span class="invalid-feedback ErrorMessage" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>              

            </fieldset>
            <div>
              <div class="mt-4 text-center">
                <button type="submit" class="btn btn-block btn-danger" ><span>{{__('home.Continue')}}</span></button>
              </div>
            </div>
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
<script  src="{{ asset('front') }}/js/register.js"></script>
@include('front.includes.trans_auth') 
</body>
</html>
@endsection
