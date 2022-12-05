<script>
	
//---------- All Pages | Select sizes when choose a color ---------
var PleaseSelect = "{{__('home.Please Select')}}";
function selectSize(id, code_class, color_class, size1_class, size2_class){

  var code =  $('#' + code_class +id).val();
  var color =  $('#' + color_class +id).val();
  var sizeOptions =  '';
  if(color != ''){
    $.ajax({
      url: APP_URL + '/getColors',
      method: "GET",
      dataType: 'json',
      data: { code: code , color: color },
      success: function (data) {
        if (data.success) {
          sizeOptions = '<option value=""> --- ' + PleaseSelect + ' --- </option>';
          for (var i=0; i<data.success.length; i++){
            var size = data.success[i].size;
            sizeOptions += '<option value='+size+'>'+size+'</option>';
          }
          $('#' + size1_class +id).html(sizeOptions);
        }
      }
    });
  }
  else {
    $('#' + size2_class).html('<option value=""> --- ' + PleaseSelect + '---</option>');
  }
};

//---------- Products Page | Select sizes when choose a color ---------
$('#color').on('change', function(){
  var color =  $(this).val();
  var code =  $("#pro_code").val();
  var sizeOptions =  '';

  if(color != ''){
    $.ajax({
      url: APP_URL + '/getColors',
      method: "GET",
      dataType: 'json',
      data: { code: code , color: color },
      success: function (data) {
        if (data.success) {
          sizeOptions = '<option value=""> --- ' + PleaseSelect + ' --- </option>';
          for (var i=0; i<data.success.length; i++){
            var color = data.success[i].size;
            sizeOptions += '<option value='+color+'>'+color+'</option>';
          }
          $('#size').html(sizeOptions);
        }
      }
    });
  }
  else {
    $('#size').html('<option value=""> --- ' + PleaseSelect + ' ---</option>');
  }
});
</script>