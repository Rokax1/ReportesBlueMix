@extends("theme.$theme.layout")
@section('titulo')
  Productos Negativos
@endsection
@section('styles')

<link rel="stylesheet" href="{{asset("assets/$theme/plugins/datatables-bs4/css/dataTables.bootstrap4.css")}}">

@endsection

@section('contenido')

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
            <h3 class="display-3">Productos Negativos</h3>
        </div>
        <div class="col md-6">
        {{-- algo al lado del titulo --}}
            
        </div>

      </div>
        <div class="row">
          <div class="col-md-12">

            <div class="form-group">
              <form action="{{route('filtrar')}}" role="search" method="POST" id="form">
                  @csrf
                          <div class="input-group">
                              <input id="xd" type="text" name="searchText" class="form-control" placeholder="Buscar...">
                              <span class="input-group-btn">
                                 {{-- <button id="boton" type="submit" class="btn btn-primary">Buscar </button> --}}
                              </span>
                          </div>
                       </form>
                   </div>
            
                   <div class="productosNegativos">
                              <table id="productos" class="table table-bordered table-hover dataTable">
                                  <thead>
                                    <tr>
                                      <th scope="col">Nombre</th>
                                      <th scope="col">Ubicacion</th>
                                      <th scope="col">Codigo</th>
                                      <th scope="col">Stock Bodega</th>
                                      <th scope="col">Stock Sala</th>
                                    </tr>
                                  </thead>
                                  <tbody id="res">
                                  @foreach($productos as $item)
                                    <tr>
                                      <th >{{$item->nombre}}</th>
                                      <td>{{$item->ubicacion}}</td>
                                      <td>{{$item->codigo}}</td>
                                      <td>{{$item->bodega_stock}}</td>
                                      <td>{{$item->sala_stock}}</td>
                                    </tr>
                                    @endforeach
                                  </tbody>
                                </table>
                                {{$productos->links()}}
                              </div>

          </div> 
        </div>
        <div class="row">
          <div class="col-md-6">
              <form action="{{route('excel')}}" method="post">
                  @csrf
                  <input id="valorBuscar" type="hidden" name="search">
                  <button type="submit" class="btn btn-success" id="excel" >Excel </button>
                </form>
          </div>
          <div class="col-md-6">
             
          </div>

        </div>
       
    
</div>

@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

<script src="{{asset("assets/$theme/plugins/datatables/jquery.dataTables.js")}}"></script>
<script src="{{asset("assets/$theme/plugins/datatables-bs4/js/dataTables.bootstrap4.js")}}"></script>



<script src="{{asset("js/ajaxProductosNegativos.js")}}"></script>

    
@endsection