@extends("theme.$theme.layout")
@section('titulo')
Consulta Facturas Boletas
@endsection
@section('styles')

<link rel="stylesheet" href="{{asset("assets/$theme/plugins/datatables-bs4/css/dataTables.bootstrap4.css")}}">


@endsection

@section('contenido')

    <div class="container-fluid">
        <h6 class="display-3">Emision Libro De Ventas Diario</h6>
                    {{-- BUSCADOR --}}
                    <form action="{{route('filtrarconsultafacturaboleta')}}" method="post"  id="desvForm" class="form-inline">
                      @csrf                               
                            {{-- <div class="form-group mx-sm-3 mb-2">
                             @if (empty($fecha1))
                                <label for="inputPassword2" class="sr-only"></label>
                                <select id="documento" list="documento" class="form-control" name="documento" value="" required >
                                 <option value="1">Ambas</option>
                                 <option value="7">Boleta</option> 
                                 <option value="8">Factura</option>
                              </select>
                              @else
                              <label for="inputPassword2" class="sr-only"></label>
                              <select id="documento" list="documento" class="form-control" name="documento" value="{{$documento}}" required >
                               @if ($documento == 1)
                               <option selected="selected" value="1">Ambas</option>
                               <option value="7">Boleta</option> 
                               <option value="8">Factura</option>
                               @elseif($documento == 7)
                               <option value="1">Ambas</option>
                               <option selected="selected" value="7">Boleta</option> 
                               <option value="8">Factura</option> 
                               @else
                               <option value="1">Ambas</option>
                               <option value="7">Boleta</option> 
                               <option selected="selected" value="8">Factura</option>
                               @endif
                            </select>
                            @endif
                              </div> --}}
                              <div class="form-group mb-2">
                                     @if (empty($fecha1))
                                     <label for="staticEmail2" class="sr-only">Fecha 1</label>Desde
                                     <input type="date" id="fecha1" class="form-control" name="fecha1" >
                                     @else
                                   <input type="date" id="fecha1" class="form-control" name="fecha1"  value="{{$fecha1}}">
                                     @endif
                             </div>                                    
                              <div class="form-group mx-sm-3 mb-2">     
                                     @if (empty($fecha2))
                                     <label for="inputPassword2" class="sr-only">Fecha 2</label>Hasta
                                     <input type="date" id="fecha2" name="fecha2" class="form-control">
                                     @else
                                   <input type="date" id="fecha2" name="fecha2" class="form-control" value="{{$fecha2}}">
                                     @endif
                             </div>
                             <div class="col-md-2 ">
                                     
                               <button type="submit" class="btn btn-primary mb-2">Filtrar</button>
                          
                       </div>
                       <div class="col-md-2 col-md offset-">
                                     
                         <a href="" data-toggle="modal" data-target="#mimodalejemplo" class="btn btn-info">Info.</a>
                    
                 </div>   
              </form>

           
                    {{-- FIN BUSCADOR--}}
        <div class="row">
          <div class="col-md-12">
                  <h2>Boletas</h2>
              <table id="productos" class="table table-bordered table-hover dataTable table-sm">
                  <thead>
                    <tr>
                      <th scope="col" style="text-align:left">Numero Doc.</th>
                      <th scope="col" style="text-align:left">Tipo Doc.</th>
                      <th scope="col" style="text-align:left">RUT</th>
                      <th scope="col" style="text-align:left">Razon</th>
                      <th scope="col" style="text-align:left">Fecha</th>
                      <th scope="col" style="text-align:right">IVA</th>
                      <th scope="col" style="text-align:right">Neto</th>
                      <th scope="col" style="text-align:right">Total</th>  
                      {{-- <th scope="col" style="text-align:center">Acciones</th>   --}}
                    </tr>
                  </thead>
                  <tbody>
                        @if (empty($boleta))
                    
                        @else
                        <div style="display: none">
                          {{-- variable suma --}}
                            {{ $totalboletas = 0 }} 
                            {{ $totalboletasiva = 0 }} 
                            {{ $totalboletasneto = 0 }} 
                          </div>
                    @foreach($boleta as $item)
                      <tr>
                        <th  style="text-align:left">{{$item->CANMRO}}</th>
                        @if($item->CATIPO == 7)
                        <td style="text-align:left">Boleta</td>
                        @else
                        <td style="text-align:left">Factura</td>
                        @endif
                        <td style="text-align:left">{{$item->CARUTC}}</td>
                        <td style="text-align:left">-</td>
                        <td style="text-align:left">{{$item->CAFECO}}</td>
                        <td style="text-align:right">{{number_format($item->CAIVA,0,',','.')}}</td>
                        <div style="display: none">{{$totalboletasiva += $item->CAIVA}}</div>
                        <td style="text-align:right">{{number_format($item->CANETO,0,',','.')}}</td>
                        <div style="display: none">{{$totalboletasneto += $item->CANETO}}</div>
                        <td style="text-align:right">{{number_format($item->CAVALO,0,',','.')}}</td>
                        <div style="display: none">{{$totalboletas += $item->CAVALO}}</div>
                      </tr>
                      @endforeach
                      @endif
                    </tbody> 
                    <tfoot>
                      <tr>
                        <td colspan="7"><strong>Total</strong> </td>
                        @if(empty($totalboletas))
                        <td><span class="price text-success">$</span></td>
                        @else
                        <td style="text-align:right"><span class="price text-success">${{number_format($totalboletas,0,',','.')}}</span></td>
                        @endif
                      </tr>
                    </tfoot>             
                </table>
          </div>
          <div class="col-md-4">
            
        </div>
          
        </div>
        <div class="row">
          <div class="col-md-12">
            <h2>Facturas</h2>
              <table id="productoss" class="table table-bordered table-hover dataTable table-sm">
                  <thead>
                    <tr>
                      <th scope="col" style="text-align:left">Numero Doc.</th>
                      <th scope="col" style="text-align:left">Tipo Doc.</th>
                      <th scope="col" style="text-align:left">RUT</th>
                      <th scope="col" style="text-align:left">Razon</th>
                      <th scope="col" style="text-align:left">Fecha</th>
                      <th scope="col" style="text-align:right">IVA</th>
                      <th scope="col" style="text-align:right">Neto</th>
                      <th scope="col" style="text-align:right">Total</th>  
                      {{-- <th scope="col" style="text-align:center">Acciones</th>   --}}
                    </tr>
                  </thead>
                  <tbody>
                        @if (empty($factura))
                    
                        @else
                        <div style="display: none">
                          {{-- variable suma --}}
                            {{ $totalfactura = 0 }} 
                            {{ $totalfacturaiva = 0 }} 
                            {{ $totalfacturaneto = 0 }} 
                          </div>
                    @foreach($factura as $item)
                      <tr>
                        <th  style="text-align:left">{{$item->CANMRO}}</th>
                        @if($item->CATIPO == 7)
                        <td style="text-align:left">Boleta</td>
                        @else
                        <td style="text-align:left">Factura</td>
                        @endif
                        <td style="text-align:left">{{$item->CARUTC}}</td>
                        <td style="text-align:left">{{$item->razon}}</td>
                        <td style="text-align:left">{{$item->CAFECO}}</td>
                        <td style="text-align:right">{{number_format($item->CAIVA,0,',','.')}}</td>
                        <div style="display: none">{{$totalfacturaiva += $item->CAIVA}}</div>
                        <td style="text-align:right">{{number_format($item->CANETO,0,',','.')}}</td>
                        <div style="display: none">{{$totalfacturaneto += $item->CANETO}}</div>
                        <td style="text-align:right">{{number_format($item->CAVALO,0,',','.')}}</td>
                        <div style="display: none">{{$totalfactura += $item->CAVALO}}</div>
                      </tr>
                      @endforeach
                      @endif
                    </tbody> 
                    <tfoot>
                      <tr>
                        <td colspan="7"><strong>Total</strong> </td>
                        @if(empty($totalfactura))
                        <td><span class="price text-success">$</span></td>
                        @else
                        <td style="text-align:right"><span class="price text-success">${{number_format($totalfactura,0,',','.')}}</span></td>
                        @endif
                      </tr>
                    </tfoot>             
                </table>
          </div>

        </div>
        <div class="row">
          <div class="col-md-12">
            <h2>Notas De Credito</h2>
              <table id="notacre" class="table table-bordered table-hover dataTable table-sm">
                  <thead>
                    <tr>
                      <th scope="col" style="text-align:left">Folio</th>
                      <th scope="col" style="text-align:left">Tipo Doc.</th>
                      <th scope="col" style="text-align:left">RUT</th>
                      <th scope="col" style="text-align:left">Nombre</th>
                      <th scope="col" style="text-align:left">Fecha</th>
                      <th scope="col" style="text-align:right">IVA</th>
                      <th scope="col" style="text-align:right">Neto</th>
                      <th scope="col" style="text-align:right">Total</th>  
                      {{-- <th scope="col" style="text-align:center">Acciones</th>   --}}
                    </tr>
                  </thead>
                  <tbody>
                        @if (empty($notacredito))
                    
                        @else
                        <div style="display: none">
                          {{-- variable suma --}}
                            {{ $totalnotacre = 0 }} 
                            {{ $totalnotacreneto = 0 }} 
                            {{ $totalnotacreiva = 0 }} 
                          </div>
                    @foreach($notacredito as $item)
                      <tr>
                        <th  style="text-align:left">{{$item->folio}}</th>
                        <td style="text-align:left">Nota Credito</td>
                        <td style="text-align:left">{{$item->rut}}</td>
                        <td style="text-align:left">{{$item->nombre}}</td>
                        <td style="text-align:left">{{$item->fecha_actual}}</td>
                        <td style="text-align:right">{{number_format($item->iva,0,',','.')}}</td>
                        <div style="display: none">{{$totalnotacreiva += $item->iva}}</div>
                        <td style="text-align:right">{{number_format($item->neto,0,',','.')}}</td>
                        <div style="display: none">{{$totalnotacreneto += $item->neto}}</div>
                        <td style="text-align:right">{{number_format($item->total_nc,0,',','.')}}</td>
                        <div style="display: none">{{$totalnotacre += $item->total_nc}}</div>
                      </tr>
                      @endforeach
                      @endif
                    </tbody> 
                    <tfoot>
                      <tr>
                        <td colspan="7"><strong>Total</strong> </td>
                        @if(empty($totalnotacre))
                        <td><span class="price text-success">$</span></td>
                        @else
                        <td style="text-align:right"><span class="price text-success">${{number_format($totalnotacre,0,',','.')}}</span></td>
                        @endif
                      </tr>
                    </tfoot>             
                </table>
          </div>

        </div>
        <hr>
        <div class="col-md-12">
          <div class="form-row">
            <div class="col-md-6 mb-4">
              <h2>N° Documentos Emitidos</h2>
            </div>
          
            <div class="col-md-6 mb-4">
              <h2>Monto Acumulado</h2>
          </div>
        </div>
        </div>
        <div class="col-md-12">
                    <div class="form-row">
                      <div class="col-md-1 mb-3">
                        <label for="validationTooltip02">Documentos</label>
                        <input type="text" class="form-control" style="font-weight: bold;" id="validationTooltip02"  readonly value="Boletas" required>
                      </div>
                      <div class="col-md-1 mb-3">
                        <label for="validationTooltip02">Validas</label>
                        @if (empty($boletacount))
                        <input type="text" class="form-control" id="validationTooltip02" readonly value="" required>
                        @else
                        <input type="text" class="form-control" id="validationTooltip02" readonly value="{{$boletacount}}" required>
                        @endif
                      </div>
                      <div class="col-md-2 mb-3">
                        <label for="validationTooltipUsername">Nulas</label>
                        <div class="input-group">
                          <input type="text" class="form-control" value="0" id="validationTooltipUsername" readonly aria-describedby="validationTooltipUsernamePrepend" required>
                        </div>
                      </div>
                      <div class="col-md-2 mb-3">
                        <label for="validationTooltipUsername">Total</label>
                        <div class="input-group">
                          @if (empty($boletacount))
                          <input type="text" class="form-control" value="" id="validationTooltipUsername" readonly aria-describedby="validationTooltipUsernamePrepend" required>
                          @else
                          <input type="text" class="form-control" value="{{$boletacount}}" id="validationTooltipUsername" readonly aria-describedby="validationTooltipUsernamePrepend" required>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-2 mb-3">
                        <label for="validationTooltipUsername">Neto</label>
                        <div class="input-group">
                          @if (empty($totalboletasneto))
                          <input type="text" class="form-control" id="validationTooltipUsername" value="" readonly aria-describedby="validationTooltipUsernamePrepend" required>
                          @else
                          <input type="text" class="form-control" id="validationTooltipUsername" value="${{number_format($totalboletasneto,0,',','.')}}" readonly aria-describedby="validationTooltipUsernamePrepend" required>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-2 mb-3">
                        <label for="validationTooltipUsername">IVA</label>
                        <div class="input-group">
                          @if (empty($totalboletasiva))
                          <input type="text" class="form-control" id="validationTooltipUsername" value="" readonly aria-describedby="validationTooltipUsernamePrepend" required>
                          @else
                          <input type="text" class="form-control" id="validationTooltipUsername" value="${{number_format($totalboletasiva,0,',','.')}}" readonly aria-describedby="validationTooltipUsernamePrepend" required>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-2 mb-3">
                        <label for="validationTooltipUsername">Total</label>
                        <div class="input-group">
                          @if (empty($totalboletas))
                          <input type="text" class="form-control" id="validationTooltipUsername" readonly aria-describedby="validationTooltipUsernamePrepend" value="" required>
                          @else
                          <input type="text" class="form-control" id="validationTooltipUsername" readonly aria-describedby="validationTooltipUsernamePrepend" value="${{number_format($totalboletas,0,',','.')}}" required>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-md-1 mb-3">
                        <input type="text" class="form-control" style="font-weight: bold;" id="validationTooltip02" readonly value="Facturas" required>
                      </div>
                      <div class="col-md-1 mb-3">
                        @if (empty($facturacount))
                        <input type="text" class="form-control" id="validationTooltip02" readonly value="" required>
                        @else
                        <input type="text" class="form-control"  id="validationTooltip02" readonly value="{{$facturacount}}" required>
                        @endif
                      </div>
                      <div class="col-md-2 mb-3">
                        <div class="input-group">
                          <input type="text" class="form-control" value="0" id="validationTooltipUsername" readonly aria-describedby="validationTooltipUsernamePrepend" required>
                        </div>
                      </div>
                      <div class="col-md-2 mb-3">
                        @if (empty($notacreditocount))
                        <input type="text" class="form-control" id="validationTooltip02" readonly value="" required>
                        @else
                        <input type="text" class="form-control"  id="validationTooltip02" readonly value="{{$facturacount}}" required>
                        @endif
                      </div>
                      <div class="col-md-2 mb-3">
                        <div class="input-group">
                          @if (empty($totalfacturaneto))
                          <input type="text" class="form-control" id="validationTooltipUsername" value="" readonly aria-describedby="validationTooltipUsernamePrepend" required>
                          @else
                          <input type="text" class="form-control" id="validationTooltipUsername" value="${{number_format($totalfacturaneto,0,',','.')}}" readonly aria-describedby="validationTooltipUsernamePrepend" required>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-2 mb-3">
                        <div class="input-group">
                          @if (empty($totalfacturaiva))
                          <input type="text" class="form-control" id="validationTooltipUsername" value="" readonly aria-describedby="validationTooltipUsernamePrepend" required>
                          @else
                          <input type="text" class="form-control" id="validationTooltipUsername" value="${{number_format($totalfacturaiva,0,',','.')}}" readonly aria-describedby="validationTooltipUsernamePrepend" required>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-2 mb-3">
                        <div class="input-group">
                          @if (empty($totalfactura))
                          <input type="text" class="form-control" id="validationTooltipUsername" value="" readonly aria-describedby="validationTooltipUsernamePrepend" required>
                          @else
                          <input type="text" class="form-control"  id="validationTooltipUsername" value="${{number_format($totalfactura,0,',','.')}}" readonly aria-describedby="validationTooltipUsernamePrepend" required>
                          @endif
                        </div>
                      </div>
                    </div>
                    
                    <div class="form-row">
                      <div class="col-md-1 mb-3">
                        <input type="text" class="form-control" style="font-weight: bold;" id="validationTooltip02" readonly value="Nota Cred." required>
                      </div>
                      <div class="col-md-1 mb-3">
                        @if (empty($notacreditocount))
                        <input type="text" class="form-control" id="validationTooltip02" readonly value="" required>
                        @else
                        <input type="text" class="form-control" id="validationTooltip02" readonly value="{{$notacreditocount}}" required>
                        @endif
                      </div>
                      <div class="col-md-2 mb-3">
                        <div class="input-group">
                          <input type="text" class="form-control" id="validationTooltipUsername" value="0" readonly aria-describedby="validationTooltipUsernamePrepend" required>
                        </div>
                      </div>
                      <div class="col-md-2 mb-3">
                        @if (empty($notacreditocount))
                        <input type="text" class="form-control" id="validationTooltip02" readonly value="" required>
                        @else
                        <input type="text" class="form-control" id="validationTooltip02" readonly value="{{$notacreditocount}}" required>
                        @endif
                      </div>
                      <div class="col-md-2 mb-3">
                        <div class="input-group">
                          @if (empty($totalnotacreneto))
                          <input type="text" class="form-control" id="validationTooltipUsername" value="" readonly aria-describedby="validationTooltipUsernamePrepend" required>
                          @else
                          <input type="text" class="form-control" id="validationTooltipUsername" value="${{number_format($totalnotacreneto,0,',','.')}}" readonly aria-describedby="validationTooltipUsernamePrepend" required>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-2 mb-3">
                        <div class="input-group">
                          @if (empty($totalnotacreiva))
                          <input type="text" class="form-control" id="validationTooltipUsername" value="" readonly aria-describedby="validationTooltipUsernamePrepend" required>
                          @else
                          <input type="text" class="form-control" id="validationTooltipUsername" value="${{number_format($totalnotacreiva,0,',','.')}}" readonly aria-describedby="validationTooltipUsernamePrepend" required>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-2 mb-3">
                        <div class="input-group">
                          @if (empty($totalnotacre))
                          <input type="text" class="form-control" id="validationTooltipUsername" value="" readonly aria-describedby="validationTooltipUsernamePrepend" required>
                          @else
                          <input type="text" class="form-control"  id="validationTooltipUsername" value="${{number_format($totalnotacre,0,',','.')}}" readonly aria-describedby="validationTooltipUsernamePrepend" required>
                          @endif
                        </div>
                      </div>
                    </div>
                    <hr>
                    <div class="form-row">
                      <div class="col-md-1 mb-3">
                        <input type="text" class="form-control" style="font-weight: bold;" id="validationTooltip02" readonly value="Total" required>
                      </div>
                      <div class="col-md-1 mb-3">
                        @if (empty($totalnotacre))
                        <input type="text" class="form-control" value="" id="validationTooltip02" readonly value="" required>
                        @else
                        <input type="text" class="form-control" style="font-weight: bold;" value="{{number_format($sumadocumentos,0,',','.')}}" id="validationTooltip02" readonly value="" required>
                        @endif
                      </div>
                      <div class="col-md-2 mb-3">
                        <div class="input-group">
                          <input type="text" class="form-control" style="font-weight: bold;" value="0" id="validationTooltipUsername" readonly aria-describedby="validationTooltipUsernamePrepend" required>
                        </div>
                      </div>
                      <div class="col-md-2 mb-3">
                        <div class="input-group">
                          @if (empty($sumadocumentos))
                          <input type="text" class="form-control" value="" id="validationTooltipUsername" readonly aria-describedby="validationTooltipUsernamePrepend" required>
                          @else
                          <input type="text" class="form-control" style="font-weight: bold;" value="{{number_format($sumadocumentos,0,',','.')}}" id="validationTooltipUsername" readonly aria-describedby="validationTooltipUsernamePrepend" required>
                        @endif
                        </div>
                      </div>
                      <div class="col-md-2 mb-3">
                        <div class="input-group">
                          @if (empty($totalneto))
                          <input type="text" class="form-control" value="" id="validationTooltipUsername" readonly aria-describedby="validationTooltipUsernamePrepend" required>
                          @else
                          <input type="text" class="form-control" style="font-weight: bold;" value="${{number_format($totalneto,0,',','.')}}" id="validationTooltipUsername" readonly aria-describedby="validationTooltipUsernamePrepend" required>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-2 mb-3">
                        <div class="input-group">
                          @if (empty($totaliva))
                          <input type="text" class="form-control" value="" id="validationTooltipUsername" readonly aria-describedby="validationTooltipUsernamePrepend" required>
                          @else
                          <input type="text" class="form-control" style="font-weight: bold;" value="${{number_format($totaliva,0,',','.')}}" id="validationTooltipUsername" readonly aria-describedby="validationTooltipUsernamePrepend" required>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-2 mb-3">
                        <div class="input-group">
                          @if (empty($total))
                          <input type="text" class="form-control" value="" id="validationTooltipUsername" readonly aria-describedby="validationTooltipUsernamePrepend"  required>
                          @else
                          <input type="text" class="form-control" style="font-weight: bold;" value="${{number_format($total,0,',','.')}}" id="validationTooltipUsername" readonly aria-describedby="validationTooltipUsernamePrepend"  required>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-md-2 mb-3">
                        <label for="validationTooltip03">Desde</label>
                        @if (empty($fecha1))
                        <input type="text" value="" class="form-control" readonly id="validationTooltip03">
                        @else
                        <input type="text" value="{{$fecha1}}"  class="form-control" readonly id="validationTooltip03">
                        @endif
                      </div>
                      <div class="col-md-2 mb-3">
                            <label for="validationTooltip03">Hasta</label>
                            @if (empty($fecha2))
                            <input type="text" value="" class="form-control" readonly id="validationTooltip03" >
                            @else
                            <input type="text" value="{{$fecha2}}"  class="form-control" readonly id="validationTooltip03" >
                            @endif
                          </div>
                    </div>
              </div>   

              <div class="row">
                <div class="col-md-6">
                  <h2>Ventas Por Caja (Boletas)</h2>
                    <table id="notacre" class="table table-bordered table-hover dataTable table-sm">
                        <thead>
                          <tr>
                            <th scope="col" style="text-align:left">Caja</th>
                            <th scope="col" style="text-align:right">Total Vendido</th> 
                          </tr>
                        </thead>
                        <tbody>
                              @if (empty($porcaja))
                          
                              @else
                              <div style="display: none">
                                {{-- variable suma --}}
                                  {{ $totalvendido = 0 }} 
                                </div>
                          @foreach($porcaja as $item)
                            <tr>
                              <th  style="text-align:left">{{$item->CAJA}}</th>
                              <td style="text-align:right">{{number_format($item->TOTAL,0,',','.')}}</td>
                              <div style="display: none">{{$totalvendido += $item->TOTAL}}</div>
                            </tr>
                            @endforeach
                            @endif
                          </tbody> 
                          <tfoot>
                            <tr>
                              <td colspan="1"><strong>Total</strong> </td>
                              @if(empty($totalvendido))
                              <td><span class="price text-success">$</span></td>
                              @else
                              <td style="text-align:right"><span class="price text-success">${{number_format($totalvendido,0,',','.')}}</span></td>
                              @endif
                            </tr>
                          </tfoot>             
                      </table>
                </div>
                <div class="col-md-6">
                  <h2>Ventas Impresoras Fiscales</h2>
                    <table id="notacre" class="table table-bordered table-hover dataTable table-sm">
                        <thead>
                          <tr>
                            <th scope="col" style="text-align:left">Impresora Fiscal</th>
                            <th scope="col" style="text-align:left">Desde</th>
                            <th scope="col" style="text-align:left">Hasta</th>
                            <th scope="col" style="text-align:left">Cantidad Boletas</th>
                            <th scope="col" style="text-align:left">Total Vendido</th> 
                          </tr>
                        </thead>
                        <tbody>
                              @if (empty($porimpresora))
                          
                              @else
                              <div style="display: none">
                                {{-- variable suma --}}
                                  {{ $totalvendido = 0 }} 
                                </div>
                          @foreach($porimpresora as $item)
                            <tr>
                              <th style="text-align:left">{{$item->CAJA}}</th>
                              <td style="text-align:right">{{number_format($item->Desde,0,',','.')}}</td>
                              <td style="text-align:right">{{number_format($item->Hasta,0,',','.')}}</td>
                              <td style="text-align:right">{{number_format($item->cantidad,0,',','.')}}</td>
                              <td style="text-align:right">{{number_format($item->TOTAL,0,',','.')}}</td>
                              <div style="display: none">{{$totalvendido += $item->TOTAL}}</div>
                            </tr>
                            @endforeach
                            @endif
                          </tbody> 
                          <tfoot>
                            <tr>
                              <td colspan="4"><strong>Total</strong> </td>
                              @if(empty($totalvendido))
                              <td><span class="price text-success">$</span></td>
                              @else
                              <td style="text-align:right"><span class="price text-success">${{number_format($totalvendido,0,',','.')}}</span></td>
                              @endif
                            </tr>
                          </tfoot>             
                      </table>
                </div>
      
              </div>
       
