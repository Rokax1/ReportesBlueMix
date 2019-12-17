@extends("theme.$theme.layout")
@section('titulo')
Consumo GiftCard
@endsection

@section('styles')

<link rel="stylesheet" href="{{asset("assets/$theme/plugins/datatables-bs4/css/dataTables.bootstrap4.css")}}">


@endsection
@section('contenido')

<div class="container-fluid">
    <h3 class="display-3">Bloqueo GiftCard</h3>
    <div class="row">
    <div class="col-md-8">

      <form action="{{route('filtrartarjetabloqueo')}}" method="post"  id="desvForm" class="form-inline">
        @csrf
              <div class="form-group mb-2">
                @if (empty($rut))
                <label for="staticEmail2" class="sr-only">Codigo</label>
                <input type="number" id="codigo" class="form-control" name="codigo" >
                @else
              <input type="number" id="codigo" class="form-control" name="codigo" required value="{{$rut}}">
                @endif
              </div>
              <button type="submit" class="btn btn-primary mb-2">Filtrar</button>            
            </form>
              <hr>
        </div>    
      </div>
      <div class="row">
      
      <div class="col-md-8">
        <table class="table table-bordered table-hover dataTable">
          <tr>
            <th><input type="checkbox" id="selectall"></th>
            <th>Codigo Tarjeta</th>
            <th>Monto Inicial</th>
            <th>Saldo Actual</th>
            <th>Fecha Activacion</th>
          </tr>
          <tr>
            <form action="{{route('bloqueartarjetacard')}}" method="post"  id="desvForm" class="form-inline">
              @csrf
            <tbody> 
              @if (empty($consulta))
              @else
            @foreach($consulta as $item)
            <td><input type="checkbox" class="case" name="case[]" value="{{$item->TARJ_CODIGO}}"></td>
            <td>{{$item->TARJ_CODIGO}}</td>
            <td>{{number_format($item->TARJ_MONTO_INICIAL,0,',','.')}}</td>
            <td>{{number_format($item->TARJ_MONTO_ACTUAL,0,',','.')}}</td>
            <td>{{$item->TARJ_FECHA_ACTIVACIÓN}}</td>
            
          </tr>
          @endforeach 
          @endif
        </table>
      </tbody>
      </div>
      <div class="col-md-4">
        @if (empty($consulta[0]))
        <div class="form-row">

                <div class="col-md-4 mb-3">
                  <label for="validationTooltip01">Comprador</label>
                  <input type="text" class="form-control" id="validationTooltip01" readonly value="" required>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="validationTooltip02">Rut Comprador</label>
                  <input type="text" class="form-control" id="validationTooltip02"  readonly value="" >
                </div>
                <div class="col-md-4 mb-3">
                  <label for="validationTooltipUsername">Estado</label>
                  <div class="input-group">
                    <input type="text" class="form-control" id="validationTooltipUsername"  readonly aria-describedby="validationTooltipUsernamePrepend">
                  </div>

            </div>
        </div>
        <div class="form-row">
                <div class="col-md-4 mb-3">
                  <label for="validationTooltip01">Motivo Bloqueo</label>
            <textarea readonly name=""  id="" cols="53" rows="4"></textarea>                        
        </div>
    </div>
    @else
          <div class="form-row">
                  <div class="col-md-6 mb-4">
                    <label for="validationTooltip01">Comprador</label>
                    <input type="text" class="form-control" id="validationTooltip01" readonly value="{{$consulta[0]->TARJ_COMPRADOR_NOMBRE}}" required>
                  </div>
                  <div class="col-md-6 mb-4">
                    <label for="validationTooltip02">Rut Comprador</label>
                    <input type="text" class="form-control" id="validationTooltip02"  readonly value="{{$consulta[0]->TARJ_COMPRADOR_RUT}}" >
                  </div>
          </div>
          <div class="form-row">
                  <div class="col-md-4 mb-3">
                    <label for="validationTooltip01">Motivo Bloqueo</label>
              <textarea  placeholder="Escriba el motivo de bloqueo..." name="bloqueo" required id="bloqueo" cols="53" rows="4"></textarea>                        
          </div>
      </div>
      <div class="form-row">
        <div class="col-md-4 mb-3">
       <button type="submit" class="btn btn-danger">Bloquear</button>    
      </form>                  
</div>
</div>
      @endif
        </div>
    </div>
</div>


    <table id="tarjetas" class="table table-bordered table-hover dataTable">
        <thead>
          <tr>
            <th scope="col" style="text-align:center">codigo</th>
            <th scope="col" style="text-align:center">Codigo Barra</th>
            <th scope="col" style="text-align:center"> Monto Tarjeta</th>
            <th scope="col" style="text-align:center"> Seleccionar Todos <input type="checkbox" id="selectall"> </th>
          </tr>
        </thead>
          @if (empty($giftCreadas))
              
          @else
          <tbody>
              @foreach($giftCreadas as $item)
                <tr>
                  <th >{{$item->TARJ_CODIGO}}</th>
                  <td style="text-align:center">{{$item->TARJ_MONTO_INICIAL}}</td>
                </tr>
                @endforeach
              </tbody>   
          @endif
                  
    </table>







@endsection
@section('script')
<script>
    $(document).ready(function() {
      $('#cambioPrec').DataTable( {
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
<script>

$("#selectall").on("click", function() {
  $(".case").prop("checked", this.checked);
});

$(".case").on("click", function() {
  if ($(".case").length == $(".case:checked").length) {
    $("#selectall").prop("checked", true);
  } else {
    $("#selectall").prop("checked", false);
  }
});
</script>

@endsection