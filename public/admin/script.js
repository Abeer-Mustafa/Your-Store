
var APP_URL = $("#url").val();
var jsonFiel = $("#jsonFiel").val();
var User_Country = $("#User_Country").val();
var User_State = $("#User_State").val();
var User_City = $("#User_City").val();

// ****************
// Select Countries
// ****************
$(document).ready(function(){
  var countryOptions = '';
  var stateOptions = '';
  var cityOptions = '';
  var statesSelected = '';
  var citiesSelected = '';
  var country_id = User_Country;
  var pathFile = jsonFiel;

  $.getJSON(pathFile, function(data){
    countryOptions += '<option value="">Select country</option>';
    $.each(data, function(key, country){
    	if(User_Country == country.id) countryOptions += '<option country="'+country.id+'" value="'+country.name+'" selected>'+country.name+'</option>';
      else countryOptions += '<option country="'+country.id+'" value="'+country.name+'">'+country.name+'</option>';
    
    });
    $('#country').html(countryOptions);
  });
  $.getJSON(pathFile, function(data){
    stateOptions = '<option value="">Select state</option>';
    $.each(data, function(key, country){
      if(User_Country == country.id) statesSelected = country.states;
    });
    $.each(statesSelected, function(key, state){
      if(User_State == state.id) stateOptions += '<option state="'+state.id+'" value="'+state.name+'" selected>'+state.name+'</option>';
      stateOptions += '<option state="'+state.id+'" value="'+state.name+'">'+state.name+'</option>';
    });
    $('#state').html(stateOptions);
  });
  $.getJSON(pathFile, function(data){
    cityOptions = '<option value="">Select city</option>';
    $.each(data, function(key, country){
      if(User_Country == country.id){
        var statesCurrent = country.states;
        $.each(statesCurrent, function(key, state){
          if(User_State == state.id)citiesSelected = state.cities;
        });
      }
    });
    $.each(citiesSelected, function(key, city){
      if(User_City == city.id) cityOptions += '<option city="'+city.id+'" value="'+city.name+'" selected>'+city.name+'</option>';
      cityOptions += '<option city="'+city.id+'" value="'+city.name+'">'+city.name+'</option>';
    });
    $('#city').html(cityOptions);
  });

  $('#country').on('change', function(){
    country_id =  $('option:selected', this).attr('country');
    $('#Country_ID').val(country_id);
    if(country_id != ''){
      $.getJSON(pathFile, function(data){
        stateOptions = '<option value="">Select state</option>';
        $.each(data, function(key, country){
          if(country_id == country.id) statesSelected = country.states;
        });
          $.each(statesSelected, function(key, state){
          	if(User_State == state.id) stateOptions += '<option state="'+state.id+'" value="'+state.name+'" selected>'+state.name+'</option>';
            stateOptions += '<option state="'+state.id+'" value="'+state.name+'">'+state.name+'</option>';
          });
        $('#state').html(stateOptions);
      });
    }
    else {
      $('#state').html('<option value="">Select state</option>');
      $('#city').html('<option value="">Select city</option>');
    }
  });
  
  $('#state').on('change', function(){
    var state_id = $('option:selected', this).attr('state');
    $('#State_ID').val(state_id);
    if(state_id != ''){
      $.getJSON(pathFile, function(data){
        cityOptions = '<option value="">Select city</option>';
        $.each(data, function(key, country){
          if(country_id == country.id){
            var statesCurrent = country.states;
            $.each(statesCurrent, function(key, state){
              if(state_id == state.id)citiesSelected = state.cities;
            });
          }
        });
        $.each(citiesSelected, function(key, city){
        	if(User_City == city.id) cityOptions += '<option city="'+city.id+'" value="'+city.name+'" selected>'+city.name+'</option>';
          cityOptions += '<option city="'+city.id+'" value="'+city.name+'">'+city.name+'</option>';
        });
        $('#city').html(cityOptions);
      });
    }
    else
      $('#city').html('<option value="">Select city</option>');
  });

  $('#city').on('change', function(){
    var city_id = $('option:selected', this).attr('city');
    $('#City_ID').val(city_id);
  });
});