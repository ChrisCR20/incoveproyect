
@foreach($producto as $producto)
<div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
    <div class="card bg-light d-flex flex-fill">
      <div class="card-header text-muted border-bottom-0">
       
      </div>
      <div class="card-body pt-0">
        <div class="row">
          <div class="col-7">
            <h2 class="lead"><b> {{ $producto->nombreproducto }}</b></h2>
            <p class="text-muted text-sm"><b>Stock: </b> 1 </p>
            <ul class="ml-4 mb-0 fa-ul text-muted">
              <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Embutidos</li>
              <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span>112021</li>
            </ul>
          </div>
          <div class="col-5 text-center">
            <img src="{{asset('images/producto.png')}}" alt="user-avatar" class="img-circle img-fluid">
          </div>
        </div>
      </div>
      <div class="card-footer">
        <div class="text-right">
          <a href="#" class="btn btn-sm btn-primary" onClick="agregarest('{{ $producto->id_producto }}','{{ $producto->nombreproducto }}');" >
            <i class="fas fa-plus"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
  @endforeach