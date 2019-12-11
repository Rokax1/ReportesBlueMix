@extends("theme.$theme.layout")
@section('titulo')
Venta GiftCards
@endsection

@section('styles')

    
@endsection

@section('contenido')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
                <h3 class="display-4 m-2 pb-2" >Venta de GifCards</h3>  
        </div>
        <div class="col-md-6">

        </div>
    </div>
    <div class="row">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        <div class="col-md-6">
                <div class="card-group">
                        <div class="card">
                          <img class="card-img-top" src="{{asset("giftcard/img/20.000.jpg")}}" alt="Card image cap">
                          <div class="card-body">
                            @if (!empty($codigo))
      
                            @else
                            <h5 class="card-title">Stock: <strong>{{$cantGift[0]->CantidadGift}}</strong> </h5>
                            @endif
                            <hr>
                            <p class="card-text">  <a href="{{route('cargarCodigosVenta',20000)}}" class="btn btn-success"> <i class="fas fa-dollar-sign"></i> </a>  </p>
                          </div>
                          <div class="card-footer">
                            <small class="text-muted">GiftCard $20.000</small>
                          </div>
                        </div>
                        <div class="card">
                          <img class="card-img-top" src="{{asset("giftcard/img/40.000.jpg")}}" alt="Card image cap">
                          <div class="card-body">
                              @if (!empty($codigo))
      
                              @else
                              <h5 class="card-title">Stock: <strong>{{$cantGift[1]->CantidadGift}}</strong> </h5>
                              @endif
                              <hr>
                              <p class="card-text">  <a href="{{route('cargarCodigosVenta',40000)}}" class="btn btn-success "> <i class="fas fa-dollar-sign"></i></a>  </p>
                          </div>
                          <div class="card-footer">
                            <small class="text-muted">GiftCard $40.000</small>
                          </div>
                        </div>
                        <div class="card">
                          <img class="card-img-top" src="{{asset("giftcard/img/60.000.jpg")}}" alt="Card image cap">
                          <div class="card-body">
                              @if (!empty($codigo))
      
                              @else
                              <h5 class="card-title">Stock: <strong>{{$cantGift[2]->CantidadGift}}</strong> </h5>
      
                              @endif
                              <hr>
                              <p class="card-text">  <a href="{{route('cargarCodigosVenta',60000)}}" class="btn btn-success"> <i class="fas fa-dollar-sign"></i> </a>  </p>
                          </div>
                          <div class="card-footer">
                            <small class="text-muted">GiftCard $60.000</small>
                          </div>
                        </div>
                        <div class="card">
                          <img class="card-img-top" src="{{asset("giftcard/img/100.000.jpg")}}" alt="Card image cap">
                          <div class="card-body">
                              @if (!empty($codigo))
      
                              @else
                              <h5 class="card-title">Stock: <strong>{{$cantGift[3]->CantidadGift}}</strong> </h5>
                              @endif
                              <hr>
                          <p class="card-text">  <a href="{{route('cargarCodigosVenta',100000)}}" class="btn btn-success"> <i class="fas fa-dollar-sign"></i></a>  </p>
                          </div>
                          <div class="card-footer">
                            <small class="text-muted">GiftCard $100.000</small>
                          </div>
                        </div>
                      </div>


        </div>
        <div class="col-md-6">
                <table id="tarjetas" class="table table-bordered table-hover dataTable">
                        <thead>
                          <tr>
                            <th scope="col" style="text-align:center">codigo</th>
                            <th scope="col" style="text-align:center">Codigo Barra</th>
                            <th scope="col" style="text-align:center"> Monto Tarjeta</th>
                            <th scope="col" style="text-align:center"> Seleccione</th>
                          </tr>
                        </thead>
                          @if (empty($giftCreadas))
                              
                          @else
                          <tbody>
                              @foreach($giftCreadas as $item)
                                <tr>
                                  <th >{{$item->TARJ_ID}}</th>
                                  <th >{{$item->TARJ_CODIGO}}</th>
                                  <td style="text-align:center">${{number_format($item->TARJ_MONTO_INICIAL,0,',','.')}}</td>
                                  <td style="text-align:center"><input type="checkbox" name="{{$item->TARJ_ID}}" id="" value="{{$item->TARJ_CODIGO}}"> <label for="cbox2">Selecciona para vender</label></td>
                                </tr>
                                @endforeach
                              </tbody>   
                          @endif
                                  
                      </table>
        </div>
    </div>
    
     
</div>


@endsection

@section('script')
<script>
  $(document).ready(function() {
    $('#tarjetas').DataTable( {
        dom: 'Bfrtip',
        "iDisplayLength": 5,
        "searching": false,
        
        buttons: [
          
            
        ],
          "language":{
        "info": "_TOTAL_ registros",
        "search":  "Buscar",
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
    } );
  } );
  </script>
  <link rel="stylesheet" href="{{asset("assets/$theme/plugins/datatables-bs4/css/buttons.dataTables.min.css")}}">
  <link rel="stylesheet" href="{{asset("assets/$theme/plugins/datatables-bs4/css/jquery.dataTables.min.css")}}">
  <script src="{{asset("js/jquery-3.3.1.js")}}"></script>
  <script src="{{asset("js/jquery.dataTables.min.js")}}"></script>
  {{-- <script src="{{asset("js/dataTables.buttons.min.js")}}"></script>
  <script src="{{asset("js/buttons.flash.min.js")}}"></script>
  <script src="{{asset("js/jszip.min.js")}}"></script>
  <script src="{{asset("js/pdfmake.min.js")}}"></script>
  <script src="{{asset("js/vfs_fonts.js")}}"></script>
  <script src="{{asset("js/buttons.html5.min.js")}}"></script>
  <script src="{{asset("js/buttons.print.min.js")}}"></script>
  <script src="{{asset("js/validarRUT.js")}}"></script> --}}

<script src="{{asset("js/ajaxproductospormarca.js")}}"></script>

@endsection