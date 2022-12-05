
var APP_URL = $("#url").val();

/*
|----------------------------------------------------------------------
|---------- Filter Results in Category | Brand | All Products ---------
|----------------------------------------------------------------------
*/

//----------  Clear filter ---------
function clearFilter(url){
  	$("#mainCat").val($("#mainMainCat").val());
  	$("#brandValue").val("0");
  	$("#min_price").val($("#main_min_price").val());
  	$("#max_price").val($("#main_max_price").val());
  	$("#sort").val("created_DESC");
  	$("#limit").val("1000000");
  	$("#SortItems").val("created_DESC");
  	$("#NumItems").val("1000000");
  	$("input[type='checkbox']").attr('checked', false);
  	$("input[type='radio']").attr('checked', false);
  	$("#cat").val("0");
  	$("#brand").val("0");
  	$("#Red").val("0");
  	$("#Blue").val("0");
    $("#Green").val("0");
  	$("#Pink").val("0");
  	$("#Gray").val("0");
  	$("#Purple").val("0");
  	$("#White").val("0");
  	$("#Orange").val("0");
  	$("#Yellow").val("0");
  	$("#Brown").val("0");
  	$("#Black").val("0");
  	$("#S").val("0");
  	$("#XS").val("0");
  	$("#XXS").val("0");
  	$("#M").val("0");
  	$("#L").val("0");
  	$("#XL").val("0");
  	$("#XXL").val("0");
  	$.ajax({
	    url: APP_URL + url,
	    method: 'GET',
	    data: $("#hidden_values").serialize(),
	    dataType: 'json',
	    beforeSend: function () {
	      $('#allProducts').html('<img src="' + APP_URL + '/front/image/loader.gif" style="margin: auto; width:10%;">');
	    },
	    success: function (json) {
	      if (json['success']) { $('#allProducts').load(APP_URL + '/updateProducts'); }
	    }
	});
	updateSlider();
}

//----------  Input: limit-cat ---------
function limitFilter(selectObject, url){
	var limit = selectObject.value;  
  	$("#limit").val(limit);
  	$.ajax({
	    url: APP_URL + url,
	    method: 'GET',
	    data: $("#hidden_values").serialize(),
	    dataType: 'json',
	    beforeSend: function () {
	      $('#allProducts').html('<img src="' + APP_URL + '/front/image/loader.gif" style="margin: auto; width:10%;">');
	    },
	    success: function (json) {
	      if (json['success']) {
	        $('#allProducts').load(APP_URL + '/updateProducts');
	      }
	    },
  	});
}

//----------  Input: sort-cat ---------
function sortFilter(selectObject, url){
  	$("#sort").val(selectObject.value);
  	$.ajax({
	    url: APP_URL + url,
	    method: 'GET',
	    data: $("#hidden_values").serialize(),
	    dataType: 'json',
	    beforeSend: function () {
	      $('#allProducts').html('<img src="' + APP_URL + '/front/image/loader.gif" style="margin: auto; width:10%;">');
	    },
	    success: function (json) {
	      if (json['success']) {
	        $('#allProducts').load(APP_URL + '/updateProducts');
	      }
	    },
  	});
}

//----------  Input: Color ---------
function colorFilter(color, url){
  	var currentClor = color.value;
  	if($(color).prop("checked") == true) $("#" + currentClor).val(currentClor);
  	else $("#" + currentClor).val('0');
  	$.ajax({
	    url: APP_URL + url,
	    method: 'GET',
	    data: $("#hidden_values").serialize(),
	    dataType: 'json',
	    beforeSend: function () {
	      $('#allProducts').html('<img src="' + APP_URL + '/front/image/loader.gif" style="margin: auto; width:10%;">');
	    },
	    success: function (json) {
	      if (json['success']) {
	        $('#allProducts').load(APP_URL + '/updateProducts');
	      }
	    },
  	});
}

//----------  Input: Size ---------
function sizeFilter(size, url){
  	var currentSize = size.value;
  	if($(size).prop("checked") == true) $("#" + currentSize).val(currentSize);
  	else $("#" + currentSize).val('0');
  	$.ajax({
	    url: APP_URL + url,
	    method: 'GET',
	    data: $("#hidden_values").serialize(),
	    dataType: 'json',
	    beforeSend: function () {
	      $('#allProducts').html('<img src="' + APP_URL + '/front/image/loader.gif" style="margin: auto; width:10%;">');
	    },
	    success: function (json) {
	      if (json['success']) {
	        $('#allProducts').load(APP_URL + '/updateProducts');
	      }
	    },
 	});
}

//----------  Input: Subcat ---------
function subcatsFilter(subcat, url){
    var currentCat = subcat.value;
    if($(subcat).prop("checked") == true) { 
        $("#cat").val(currentCat);
        $("#mainCat").val(currentCat);
    }
    $.ajax({
        url: APP_URL + url,
        method: 'GET',
        data: $("#hidden_values").serialize(),
        dataType: 'json',
        beforeSend: function () {
          $('#allProducts').html('<img src="' + APP_URL + '/front/image/loader.gif" style="margin: auto; width:10%;">');
        },
        success: function (json) {
          if (json['success']) {
            $('#allProducts').load(APP_URL + '/updateProducts');
          }
        },
    });
}

//----------  Input: Brands ---------
function brandsFilter(brand, url){
    var currentBrand = brand.value;
    if($(brand).prop("checked") == true) { 
        $("#brand").val(currentBrand);
        $("#brandValue").val(currentBrand);
    }
    console.log(currentBrand);
      $.ajax({
        url: APP_URL + url,
        method: 'GET',
        data: $("#hidden_values").serialize(),
        dataType: 'json',
        beforeSend: function () {
          $('#allProducts').html('<img src="' + APP_URL + '/front/image/loader.gif" style="margin: auto; width:10%;">');
        },
        success: function (json) {
          if (json['success']) {
            $('#allProducts').load(APP_URL + '/updateProducts');
          }
        },
    });
}
//----------  Input: Price ---------
function showProducts(minPrice, maxPrice) {
  $("#allProducts .product-layout").hide().filter(function() {
    var price = parseInt($(this).data("price"), 10);
    return price >= minPrice && price <= maxPrice;
  }).show();
}

function updateSlider() {
  var min_price = parseInt($("#min_price").val(), 10);
  var max_price = parseInt($("#max_price").val(), 10);
  var options = {
    range: true,
    min: min_price,
    max: max_price,
    values: [min_price, max_price],
    slide: function(event, ui) {
      var min = ui.values[0];
      var max = ui.values[1];
      $("#amount").val("$" + min + " - $" + max);
      $("#min_price").val(min);
      $("#max_price").val(max);
      showProducts(min, max);
    }
  }, min, max;
  $("#amount").val("$" + min_price + " - $" + max_price);
  $("#slider-range").slider(options);
}

$(function() {
  updateSlider();
});


/*
|--------------------------------------
|---------- Grids | List View ---------
|--------------------------------------
*/
$('#btn-list-view').on('click', function(){
  $('.imageDiv').addClass(' custmWidth');
});
$('#btn-grid-view').on('click', function(){
  $('.imageDiv').removeClass(' custmWidth');
});  
