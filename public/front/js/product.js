
var APP_URL = $("#url").val();

/*
|-------------------------------------------------------
|---------- Shopping Cart | Wishlist | Buy Now ---------
|-------------------------------------------------------
*/
// Add Item
function addToCart(event, product_id ) {
  event.preventDefault();
  $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
  $.ajax({
    url: APP_URL + '/cart/' + product_id,
    method: 'POST',
    data: $("#form-cart").serialize(), 
    dataType: 'json',
    beforeSend: function () {
      $('#button-cart').button('loading');
    },
    complete: function () {
      $('#button-cart').button('reset');
    },
    success: function (json) {
      $('.alert-dismissible, .text-danger').remove();
      $('.form-group').removeClass('has-error');
      // Errors
      if (json['error']) {
        $.each(json['error'], function(key, value){
          if(value){
            var element = $('#' + key );
            if (element.parent().hasClass('input-group')) {
              $('#QTYError').html('<div class="text-danger">' + value + '</div>');
            } 
            else {
              element.after('<div class="text-danger">' + value + '</div>');
            }
          }
        });

        // Highlight any found errors
        if (true) {};
        $('.text-danger').parent().addClass('has-error');
        try {
          $('html, body').animate({ scrollTop: $('.form-group.has-error').offset().top - 50 }, 'slow');
        } 
        catch (e) {}
      }
      // Success
      if (json['success']) {
        if ($('html').hasClass('popup-options')) {
          parent.$(".popup-options .popup-close").trigger('click');
        }
        
        parent.$('#content').parent().before(
          '<div class="text-center alert alert-success"><i class="fa fa-check-circle"></i> ' +
          json['success'] +
          ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>'
        );

        parent.$('#cart-total').html(json['total']);
        parent.$('#cart-items').html(json['items_count']);

        if (json['items_count']) 
          parent.$('#cart-items').removeClass('count-zero');

        $('#cart-content ul').load(APP_URL + '/cartContent');
        
        if (Journal['scrollToTop'])
          parent.$('html, body').animate({scrollTop: 0}, 'slow');
      }
    },
    error : function () {
      window.location.href = APP_URL + '/login';
      }
  });
}

// Buy Now
function buyNowAdd(product_id ) {
  $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
  $.ajax({
    url: APP_URL + '/cart/' + product_id,
    method: 'POST',
    data: $("#form-cart").serialize(), 
    dataType: 'json',
    beforeSend: function () {
      $('#buy_now_btn').button('loading');
    },
    complete: function () {
      $('#buy_now_btn').button('reset');
    },
    success: function (json) {
      $('.alert-dismissible, .text-danger').remove();
      $('.form-group').removeClass('has-error');
      // Errors
      if (json['error']) {
        $.each(json['error'], function(key, value){
          if(value){
            var element = $('#' + key );
            if (element.parent().hasClass('input-group')) {
              $('#QTYError').html('<div class="text-danger">' + value + '</div>');
            } 
            else {
              element.after('<div class="text-danger">' + value + '</div>');
            }
          }
        });

        // Highlight any found errors
        if (true) {};
        $('.text-danger').parent().addClass('has-error');
        try {
          $('html, body').animate({ scrollTop: $('.form-group.has-error').offset().top - 50 }, 'slow');
        } 
        catch (e) {}
      }
      // Success
      if (json['success']) {
        if ($('html').hasClass('popup-options')) {
          parent.$(".popup-options .popup-close").trigger('click');
        }
        
        parent.$('#cart-total').html(json['total']);
        parent.$('#cart-items').html(json['items_count']);
        if (json['items_count']) parent.$('#cart-items').removeClass('count-zero');
        $('#cart-content ul').load(APP_URL + '/cartContent');
        
        if (Journal['scrollToTop']) parent.$('html, body').animate({scrollTop: 0}, 'slow');

        window.location.href = APP_URL + '/checkout';
      }
    },
    error : function () {
      window.location.href = APP_URL + '/login';
      }
  });
}

// Wishlist
function wishlist (product_id) {
  $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
  $.ajax({
    url: APP_URL + '/wishlist/' + product_id,
    method: 'POST',
    data: {}, 
    dataType: 'json',
    beforeSend: function () {
      $('#add_to_wish_list').button('loading');
    },
    complete: function () {
      $('#add_to_wish_list').button('reset');
    },
    success: function (json) {
      if (json['success']) {
        if ($('html').hasClass('popup-options')) {
          parent.$(".popup-options .popup-close").trigger('click');
        }
        parent.$('#content').parent().before(
          '<div class="text-center alert alert-success"><i class="fa fa-check-circle"></i> ' +
          json['success'] +
          ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>'
        );
        if (Journal['scrollToTop'])
          parent.$('html, body').animate({scrollTop: 0}, 'slow');
      }
    },
    error : function () {
      window.location.href = APP_URL + '/login';
    }
  });
}

/*
|---------------------------
|---------- Review ---------
|---------------------------
*/
// Write a review
$(function () {
  $('#review').delegate('.pagination a', 'click', function (e) {
    e.preventDefault();
    $('#review').fadeOut('slow');
    $('#review').load(this.href);
    $('#review').fadeIn('slow');
  });
});

