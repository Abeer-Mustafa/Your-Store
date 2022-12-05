
var APP_URL = $("#url").val();

/*
|-------------------------------------------------------
|---------- Shopping Cart | Wishlist | Buy Now ---------
|-------------------------------------------------------
*/

//---------- Add Item ---------
function addToCart(event, product_id, form_class, button_class, input_class, qty_class, parent_class, options_class, qtyinput_class) {
  event.preventDefault();
  $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
  $.ajax({
    url: APP_URL + '/cartHome/' + product_id,
    method: 'POST',
    data: $("#" + form_class + product_id).serialize(), 
    dataType: 'json',
    beforeSend: function () {
      $('#' + button_class + product_id).button('loading');
    },
    complete: function () {
      $('#' + button_class + product_id).button('reset');
    },
    success: function (json) {
      $('.alert-dismissible, .text-danger').remove();
      $('.form-group').removeClass('has-error');
      // Errors
      if (json['error']) {
        $.each(json['error'], function(key, value){
          if(value){
            var element = $('#' + input_class + key + '_' + product_id );
            if (element.parent().hasClass('input-group')) {
              $('#' + qty_class + product_id).html('<div class="text-danger">' + value + '</div>');
            } 
            else {
              element.after('<div class="text-danger">' + value + '</div>');
            }
          }
        });
        $('.text-danger').parent().addClass('has-error');
      }
      // Success
      if (json['success']) {
        if ($('html').hasClass('popup-options')) {
          parent.$(".popup-options .popup-close").trigger('click');
        }
        
        parent.$('#' + parent_class + product_id).before(
          '<div class="text-center alert alert-success" style="margin-bottom: 2%;"><i class="fa fa-check-circle"></i> ' +
          json['success'] +
          ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>'
        );

        $('#cart-total').html(json['total']);
        $('#cart-items').html(json['items_count']);

        if (json['items_count']) $('#cart-items').removeClass('count-zero');

        $('#cart-content ul').load(APP_URL + '/cartContent');
      }
     
    },
    error : function () {
      window.location.href = APP_URL + '/login';
    }
  });

  // Reset Form and Clear error, success messages
  $('#' + options_class + product_id).on('hidden.bs.modal', function (e) {
    $(this).find("select").val('').end();
    $('#' + qtyinput_class + product_id).val(1);
    $('.alert-dismissible, .text-danger, .alert-success').remove();
    $('.form-group').removeClass('has-error');
  });
};

//---------- Buy Now ---------
function buyNowAdd(event, product_id, form_class, button_class, input_class, qty_class, options_class, qtyinput_class) {
  event.preventDefault();
  $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
  $.ajax({
    url: APP_URL + '/cartHome/' + product_id,
    method: 'POST',
    data: $("#" + form_class + product_id).serialize(), 
    dataType: 'json',
    beforeSend: function () {
      $('#' + button_class + product_id).button('loading');
    },
    complete: function () {
      $('#' + button_class + product_id).button('reset');
    },
    success: function (json) {
      $('.alert-dismissible, .text-danger').remove();
      $('.form-group').removeClass('has-error');
      // Errors
      if (json['error']) {
        $.each(json['error'], function(key, value){
          if(value){
            var element = $('#' + input_class + key + '_' + product_id );
            if (element.parent().hasClass('input-group')) {
              $('#' + qty_class + product_id).html('<div class="text-danger">' + value + '</div>');
            } 
            else {
              element.after('<div class="text-danger">' + value + '</div>');
            }
          }
        });
        $('.text-danger').parent().addClass('has-error');
      }
      // Success
      if (json['success']) {
        if ($('html').hasClass('popup-options')) {
          parent.$(".popup-options .popup-close").trigger('click');
        }

        $('#cart-total').html(json['total']);
        $('#cart-items').html(json['items_count']);
        if (json['items_count']) $('#cart-items').removeClass('count-zero');
        $('#cart-content ul').load(APP_URL + '/cartContent');

        window.location.href = APP_URL + '/checkout';
      }
     
    },
    error : function () {
      window.location.href = APP_URL + '/login';
      }
  });

  // Reset Form and Clear error, success messages
  $('#' + options_class + product_id).on('hidden.bs.modal', function (e) {
    $(this).find("select").val('').end();
    $('#' + qtyinput_class + product_id).val("1");
    $('.alert-dismissible, .text-danger, .alert-success').remove();
    $('.form-group').removeClass('has-error');
  });
};

//---------- Add to Wish list ---------
function wishlist(pro_id) {
  $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
  $.ajax({
    url: APP_URL + '/wishlist/' + pro_id,
    method: 'POST',
    data: {}, 
    dataType: 'json',
    success: function (json) {
      parent.$('#content').parent().parent().before(
        '<div class="text-center alert alert-success"><i class="fa fa-check-circle"></i> ' +
        json['success'] +
        ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>'
      );
      parent.$('html, body').animate({scrollTop: 0}, 'slow');
    },
    error : function () {
      window.location.href = APP_URL + '/login';
    }
  });
}
