@extends("theme.$theme.layout")
@section('titulo')
 Cuadro De Mando 
@endsection
@section('styles')

<link rel="stylesheet" href="{{asset("assets/$theme/plugins/datatables-bs4/css/dataTables.bootstrap4.css")}}">

@endsection

@section('contenido')
<div class="container-fluid">
    <h3 class="display-3">Productos Negativos</h3>
    <div class="row">
            <div class="col-md-6">
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
                    <tbody>
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
            </div>
            <div class="col-md-6">
                    <table id="productos2" class="table table-bordered table-hover dataTable">
                            <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Ubicacion</th>
                                <th scope="col">Codigo</th>
                                <th scope="col">Stock Bodega</th>
                                <th scope="col">Stock Sala</th>
                            </tr>
                            </thead>
                            <tbody>
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
            </div>
    </div>
    <div class="row">
            <div class="col-md-6">
                    <table id="productos3" class="table table-bordered table-hover dataTable">
                        <thead>
                          <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Ubicacion</th>
                            <th scope="col">Codigo</th>
                            <th scope="col">Stock Bodega</th>
                            <th scope="col">Stock Sala</th>
                          </tr>
                        </thead>
                        <tbody>
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
            </div>
            <div class="col-md-6">
                      <table id="productos4" class="table table-bordered table-hover dataTable">
                              <thead>
                                <tr>
                                  <th scope="col">Nombre</th>
                                  <th scope="col">Ubicacion</th>
                                  <th scope="col">Codigo</th>
                                  <th scope="col">Stock Bodega</th>
                                  <th scope="col">Stock Sala</th>
                                </tr>
                              </thead>
                              <tbody>
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
            </div>
        

    </div>
   

</div>

@endsection

@section('script')

<script src="{{asset("assets/$theme/plugins/datatables/jquery.dataTables.js")}}"></script>
<script src="{{asset("assets/$theme/plugins/datatables-bs4/js/dataTables.bootstrap4.js")}}"></script>

<script>
  $(document).ready( function () {
    $('#productos').DataTable();
} );

$(document).ready( function () {
    $('#productos2').DataTable();
} );

$(document).ready( function () {
    $('#productos3').DataTable();
} );

$(document).ready( function () {
    $('#productos4').DataTable();
} );
</script>

    
@endsection