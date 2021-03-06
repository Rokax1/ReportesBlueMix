@extends("theme.$theme.layout")
@section('titulo')
Stock Tiempo Real
@endsection
@section('styles')


@endsection

@section('contenido')

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
            <h3 class="display-3">Stock Tiempo Real</h3>
        </div>
        <div class="col md-6">
        {{-- algo al lado del titulo --}}
            
        </div>

      </div>
        <div class="row">
          <div class="col-md-12">
                   <div class="productosNegativos">
                              <table id="productos" class="table table-bordered table-hover dataTable">
                                  <thead>
                                    <tr>
                                      <th scope="col">Codigo</th>
                                      <th scope="col">Descripcion</th>
                                      <th scope="col">Marca</th>
                                      <th scope="col">Stock Sala</th>
                                      <th scope="col">Stock Bodega</th>
                                      <th scope="col">Precio Detalle</th>
                                      <th scope="col">Precio Mayor</th>
                                      <th scope="col">Neto</th>
                                    </tr>
                                  </thead>
                                  <tbody id="res">
                                  @foreach($productos as $item)
                                    <tr>
                                      <th >{{$item->codigo}}</th>
                                      <td>{{$item->descripcion}}</td>
                                      <td>{{$item->marca}}</td>
                                      <td>{{$item->stock_sala}}</td>
                                      <td>{{$item->stock_bodega}}</td>
                                      <td>{{$item->precio_detalle}}</td>
                                      <td>{{$item->precio_mayor}}</td>
                                      <td>{{$item->neto}}</td>
                                    </tr>
                                    @endforeach
                                  </tbody>
                                </table>
                      </div>
          </div> 
        </div>  
</div>
@endsection
@section('script')
<script>
  $(document).ready(function() {
    $('#productos').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "language":{
      "info": "_TOTAL_ registros",
      "paginate":{
        "next": "Siguiente",
        "previous": "Anterior",
      
    },
    "loadingRecords": "cargando",
    "processing": "procesando",
    "emptyTable": "no hay resultados",
    "zeroRecords": "no hay coincidencias",
    "infoEmpty": "",
    "infoFiltered": ""
    }
    });
  } );
  </script>
<link rel="stylesheet" href="{{asset("assets/$theme/plugins/datatables-bs4/css/buttons.dataTables.min.css")}}">
<link rel="stylesheet" href="{{asset("assets/$theme/plugins/datatables-bs4/css/jquery.dataTables.min.css")}}">
<script src="{{asset("js/jquery-3.3.1.js")}}"></script>
<script src="{{asset("js/jquery.dataTables.min.js")}}"></script>
<script src="{{asset("js/dataTables.buttons.min.js")}}"></script>
<script src="{{asset("js/buttons.flash.min.js")}}"></script>
<script src="{{asset("js/jszip.min.js")}}"></script>
<script src="{{asset("js/pdfmake.min.js")}}"></script>
<script src="{{asset("js/vfs_fonts.js")}}"></script>
<script src="{{asset("js/buttons.html5.min.js")}}"></script>
<script src="{{asset("js/buttons.print.min.js")}}"></script>



<script src="{{asset("js/ajaxProductosNegativos.js")}}"></script>

    
@endsection