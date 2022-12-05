
var APP_URL = $("#url").val();
var jsonFiel = $("#jsonFiel").val();


// *************************** 
// ***** Change Currency ***** 
// *************************** 
$(document).ready(function(){ 
    $('#ul_currency li').click(function() {
      $('#cur_input').val($(this).attr("dataCode"));
      $('#form_currency').submit();
    });
});

// ************************ 
// ***** Search Input ***** 
// ************************ 
// suggestions when writing
function startSearch(){
	// Declare variables
	var input, filter, allresults, results, item, i, txtValue;
	input = document.getElementById('myInputSearch');
	filter = input.value.toUpperCase();
	allresults = document.getElementById("myResults");
	results = allresults.getElementsByTagName('div');

	 // Loop through all list items, and hide those who don't match the search query
	for (i = 0; i < results.length; i++) {
	    item = results[i].getElementsByClassName("product-name")[0];
	    txtValue = item.textContent || item.innerText;
	    if (txtValue.toUpperCase().indexOf(filter) > -1 && filter) results[i].style.display = "";
	    else results[i].style.display = "none";
	}
}

// Click on button search
function goSearch(){
    var search = $('#search').find('input[name=\'searchInput\']');
    var url = APP_URL + '/search';
    var value = search.val();
    if (value) {
        url += '/' + encodeURIComponent(value);
        window.location.href = url;
    }
}

// trigger button enter
$(window).on('load', function () {
    var search = $('#search').find('input[name=\'searchInput\']');
    search.on("keydown", function(event) {
        if (event.keyCode === 13) {
            $("#buttonSearch").trigger('click');
        }
    });
});

//---------- Remove Item from cart (header) ---------
function removeItem (item_id) {
  $.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} });
  $.ajax({
    url: APP_URL + '/removeItem/'+ item_id,
    type: 'post',
    data: 'item_id=' + item_id,
    dataType: 'json',
    success: function(json) {
      setTimeout(function () {
        $('#cart > button').html('<span id="cart-total"><i class="fa fa-shopping-cart"></i> ' + json['total'] + '</span>');
      }, 100);
      $("#cart-items").html(json['count']);
      if(json['count'] == 0){
        $("#cart-items").addClass('count-zero');
        $("#cart-content").html('<ul><li><p class="text-center cart-empty">Your shopping cart is empty!</p></li> </ul>');
      }
      else
        $('#cart-content ul').load(APP_URL + '/cartContent');
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
}