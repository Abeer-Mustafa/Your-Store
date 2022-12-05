@extends('front.layouts.main')

<!-- *************************** -->
<!-- ***** Head | Sections ***** -->
<!-- *************************** -->
@section('htmlClass')
desktop win mozilla oc30 is-guest route-information-contact store-0 skin-1 desktop-header-active compact-sticky mobile-sticky layout-8
@endsection

@section('Title')
{{ __('home.Contact Us') }}
@endsection

@section('TitleURL')
{{ url('/contact')}}
@endsection

@section('TitleImage')
{{ URL::to('/front') }}/image/catalog/logo/logo.png
@endsection

@section('TitleDesc')
Contact Us
@endsection

@section('cssAssets')
7e57e9b00b1eabc084a21e4dd7387162fdc9.css?v=7f711446
@endsection

@section('cssfile')
style_contact
@endsection

@section('jsAssets')
d331f857d88bb95ba7c9e71c4f63a97bfdc9.js?v=7f711446
@endsection

@section('jsLibraries')
  <!-- Load Leaflet from CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.3/leaflet.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.3/leaflet.js"></script>
  <!-- Load geocoding plugin after Leaflet -->
  <link rel="stylesheet" href="https://maps.locationiq.com/v2/libs/leaflet-geocoder/1.9.6/leaflet-geocoder-locationiq.min.css">
  <script src="https://maps.locationiq.com/v2/libs/leaflet-geocoder/1.9.6/leaflet-geocoder-locationiq.min.js"></script>

  <style type="text/css">
    #map {
      width: 100%;
      height: 100%;
      background-color:transparent;
    }
  </style>
@endsection

