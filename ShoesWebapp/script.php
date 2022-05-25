<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
  $('#provinces').change(function() {
    var id_province = $(this).val();

      $.ajax({
      type: "POST",
      url: "ajax_db.php",
      data: {id:id_province,function:'provinces'},
      success: function(data){
          $('#amphures').html(data); 
          $('#districts').html(' '); 
          $('#districts').val(' ');  
          $('#zip_code').val(' '); 
      }
    });
  });

  $('#amphures').change(function() {
    var id_amphures = $(this).val();

      $.ajax({
      type: "POST",
      url: "ajax_db.php",
      data: {id:id_amphures,function:'amphures'},
      success: function(data){
          $('#districts').html(data);  
      }
    });
  });

   $('#districts').change(function() {
    var id_districts= $(this).val();

      $.ajax({
      type: "POST",
      url: "ajax_db.php",
      data: {id:id_districts,function:'districts'},
      success: function(data){
          $('#zip_code').val(data)
      }
    });
  
  });
</script>