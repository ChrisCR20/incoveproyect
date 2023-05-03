
function init(){
// dispara la funcion para guardar el formulario completo
    $("#venta_form").on("submit",function(e)
    {
      guardar(e);
    });
// dispara la funcion para crear cliente
    $("#cliente_form").on("submit",function(e)
    {
      guardarcl(e);
    });
    $.ajaxSetup({
        headers:{'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}
    });
    $('.select2').select2()
  }

$(document).ready(function(){

    $('#modalnuevacategoria').modal('show');

  

});
// inicia la funcion guardar cliente  
function guardarcl(e) {
    e.preventDefault();
        idcliente= $('#id_cliente').val();
        nitmodal= $('#identificacion').val();
        nombremodal= $('#nombrecliente').val();
            if(idcliente=="")
            {
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
                        success: function(e)
                        {
                            toastr.success('Cliente Agregado', 'Buen Trabajo',{timeOut: 3000})
                            console.log(e.id_cliente);
                            $('#nitventa').val(nitmodal);
                            $('#nombreventa').val(nombremodal);
                            $('#id_cliente').val(e.id_cliente);
                            $('#cliente_form')[0].reset();
                            $('#modalnuevacategoria').modal('hide');  
                        }
                });
            }
            else
            {
                            $('#nitventa').val(nitmodal);
                            $('#nombreventa').val(nombremodal);
                            $('#id_cliente').val(idcliente);
                            $('#modalnuevacategoria').modal('hide');
            }
}
//finaliza funcion guardar cliente

//inicia funcion guardar venta
function guardar(e) {

    e.preventDefault();  
    var formData = new FormData(document.getElementById("venta_form"));
    console.log(formData);
    var itemsDataPA=[];
    var tablaPA=$("#tblacademico tr");  
      tablaPA.each(function(){
            var titulo = $(this).find('td').eq(1).html();
            var establecimiento = $(this).find('td').eq(2).html();
            var idtpgr = $(this).closest('tr').find('input[id="tpgrado"]').val();
            valor = new Array(titulo,establecimiento,idtpgr);
            itemsDataPA.push(valor);
        });

        formData.append('fechafactv', $('#fechafactv').val());
        formData.append('serie', $('#serie').val());
        formData.append('numerodocto', $('#numerodocto').val());
        formData.append('id_proveedor', $('#id_proveedor').val());
        formData.append('id_tipopago', $('#id_tipopago').val());
        formData.append('id_cliente', $('#id_cliente').val());

        if(itemsDataPA.length>1)
        {

            




            Swal.fire({
                title: 'Confirmar Venta',
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
                        'La venta fue enviada',
                        'success'
                      ).then((result) => {
                        if (result.value) {
                             $.ajax({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    url:"ingreso",
                                    type:"POST",
                                    data: formData,
                                    contentType:false,
                                    processData:false,
                                    xhrFields: {
                                        responseType: 'blob'
                                    },
                                    success: function(e){
                                        var blob = new Blob([e]);
                                        var link = document.createElement('a');
                                        link.href = window.URL.createObjectURL(blob);
                                        link.download = "Factura.pdf";
                                        link.click();
                                    $('#venta_form')[0].reset();
                                    toastr.success('Factura registrada correctamente', 'Buen Trabajo',{timeOut: 5000})
                                    window.location.reload();
                                    }
                                });
                            $('#venta_form')[0].reset();
                            $('#cliente_form')[0].reset();
                           // window.location.reload();
                        }
                      })
                      
                }
              })

       
        }
        else
        {
            toastr.warning('Debe agregar al menos un item a la factura', 'Atención',{timeOut: 2500})
        }
}
//finaliza la funcion guardar venta

//inicia funcion para agregar items a la tabla dinamica

var contacade=0;// contador para las filas de la tabla
var items2=[]; // arreglo de id's y productos que se van agregando a la tabla