</div>
<!-- Modal -->
<div class="modal fade" id="mimodalejemplo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Información de la Consulta</h4>
      </div>
      <div class="modal-body">
         <div class="card-body">Emision Libro De Ventas Diario</div>
      </div>
      <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-secondary">Cerrar</button>
     </div>
    </div>
  </div>
</div>
 <!-- FIN Modal -->
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
  <script>
    $(document).ready(function() {
      $('#productoss').DataTable( {
          dom: 'Bfrtip',
          buttons: [
              'copy', 'csv', 'excel', 'pdf', 'print'
              
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
      <script>
        $(document).ready(function() {
          $('#notacre').DataTable( {
              dom: 'Bfrtip',
              buttons: [
                  'copy', 'csv', 'excel', 'pdf', 'print'
                  
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
  <script src="{{asset("js/dataTables.buttons.min.js")}}"></script>
  <script src="{{asset("js/buttons.flash.min.js")}}"></script>
  <script src="{{asset("js/jszip.min.js")}}"></script>
  <script src="{{asset("js/pdfmake.min.js")}}"></script>
  <script src="{{asset("js/vfs_fonts.js")}}"></script>
  <script src="{{asset("js/buttons.html5.min.js")}}"></script>
  <script src="{{asset("js/buttons.print.min.js")}}"></script>


@endsection