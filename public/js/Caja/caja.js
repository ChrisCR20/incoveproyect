function init(){
    $("#form_aperturac").on("submit",function(e)
    {
      guardar(e);
    });
  

  }
  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
  
  $.ajaxSetup({
  headers:{'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}
  });

  $(document).ready(function(){

    estado= $('#estado').val();
    console.log(estado);
    if(estado==1)
    {
      Swal.fire({
        type: 'info',
        title: 'No se puede aperturar caja',
        text: 'Debes hacer el cierre de caja primero!'
      }).then((result) => {
        location.href = "/";
      })
    }

  

});

  function guardar(e) {
      e.preventDefault();
  
      var formData = new FormData($("#form_aperturac")[0]);
      
        console.log(formData);

          Swal.fire({
            title: 'Aperturar caja?',
            text: "Una vez enviada la transaccion no se podra revertir",
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'No',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si'
          }).then((result) => {
            if (result.value) {
                Swal.fire(
                    'Enviada',
                    'La caja fue aperturada',
                    'success'
                  ).then((result) => {
                    if (result.value) {
                      $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                      url:"caja/ingreso",
                      type:"POST",
                      data: formData,
                      contentType:false,
                      processData:false,
                      success: function(e){
              
                       $('#form_aperturac')[0].reset();
                       location.href = "/";
                      }
                     
                    
                    });
                    }
                  })
                  
            }
          })

    }
    function editar(id_proveedor){
        var idproveedor = id_proveedor;
        $.ajax({url:'proveedor/obtener/'+idproveedor}).done(function(data){
            console.log(data);
            $('#nombreedit').val(data[0].nombreproveedor);
            $('#nitedit').val(data[0].nitproveedor);
            $('#direccionedit').val(data[0].direccionproveedor);
            $('#id_proveedor').val(data[0].id_proveedor);
            // $('#sede_id').val(data[0].id_sede);
    
           // console.log(data);
        });
        $('#modaleditarproveedor').modal('show');
    }
  
    function edicion(e){
        e.preventDefault();
  
        var formData = new FormData($("#proveedor_form_edit")[0]);
  
       // alert('vv');
        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
          url:"proveedor/edicion",
          type:"POST",
          data: formData,
          contentType:false,
          processData:false,
          success: function(e){
          // console.log(data);
           // alert('nada');
           $('#proveedor_form_edit')[0].reset();
           $('#tablaproveedor').DataTable().ajax.reload();
          //   $('#tick_titulo').val('');
            $('#modaleditarproveedor').modal('hide');
  
    
           toastr.warning('Proveedor editado exitosamente', 'Buen Trabajo',{timeOut: 3000})
          }
         
        
        });   
       // toastr.success('Empresa editada exitosamente', 'Buen Trabajo',{timeOut: 2000})
          }
    
      
    
  init();