@section('content')
  <ul class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="fa fa-home"></i>{{ __('home.Home') }}</a></li>
    <li><a href="">{{ __('home.Contact Us') }}</a></li>
  </ul>
  <h1 class="title page-title"><span>{{ __('home.Contact Us') }}</span></h1>

	<div id="information-contact" class="container">
	  <div class="row">
	    <div id="content" class="col-sm-12">
	      <div id="content-top">
	        <div class="grid-rows">

	        	<!-- Map -->
	          <div class="grid-row grid-row-content-top-1">
	            <div class="grid-cols">
	              <div class="grid-col grid-col-content-top-1-1">
	                <div class="grid-items">
	                  <div class="grid-item grid-item-content-top-1-1-1">
	                    <div class="module module-blocks module-blocks-104 blocks-grid">
	                      <div class="module-body">
	                        <div class="module-item module-item-1 no-expand">
	                          <div class="block-body expand-block">
	                            <div class="block-wrapper">
	                              <div class="block-content  block-map">
	                                <div class="journal-loading"><i class="fa fa-spinner fa-spin"></i></div>
            											<div id="map"></div>
	                              </div>
	                            </div>
	                          </div>
	                        </div>
	                      </div>
	                    </div>
	                  </div>
	                </div>
	              </div>
	            </div>
	          </div>

	          <!-- Form Contact -->
	          <div class="grid-row grid-row-content-top-2">
	            <div class="grid-cols">
	            	<!-- Left Column -->
	              <div class="grid-col grid-col-content-top-2-1">
	                <div class="grid-items">
	                  <div class="grid-item grid-item-content-top-2-1-1">
	                    <div class="module module-info_blocks module-info_blocks-194">
	                      <div class="module-body">
	                        <div class="module-item module-item-1 info-blocks info-blocks-icon">
	                          <a href="tel:18005559090" class="info-block">
	                            <div class="info-block-content">
	                              <div class="info-block-title">{{ __('home.Store Address') }}</div>
	                              <div class="info-block-text">{{ __('home.123 Main St,') }} <br />{{ __('home.London, UK') }} </div>
	                            </div>
	                          </a>
	                        </div>
	                        <div class="module-item module-item-2 info-blocks info-blocks-icon">
	                          <a href="tel:18005559090" class="info-block">
	                            <div class="info-block-content">
	                              <div class="info-block-title">{{ __('home.Call Us') }}</div>
	                              <div class="info-block-text">{{ __('home.Tel') }}: 1.800.555.9090<br /> {{ __('home.Fax') }}: 1.800.555.9090</div>
	                            </div>
	                          </a>
	                        </div>
	                        <div class="module-item module-item-3 info-blocks info-blocks-icon">
	                          <a href="tel:18005559090" class="info-block">
	                            <div class="info-block-content">
	                              <div class="info-block-title">{{ __('home.Store Hours') }}</div>
	                              <div class="info-block-text">{{ __('home.Mon-Fri') }}: 10:00 - 20:00<br /> {{ __('home.Weekend') }}: 12:00 - 16:00</div>
	                            </div>
	                          </a>
	                        </div>
	                        <div class="module-item module-item-4 info-blocks info-blocks-icon">
	                          <a href="tel:18005559090" class="info-block">
	                            <div class="info-block-content">
	                              <div class="info-block-title">{{ __('home.Custom Blocks') }}</div>
	                              <div class="info-block-text">{{ __('home.Create unlimited blocks') }}</div>
	                            </div>
	                          </a>
	                        </div>
	                      </div>
	                    </div>
	                  </div>
	                </div>
	              </div>
	              <!-- Right Column -->
	              <div class="grid-col grid-col-content-top-2-2">
	                <div class="grid-items">
	                  <div class="grid-item grid-item-content-top-2-2-1">
	                    <div class="module module-form module-form-20" style="line-height: 32px;">
	                      <h3 class="title module-title">{{ __('home.Leave Us a Message') }}</h3>
	                      <div class="module-body">
	                        <form id="contact_form" class="form-horizontal">
	                        	@csrf
	                          <fieldset>
	                            <div class="form-group custom-field required">
	                              <label class="col-sm-2 control-label" for="field-5f19495dc597c-1">{{ __('home.Your Name') }}</label>
	                              <div class="col-sm-10">
	                                <input type="text" id="name" name="name" value="" placeholder="{{ __('home.Your Name') }}"
	                                  id="field-5f19495dc597c-1" class="form-control"required />
	                                </div>
	                            </div>
	                            <div class="form-group custom-field required">
	                              <label class="col-sm-2 control-label" for="field-5f19495dc597c-2">{{ __('home.Your Email') }}</label>
	                              <div class="col-sm-10">
	                                <input type="email" id="email" name="email" value="" placeholder="{{ __('home.Your Email') }}"
	                                  id="field-5f19495dc597c-2" class="form-control" required /></div>
	                            </div>
	                           
	                            <div class="form-group custom-field required">
	                              <label class="col-sm-2 control-label" for="field-5f19495dc597c-4">{{ __('home.Message') }}</label>
	                              <div class="col-sm-10"><textarea id="message" name="message" rows="5" placeholder="{{ __('home.Message') }}"
	                                  id="field-5f19495dc597c-4" class="form-control" required ></textarea></div>
	                            </div>
	                          </fieldset>
	                          <div class="buttons">
	                            <div class="pull-right submit_contact">
	                              <button type="button" id="submit_contact" class="btn btn-primary" data-loading-text="<span>Submit</span>" >
	                              	<span>{{ __('home.Submit') }}</span>
	                              </button>
	                            </div>
	                          </div>
	                        </form>
	                      </div>
	                    </div>
	                  </div>
	                </div>
	              </div>
	            </div>
	          </div>
	        </div>
	      </div>
	    </div>
	  </div>
	</div>

 	<!-- Modal | Send Message Successfuly -->
  <div class="modal" tabindex="-1" role="dialog" id="modalContact">
    <div class="modal-dialog" role="document" style="width:31%;">
      <div class="modal-content" style="background-color:#d2eac8;">
        <div class="modal-body">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <p id="contentModalContact">response ajax contact</p>
        </div>
      </div>
    </div>
  </div> 	

  <!-- Modal | Send Message Error -->
  <div class="modal" tabindex="-1" role="dialog" id="modalContact_error">
    <div class="modal-dialog" role="document" style="width:31%;">
      <div class="modal-content" style="background-color:rgb(236 164 178);">
        <div class="modal-body">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <p id="contentModalContact_error">response ajax contact</p>
        </div>
      </div>
    </div>
  </div>

 @endsection

<!-- ******************* -->
<!-- ***** Scripts ***** -->
<!-- ******************* -->
@section('jsFooterScripts')
	<script  src="{{ asset('front') }}/theme/assets/608bdd2a8e5cf8cd74b96d306c67d941fdc9.js?v=7f711446" defer></script>
	<script  src="{{ asset('front') }}/js/home.js"></script>
	 <!-- Googl Mapa -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.0.3/leaflet.js"></script>
  <script type="text/javascript" src="https://tiles.unwiredlabs.com/js/leaflet-unwired.js?v=1"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-hash/0.2.1/leaflet-hash.min.js"></script>
  <script src="https://maps.locationiq.com/v2/libs/leaflet-geocoder/1.9.6/leaflet-geocoder-locationiq.min.js"></script>  
	<script  src="{{ asset('front') }}/js/maps.js"></script>
	<script >
	
	</script>

</body>
</html>
@endsection