@extends('admin.index')

@section('subTitle')
  Edit Profile
@endsection

@section('content')
  <section class="content">
    <div class="row">
      <div class="col-sm-8">
        <form action="{{ route('profilePost') }}" method="post"
          enctype="multipart/form-data" class="form-horizontal" name = "registerForm" onsubmit = "return(RegisterValidate());">
          @csrf
	        <input type="hidden" name="User_Country" value="{{ $user->country }}" id="User_Country">
	        <input type="hidden" name="User_State" value="{{ $user->state }}" id="User_State">
	        <input type="hidden" name="User_City" value="{{ $user->city }}" id="User_City">
	        <input type="hidden" name="Country_ID" value="{{ $user->country }}" id="Country_ID">
	        <input type="hidden" name="State_ID" value="{{ $user->state }}" id="State_ID">
	        <input type="hidden" name="City_ID" value="{{ $user->city }}" id="City_ID">
          
          <!-- Your Personal Details -->
          <div class="form-group" >
            <label class="required control-label col-md-4" for="name">Full Name</label>
            <div class="col-md-8">
              <input type="text" name="name" value="{{ $user->name }}" placeholder="Full Name" id="name" 
                class="form-control @error('name') is-invalid @enderror" autofocus/>
              <strong id="nameMessage" class="ErrorMessage"></strong>
              @error('name')
                <span class="invalid-feedback ErrorMessage" role="alert">
                  <strong >{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>

          <div class="form-group">
            <label class="required control-label col-md-4" for="input-email">E-Mail</label>
            <div class="col-md-8">
              <input type="email" name="email" value="{{ $user->email }}" placeholder="E-Mail" id="input-email"
                class="form-control @error('email') is-invalid @enderror" />
                <strong id="emailMessage" class="ErrorMessage"></strong>
                @error('email')
                <span class="invalid-feedback ErrorMessage" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>

          <div class="form-group">
            <label class="required control-label col-md-4" for="input-telephone">Phone</label>
            <div class="col-md-8">
              <input type="tel" name="phone" value="{{ $user->phone }}" placeholder="Phone" id="input-telephone"
                class="form-control @error('phone') is-invalid @enderror" />
                <strong id="phoneMessage" class="ErrorMessage"></strong>
                @error('phone')
                <span class="invalid-feedback ErrorMessage" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>   

          <div class="form-group">
            <label class="control-label col-md-4" for="input-mobile">Mobile</label>
            <div class="col-md-8">
              <input type="tel" name="mobile" value="{{ $user->mobile }}" placeholder="Mobile" id="input-mobile"
                class="form-control @error('mobile') is-invalid @enderror" />
                <strong id="mobileMessage" class="ErrorMessage"></strong>
                @error('mobile')
                <span class="invalid-feedback ErrorMessage" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>

          <!-- Your Password -->
          <div class="form-group">
            <label class="control-label col-md-4 account-pass" for="input-password">Password</label>
            <div class="col-md-8">
              <input type="password" name="password" id="input-password"
                class="form-control @error('password') is-invalid @enderror" />
                <small style="color:#888;">Leave your password blank if you don't want to change it</small>
                <strong id="passwordMessage" class="ErrorMessage"></strong>
              @error('password')
                <span class="invalid-feedback ErrorMessage" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-4" for="input-confirm">Password Confirm</label>
            <div class="col-md-8">
              <input type="password" name="password_confirmation" placeholder="Password Confirm" id="input-confirm"
                class="form-control" />
            </div>
          </div>

        	<!-- Your Address -->
          <div class="form-group ">
            <label class="required control-label col-md-4" for="input-country">Country</label>
            <div class="col-md-8">
              <select name="country" id="country" class="form-control @error('country') is-invalid @enderror">
                <option value="">Select Country</option>
              </select>
              <strong id="countryMessage" class="ErrorMessage"></strong>
              @error('country')
                <span class="invalid-feedback ErrorMessage" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>

          <div class="form-group ">
            <label class="required control-label col-md-4" for="input-region">Region/State</label>
            <div class="col-md-8">
              <select name="state" id="state" class="form-control @error('state') is-invalid @enderror">
                <option value="">Select State</option>
              </select>
              <strong id="stateMessage" class="ErrorMessage"></strong>
              @error('state')
                <span class="invalid-feedback ErrorMessage" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>       

          <div class="form-group">
            <label class="required control-label col-md-4" for="input-city">City</label>
            <div class="col-md-8">
              <select name="city" id="city"  class="form-control @error('city') is-invalid @enderror">
                <option value="">Select City</option>
              </select>
              <strong id="cityMessage" class="ErrorMessage"></strong>
              @error('city')
                <span class="invalid-feedback ErrorMessage" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>              

          <!-- Your Image -->
          <div class="form-group">
            <input type="hidden" name="hidden_image" value="{{ $user->image }}" id="hidden_image">
            <?php
              if(Auth::user()->image) $user_img = URL::to('storage').'/images/users/'.Auth::user()->image;
              else $user_img = URL::to('front').'/image/catalog/default_user.png';
            ?>   
            <label class="control-label col-md-4">Image</label>    
            <div class="col-md-8">
              <img src="{{$user_img}}" alt="{{Auth::user()->name}}" title="{{Auth::user()->name}}" width="65"  />
              <input type="file" name="image" id="image" style="margin-top: 6px;" class="@error('image') is-invalid @enderror" />
              <strong id="imageMessage" class="ErrorMessage"></strong>
              @error('image')
                <span class="invalid-feedback ErrorMessage" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>

          <!-- Save Button -->
          <div class="form-group">
          	<label class="control-label col-md-4"></label>
            <div class="col-md-8">
	            <button type="submit" class="btn btn-success btn-block" ><span>Save Changes</span></button>
	          </div>
          </div>
        </form>
      </div>
    </div>
  </section>
@endsection

@push('AJAX')
<script type="text/javascript">
var APP_URL = "{{ url('/') }}";
var User_Country = $("#User_Country").val();
var User_State = $("#User_State").val();
var User_City = $("#User_City").val();
// *****************
// Register Validate
// *****************
function RegisterValidate() {
  // Name Field
  var nameMessage = document.getElementById('nameMessage');
  var nameField = document.registerForm.name;
  var matchString = /^[A-Za-z\u0600-\u06FF\u0750-\u077F ]+$/;
  if( nameField.value == "" ) {
    nameMessage.innerHTML="The Name field is required.";
    nameField.focus() ;
    return false;
  }
  if( !nameField.value == "" ) {
    nameMessage.innerHTML="";
  }
  if( !nameField.value.match(matchString) ) {
    nameMessage.innerHTML="The Name field must be a string";
    nameField.focus() ;
    return false;
  }
  if( nameField.value.match(matchString)  ) {
    nameMessage.innerHTML="";
  }
  if( nameField.value.length > 40) {
    nameMessage.innerHTML="The Name field must be less than 40 characters";
    nameField.focus() ;
    return false;
  } 
  if( nameField.value.length <= 40) {
    nameMessage.innerHTML="";
  }

  // Email Field
  var emailMessage = document.getElementById('emailMessage');
  var emailField = document.registerForm.email;
  if( emailField.value == "" ) {
    emailMessage.innerHTML="The Email field is required.";
    emailField.focus() ;
    return false;
  } 
  if( !emailField.value == "" ) {
    emailMessage.innerHTML="";
  } 
  if( emailField.value.length > 40) {
    emailMessage.innerHTML="The Email field should be less than 40 charcters";
    emailField.focus() ;
    return false;
  } 
  if( emailField.value.length <= 40) {
    emailMessage.innerHTML="";
  }

  // Phone Field
  var phoneMessage = document.getElementById('phoneMessage');
  var phoneField = document.registerForm.phone;
  var matchNumber = /^[0-9]/;
  if( phoneField.value == "" ) {
    phoneMessage.innerHTML="The Phone field is required.";
    phoneField.focus() ;
    return false;
  } 
  if( !phoneField.value == "" ) {
    phoneMessage.innerHTML="";
  } 
  if( !phoneField.value.match(matchNumber) ) {
    phoneMessage.innerHTML="The Phone field must be a number.";
    phoneField.focus() ;
    return false;
  }
  if( phoneField.value.match(matchNumber)  ) {
    phoneMessage.innerHTML="";
  }

  // Password Field
  var passwordMessage = document.getElementById('passwordMessage');
  var passwordField = document.registerForm.password;
  var passwordConf = document.registerForm.password_confirmation;
  if(passwordField.value && passwordField.value.length < 8 ) {
    passwordMessage.innerHTML="The Password field should be at least 8 charcters" ;
    passwordField.focus() ;
    return false;
  } 
  if(passwordField.value && passwordField.value.length >= 8 ) {
    passwordMessage.innerHTML="" ;
  } 
  if( passwordField.value !==  passwordConf.value) {
    passwordMessage.innerHTML="The Password confirmation does not match" ;
    passwordConf.focus() ;
    return false;
  } 
  if( passwordField.value !==  passwordConf.value) {
    passwordMessage.innerHTML="The Password confirmation does not match" ;
    passwordConf.focus() ;
    return false;
  } 
  if( passwordField.value ===  passwordConf.value ) {
    passwordMessage.innerHTML="" ;
  }

  // Country Field
  var countryMessage = document.getElementById('countryMessage');
  var countryField = document.registerForm.country;
  if( countryField.value == "" ) {
    countryMessage.innerHTML="The Country field is required.";
    countryField.focus() ;
    return false;
  } 
  if( !countryField.value == "" ) {
    countryMessage.innerHTML="";
  } 

  // State Field
  var stateMessage = document.getElementById('stateMessage');
  var stateField = document.registerForm.state;
  if( stateField.value == "" ) {
    stateMessage.innerHTML="The State field is required.";
    stateField.focus() ;
    return false;
  } 
  if( !stateField.value == "" ) {
    stateMessage.innerHTML="";
  } 
  
  // City Field
  var cityMessage = document.getElementById('cityMessage');
  var cityField = document.registerForm.city;
  if( cityField.value == "" ) {
    cityMessage.innerHTML="The City field is required.";
    cityField.focus() ;
    return false;
  } 
  if( !phoneField.value == "" ) {
    phoneMessage.innerHTML="";
  } 
}


$(document).ready(function(){
  console.log(User_Country);
});


</script>
@endpush