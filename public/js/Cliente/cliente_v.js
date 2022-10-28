
  $(function () {
      //Initialize Select2 Elements   
      $('.select2').select2();
  });
  
  
  $(document).ready(function(){
    $('#modalnuevacategoria').modal('show');

  });
  

      function enviardatoscl(e)
    {
      nitmodal= $('#identificacion').val();
      nombremodal= $('#nombrecliente').val();
      if(nitmodal=="")
      {
console.log("entro");
      e.preventDefault();
  
      var formData = new FormData($("#cliente_form")[0]);
      
      $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
        url:"as",
        type:"GET",
        data: formData,
        contentType:false,
        processData:false,
        success: function(e){
        // console.log(data);
         // alert('nada');
         $('#venta_form')[0].reset();
        //  $('#tablasucursal').DataTable().ajax.reload();
        //   $('#tick_titulo').val('');
        $('#nitventa').val(nitmodal);
        $('#nombreventa').val(nombremodal);
          $('#modalnuevacategoria').modal('hide');
  
        }
       
      
      });
      
    
      }
      else
      {    
        e.preventDefault();
        $('#nitventa').val(nitmodal);
        $('#nombreventa').val(nombremodal);
  
      $('#modalnuevacategoria').modal('hide');
  
      }
  
  
    }