function review(product_id) {
  $.ajaxSetup({
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
  });
  $.ajax({
    url: APP_URL + '/review/' + product_id,
    method: "POST",
    data: $("#form-review").serialize(),
    dataType: 'json',
    beforeSend: function () {
      $('#button-review').button('loading');
    },
    complete: function () {
      $('#button-review').button('reset');
    },
    success: function (data) {
      $('.alert-dismissible').remove();
      if (data.errors) {
        var html = '';
        for (var i=0; i<data.errors.length; i++) {
          html += '<i class="fa fa-exclamation-circle"></i> ';
          html += data.errors[i];
          html += '<br>';
        };
        $('#review').after(
          '<div class="alert alert-danger alert-dismissible">' + html + '</div>');
      }
      if (data.success) {
        $('#review').after(
          '<div class="alert alert-success alert-dismissible"><i class="fa fa-check-circle"></i> ' +
          data.success + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
          $('textarea[name=\'text\']').val('');
           $("#form-review")[0].reset(),
          $('input[name=\'rating\']:checked').prop('checked', false);
      }
    },
    error : function () {
      // User Not Logged In
      // 401 Unauthorized Response
      window.location.href = APP_URL + '/login';
    }
  });
}
// Open Review Tab
$(document).ready(function () {
  $('.review-links a').on('click', function () {
    var $review = $('#review');
    if ($review.length) {
      $('a[href="#' + $review.closest('.module-item').attr('id') + '"]').trigger('click');
      $('a[href="#' + $review.closest('.tab-pane').attr('id') + '"]').trigger('click');
      $('a[href="#' + $review.closest('.panel-collapse').attr('id') + '"]').trigger('click');
      $([document.documentElement, document.body]).animate({
        scrollTop: $review.offset().top - 100
      }, 1000);
    }
  });
});


/*
|-------------------------
|---------- Zoom ---------
|-------------------------
*/
// Get src and img when switch image
$('.clickedImage').on('click', function(){
  var src = this.src;
  var images = document.getElementsByClassName("MAINIMAGE");
  var imgOpened = $('#mainImag');
  $.each(images, function(item, img){
    if(img.src == src){
      $('img#mainImag').removeAttr('id');
      $(img).attr('id', 'mainImag');
    }
  });
});

function imageZoom(imgID, resultID) {
  var img, lens, result, cx, cy;
  img = document.getElementById(imgID);
  result = document.getElementById(resultID);
  // console.log(result);
  result.style.display = "inline-block";

  /* Create lens: */
  lens = document.createElement("DIV");
  lens.setAttribute("class", "img-zoom-lens");
  /* Insert lens: */
  img.parentElement.insertBefore(lens, img);
  /* Calculate the ratio between result DIV and lens: */
  cx = result.offsetWidth / lens.offsetWidth;
  cy = result.offsetHeight / lens.offsetHeight;
  /* Set background properties for the result DIV */
  result.style.backgroundImage = "url('" + img.src + "')";
  result.style.backgroundSize = (img.width * cx) + "px " + (img.height * cy) + "px";
  /* Execute a function when someone moves the cursor over the image, or the lens: */
  lens.addEventListener("mousemove", moveLens);
  img.addEventListener("mousemove", moveLens);
  /* And also for touch screens: */
  lens.addEventListener("touchmove", moveLens);
  img.addEventListener("touchmove", moveLens);
  function moveLens(e) {
    var pos, x, y;
    /* Prevent any other actions that may occur when moving over the image */
    e.preventDefault();
    /* Get the cursor's x and y positions: */
    pos = getCursorPos(e);
    /* Calculate the position of the lens: */
    x = pos.x - (lens.offsetWidth / 2);
    y = pos.y - (lens.offsetHeight / 2);
    /* Prevent the lens from being positioned outside the image: */
    if (x > img.width - lens.offsetWidth) {x = img.width - lens.offsetWidth;}
    if (x < 0) {x = 0;}
    if (y > img.height - lens.offsetHeight) {y = img.height - lens.offsetHeight;}
    if (y < 0) {y = 0;}
    /* Set the position of the lens: */
    lens.style.left = x + "px";
    lens.style.top = y + "px";
    /* Display what the lens "sees": */
    result.style.backgroundPosition = "-" + (x * cx) + "px -" + (y * cy) + "px";
  }
  function getCursorPos(e) {
    var a, x = 0, y = 0;
    e = e || window.event;
    /* Get the x and y positions of the image: */
    a = img.getBoundingClientRect();
    /* Calculate the cursor's x and y coordinates, relative to the image: */
    x = e.pageX - a.left;
    y = e.pageY - a.top;
    /* Consider any page scrolling: */
    x = x - window.pageXOffset;
    y = y - window.pageYOffset;
    return {x : x, y : y};
  }
} 

function zoomOut(){
  var myresult = document.getElementById("myresult");
  myresult.style.display = "none";
  var lens = document.getElementsByClassName("img-zoom-lens");
  $.each(lens, function(item, len){
    len.style.display = "none";
  });
}

$('.DivImage').hover( function(){
  imageZoom("mainImag", "myresult");
});

$('.DivImage').mouseleave(function(){
  zoomOut();
});
