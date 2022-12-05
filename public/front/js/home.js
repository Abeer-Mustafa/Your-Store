var APP_URL = $("#url").val();

// *******************************
// ********** Home Page **********
// *******************************
// Add to Wish list
$(document).on('click', '.add_to_wish_list', function () {
  var pro_id = $(this).attr("data-product-id");
  $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
  $.ajax({
    url: APP_URL + '/wishlist/' + pro_id,
    method: 'POST',
    data: {}, 
    dataType: 'json',
    success: function (json) {
      $('#contentModalWishlist').html('<i class="fa fa-check-circle" style="margin-right: 3px;"></i>' +'  ' + json['success']);
      $('#modalWishlist').modal('show');
    },
    error : function () {
      window.location.href = APP_URL + '/login';
    }
  });
});
// Responsive: what they say
function changeStyle() {
  var width = $(window).width();
  if(width>1024) $(".grid-col-bottom-4-2").css({"margin-left": "25%"});
  else $(".grid-col-bottom-4-2").css({"margin-left": "0"});
}
window.addEventListener('resize', changeStyle);
changeStyle();

// ***********************************
// ********** Wishlist Page **********
// ***********************************
function removItemfromWish(item_id){
  $.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} });
  $.ajax({
    url: APP_URL + '/wishlist',
    method: 'POST',
    data: {item_id: item_id},
    beforeSend: function () {
      $('#remove_item_' + item_id).button('loading');
    },
    complete: function () {
      $('#remove_item_' + item_id).button('reset');
    },
    dataType: 'json',
    success: function (json) {
      $('#content').before(
        '<div class="text-center alert alert-success"><i class="fa fa-check-circle"></i> ' +
        json['success'] +
        ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>'
      );
      $('#content').load(APP_URL + '/wishUpdate');
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
  return false;
}

// *************************************
// ********** Contact Us Page **********
// *************************************
$('#submit_contact').on('click', function(){
  $.ajax({
    url: APP_URL + '/contact',
    method: 'POST',
    data: $("#contact_form").serialize(),
    dataType: 'json',
    beforeSend: function () {
      $('#submit_contact').button('loading');
    },
    complete: function () {
      $('#submit_contact').button('reset');
    },
    success: function (json) {
      $('.alert-dismissible, .text-danger').remove();
      $('.form-group').removeClass('has-error');
      // Errors
      if (json.errors) {
        var html = '<ul>';
        for (var i=0; i<json.errors.length; i++) {
          html += '<i class="fa fa-exclamation-circle"></i> ';
          html += json.errors[i];
          html += '<br>';
        };
        html += '</ul>';

        $('#contentModalContact_error').html(html);
        $('#modalContact_error').modal('show');
      }
      if (json['success']) {
        $('#contact_form')[0].reset();
        $('#contentModalContact').html('<i class="fa fa-check-circle" style="margin-right: 3px;"></i>' +'  ' + json['success']);
        $('#modalContact').modal('show');
      }
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
  return false;
});

// *******************************
// ********** Cart Page **********
// *******************************
function removItemCart(item_id){
  $.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} });
  $.ajax({
    url: APP_URL + '/cartDelete',
    method: 'POST',
    data: {item_id: item_id},
    beforeSend: function () {
      $('#remove_item_' + item_id).button('loading');
    },
    complete: function () {
      $('#remove_item_' + item_id).button('reset');
    },
    dataType: 'json',
    success: function (json) {
      $('#content').before(
        '<div class="text-center alert alert-success"><i class="fa fa-check-circle"></i> ' +
        json['success'] +
        ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>'
      );
      $('#content').load(APP_URL + '/cartUpdate');
      $("#cart-items").html(json['count']);
      if(json['count'] == 0){
        $("#cart-items").addClass('count-zero');
        $("#cart-content").html('<ul><li><p class="text-center cart-empty">Your shopping cart is empty!</p></li> </ul>');
      }
      else $('#cart-content ul').load(APP_URL + '/cartContent');
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
  return false;
}

function updateItemCart(item_id){
  $.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} });
  $.ajax({
    url: APP_URL + '/cartModify',
    method: 'POST',
    data: {item_id: item_id, quantity: $('#quantity_' + item_id).val()},
    beforeSend: function () {
      $('#update_item_' + item_id).button('loading');
    },
    complete: function () {
      $('#update_item_' + item_id).button('reset');
    },
    dataType: 'json',
    success: function (json) {
      if(json['success']){
        $('#content').before(
          '<div class="text-center alert alert-success"><i class="fa fa-check-circle"></i> ' +
          json['success'] +
          ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>'
        );
        $('#content').load(APP_URL + '/cartUpdate');
        $("#cart-items").html(json['count']);
        if(json['count'] == 0){
          $("#cart-items").addClass('count-zero');
          $("#cart-content").html('<ul><li><p class="text-center cart-empty">Your shopping cart is empty!</p></li> </ul>');
        }
        else $('#cart-content ul').load(APP_URL + '/cartContent');
      }
      else{
        $('#content').before(
          '<div class="text-center alert alert-danger"><i class="fa fa-check-circle"></i> ' +
          json['error'] +
          ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>'
        );
      }
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
  return false;
}