function agregarest()
{
    var sumsubtotales=0; // variable para le subtotal general
    var edx=0; //variable que suma los subtotales por cada producto
    var cantid2=0;


    nminstituto=$("#cantidad").val();
    tipgradoval=$("#id_producto").val();
    tipgradotxt=$("#id_producto option:selected").text();
    nit= $('#identificacion').val();


    if ( (nminstituto!="") ) // verifica si los campos de cantidad estan vacios
    {
        $.ajax({url:'/venta/obtener/p_unitario/'+tipgradoval}).done(function(data) 
        {

            nminstituto=parseFloat(nminstituto);
                if(data["cantidad"]<nminstituto)
                    {
                        Swal.fire(
                            'Pocas Existencias',
                            'Tiene '+data["cantidad"]+' unidades disponibles en stock',
                            'warning'
                            )
                            limpiarAca();
                    }
                 else
                 {
                    items2.push({"id":tipgradoval,"cantidad":nminstituto,"idfila":contacade,"subtotal":(nminstituto*data["precio_venta"])});
                    console.log(items2);
                    items2.forEach(element => {
                       
                        if(element['id']==tipgradoval)
                        {
                            cantid2=cantid2+parseFloat(element['cantidad'])
                            console.log(cantid2)
                            if(cantid2>data["cantidad"])
                            {
                                Swal.fire(
                                    'Pocas Existencias',
                                    'Tiene '+data["cantidad"]+' unidades disponibles en stock',
                                    'warning'
                                    )
                                    limpiarAca();
                                    var elo=items2.indexOf(element);
                                    items2[elo]['cantidad']=0;
                                    items2[elo]['subtotal']=0;
                            }
                            else{
                                console.log("entro");
                                $("#filaAca" + element['idfila']).remove();
                                edx=edx+ parseFloat(element['cantidad']);
                                filaAca='<tr class="selected" id="filaAca'+contacade+'"> <td><a id="btn1" style="color:red" onclick="eliminarR('+contacade+','+edx*data["precio_venta"]+','+tipgradoval+');"><i class="far fa-trash-alt" aria-hidden="true"></a></td><td><input type="hidden" name="nminstituto[]" value="'+edx+'">'+edx+'</td> <td><input type="hidden" id="tpgrado" name="tpgrado[]" value="'+tipgradoval+'">'+tipgradotxt+'</td><td><input type="hidden" id="nmtitulo" name="nmtitulo[]" value="'+edx*data["precio_venta"]+'">'+"Q "+edx*data["precio_venta"]+'</td>  </tr>';
                            
                            }
                        }
                        sumsubtotales=sumsubtotales+parseFloat(element['subtotal'])
                                    });

                                    contacade++;
                                    limpiarAca();
                                    console.log(filaAca);
                                    $('#tblacademico').append(filaAca);
                                    
                                $('#sumasub').html(sumsubtotales);  
                }
        });
    }
    else
    {
        toastr.warning('Campo "Cantidad" es requerido', 'Atención',{timeOut: 2500})
    }   
}
//finliza funcion para agregar items

//quitar items
function eliminarR(index,subtotal,idel)
{  
   //console.log('verga');
    items2.forEach(element => {
        var elo=items2.indexOf(element);
        if(element['id']==idel)
        {
           //  items2.splice(elo,1);
           delete(items2[elo]);
        }
        
    });

   console.log(items2);
   subtotalgeneral=parseFloat($('#sumasub').html());
   subtotalgeneral=subtotalgeneral-subtotal;
    console.log(subtotalgeneral);
    console.log(subtotal);
   
        $("#filaAca" + index).remove();
        $('#sumasub').html(subtotalgeneral);
        if(subtotalgeneral==0)
        {
            sumsubtotales=0;
        }
        else{
            sumsubtotales=subtotalgeneral;
        }
       // tblacademico.reload();
}

//limpiar inputs
function limpiarAca()
{
    $("#cantidad").val("");
    $("#subtotal").val("");
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

