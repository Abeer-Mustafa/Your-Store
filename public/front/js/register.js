
var jsonFiel = $("#jsonFiel").val();

/*
|-------------------------------------
|---------- Select Countries ---------
|-------------------------------------
*/
$(document).ready(function(){
  var countryOptions = '';
  var stateOptions = '';
  var cityOptions = '';
  var statesSelected = '';
  var citiesSelected = '';
  var country_id = '';
  var pathFile = jsonFiel;

  $.getJSON(pathFile, function(data){
    countryOptions += '<option value="">Select country</option>';
    $.each(data, function(key, country){
      countryOptions += '<option country="'+country.id+'" value="'+country.name+'">'+country.name+'</option>';
    });
    $('#country').html(countryOptions);
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