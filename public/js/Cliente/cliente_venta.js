

function init(){
    $("#cliente_form").on("submit",function(e)
    {
      guardar(e);
    });

    $('.select2').select2()
  }

  $(document).ready(function(){
    $('#modalnuevacategoria').modal('show');

    $('#btnadditem').click(function() {
      agregarest();
  });
  $("#tpmodalidad").change(event => {
      var valormodalidad = $("#tpmodalidad").val();
      var textomodalidad = $("#tpmodalidad option:selected").text();
      if( textomodalidad == "Residencial")
      {
          $("#divoculto").show();
      }
      else{
          $("#divoculto").hide();
      }
  });

  });
  

  
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
  
        $.ajaxSetup({
      headers:{'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}
  });
  
  
  

  
  function guardar(e) {
    e.preventDefault();
    idcliente= $('#id_cliente').val();
    nitmodal= $('#identificacion').val();
    nombremodal= $('#nombrecliente').val();
    if(idcliente=="")
    {
console.log("entro");

     
  
      var formData = new FormData($("#cliente_form")[0]);
      
      $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
        url:"crearcliente",
        type:"POST",
        data: formData,
        contentType:false,
        processData:false,
        success: function(e){
        // console.log(data);
         // alert('nada');
         $('#nitventa').val(nitmodal);
         $('#nombreventa').val(nombremodal);
         $('#cliente_form')[0].reset();
            
          $('#modalnuevacategoria').modal('hide');
          
  
      
          // Toast.fire({
          //     type: 'success',
          //     title: 'La acción fue completada exitosamente'
              
          //   })
          //   $(document).Toasts('create', {
          //     class: 'bg-success',
          //     body: 'Accion ejecutada con éxito',
          //      autohide: true,
          //         delay: 2000,
          //   })
  
          toastr.success('Categoría agregada exitosamente', 'Buen Trabajo',{timeOut: 2000})
        }
       
      
      });
    }
    else
    {
       // alert("nada");
       $('#nitventa').val(nitmodal);
       $('#nombreventa').val(nombremodal);
 
     $('#modalnuevacategoria').modal('hide');
    }
      
    }

    var contacade=0;
function agregarest()
{
  nmtitulo=$("#subtotal").val();
  nminstituto=$("#cantidad").val();
  tipgradoval=$("#id_producto").val();
  tipgradotxt=$("#id_producto option:selected").text();

  

    nit= $('#identificacion').val();

   // console.log(subtotal);

  if ((nmtitulo!="") && (nminstituto!="") )
  {
    $.ajax({url:'/venta/obtener/p_unitario/'+tipgradoval}).done(function(data){
      nmtitulo = parseFloat(nmtitulo);
  nminstituto=parseFloat(nminstituto);
  subtotal =nminstituto * data["precio_venta"];
      //console.log(data);
      // $('#nombrecliente').val(data["nombrecliente"]);
      // $('#id_cliente').val(data["id_cliente"]);
      var filaAca='<tr class="selected" id="filaAca'+contacade+'"> <td><button type="button"   class="btn btn-danger" onclick="eliminarR('+contacade+');"><i class="fa fa-trash" aria-hidden="true"></i></button></td><td><input type="hidden" name="nminstituto[]" value="'+nminstituto+'">'+nminstituto+'</td> <td><input type="hidden" id="tpgrado" name="tpgrado[]" value="'+tipgradoval+'">'+tipgradotxt+'</td><td><input type="hidden" id="nmtitulo"  name="nmtitulo[]" value="'+subtotal+'">'+subtotal+'</td>  </tr>';
      contacade++;
      limpiarAca();
      $('#tblacademico').append(filaAca);

      
    });

  //   var itemsDataPA=[];
  //   var tablaPA=$("#tblacademico tr");

    
  //   tablaPA.each(function(){
  //     var titulo = $(this).find('td').eq(1).html();
  //     var establecimiento = $(this).find('input[id="nmtitulo"]').val();
  //     var idtpgr = $(this).closest('tr').find('input[id="tpgrado"]').val();
  //     valor = new Array(establecimiento);
  //     itemsDataPA.push(parseFloat(establecimiento));

      
  // });


  // console.log(itemsDataPA);
  // let total=0
  // itemsDataPA.forEach(function(a){total += a;});
  // console.log(total);
  // console.log(itemsDataPA);


  }
  else
  {
    toastr.warning('Los campos "Cantidad y Subtotal" son requeridos', 'Atención',{timeOut: 2500})
     // alert('Todos los campos son obligatorios')
  }   
}
function limpiarAca()
{
  $("#cantidad").val("");
  $("#subtotal").val("");
}

function eliminarR(index)
{

      $("#filaAca" + index).remove();

}
function validacionkeys(e){
  tecla = e.keyCode || e.which;
  tecla_final = String.fromCharCode(tecla);
  //Tecla de retroceso para borrar, siempre la permite
  if (tecla==8 || tecla==37 || tecla==39 ||tecla==46 ||tecla==9)
  {
      return true;
  }

  if (tecla==13) buscarclientes();

  // Patron de entrada, en este caso solo acepta numeros
  patron =/[0-9]/;
  //patron =/^\d{9}$/;
  return patron.test(tecla_final);
}
      
    
  init();