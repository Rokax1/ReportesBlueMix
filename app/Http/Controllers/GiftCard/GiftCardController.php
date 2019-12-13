<?php

namespace App\Http\Controllers\GiftCard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\GiftCard;
use DB;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Collection as Collection;

class GiftCardController extends Controller
{
 

    public function index(){ // carga los datos necesarios en la pantalla principal de laa activacion de giftcards
       // $ean = '5000';
       // dd( strlen($ean));
      //  $ena13 = $this->ean13_check_digit($ean);
        //dd($ena13);
        $idBD = DB::table('tarjeta_gift_card')->max('TARJ_ID');
        $idBD=$idBD+1;
        $date = Carbon::now();
        //dd($date);
        $date->addMonth(6);
        $date = $date->format('Y-m-d');
        //dd($date);
        $cantGift=DB::table('CantidadGiftCard')
        ->get();
      
        return view('giftCard.index',compact('idBD','date','cantGift'));

    }

    
    public function generarGiftCard(Request $request){ //metodo que se encarga de la activacion de giftcards
        //dd($request->all());
       $params_array= $request->all();
      // dd($params_array);
      $cantGift=DB::table('CantidadGiftCard')
        ->get();

        $validate = \Validator::make($params_array,[
            // 'Desde' =>'required',
            // 'hasta' =>'required',
            'Monto' =>'required',
            'Cantidad'=>'required',
            // 'FechaVencimiento'=>'required',
        ]);
        

        if($validate->fails()){

            $errors = $validate->errors();
            Session::flash('error','Algo ha salido mal intentalo nuevamente');
           return view('giftCard.index',compact('errors','cantGift'));


        }else{
            $id=0;
            $idBD = DB::table('tarjeta_gift_card')->max('TARJ_ID');
            //dd($idBD);
            if(empty($idBD)){
                $id=1;
            }else{
                $id=$id+$idBD;
                $id=$id+1;
            }
            //dd($id);
           $cantidadIteracion= $params_array['Cantidad'];
           // dd( $cantidadIteracion);
           
           //dd($Ean13);
          // $cantidadIteracion= ;
            //$id= $params_array['hasta'];
           $date = Carbon::now();
           $date = $date->format('Y-m-d');
           $User= session()->get('nombre');
            $rem=1;
           try{

            DB::transaction(function () use ($date ,$User,$cantidadIteracion,$id,$params_array) {
              
               

                        for ($i = 1; $i <= $cantidadIteracion; $i++)  {
                            $Ean13= $this->ean13_check_digit($id);
                            //dd($Ean13);
                           $remplazo= substr($Ean13, -12);
                      
                            DB::table('tarjeta_gift_card')->insert([
                                'TARJ_ID' => $id,
                                'TARJ_CODIGO'=>$remplazo,
                                'TARJ_MONTO_INICIAL'=>$params_array['Monto'],
                                'TARJ_MONTO_ACTUAL'=>$params_array['Monto'],
                                'TARJ_FECHA_ACTIVACIÓN'=>$date,
                                // 'TARJ_FECHA_VENCIMIENTO' =>$params_array['FechaVencimiento'],
                                'TARJ_RUT_USUARIO'=>$User,
                                'TARJ_ESTADO'=>'A'
                                ]);
                                $id=$id+1;
                        }
                        
                         
                }); // acepta un numero que es la cantidad de veces q intenta hacer el procedimietno 

            }catch(Exception $e){
                $cantGift=DB::table('CantidadGiftCard')
                ->get();
                // dd($e);
                 $date = Carbon::now();
                 //dd($date);
                 $date->addMonth(6);
                 $date = $date->format('Y-m-d');
                 Session::flash('error','Algo ha salido mal intentalo nuevamente');
         
                 return view('giftCard.index',compact('date','cantGift'));
     
            } catch (\Throwable $e) {
                 DB::rollBack();
                 $date = Carbon::now();
                 dd($e);
                 $date->addMonth(6);
                 $date = $date->format('Y-m-d');
                 $cantGift=DB::table('CantidadGiftCard')
                 ->get();
                 Session::flash('error','Algo ha salido mal intentalo nuevamente');
                // dd($e,'2catch');
                 return view('giftCard.index',compact('date','cantGift'));
            }

        }
        /*
       $giftCreadas=DB::table('tarjeta_gift_card')
       ->where('TARJ_COMPRADOR_RUT','=',$params_array['RutComprador'])
       ->orderBy('TARJ_ID', 'desc')
       ->take( $cantidadIteracion)
       ->get();*/
      

       $cantGift=DB::table('CantidadGiftCard')
       ->get();
       //dd($cantGift);

       


        $date = Carbon::now();
       
        $date->addMonth(6);
        $date = $date->format('Y-m-d');
        Session::flash('success','Tarjetas Creadas con Exito!!!');
    
        return view('giftCard.index',compact('date','params_array','cantGift'));

    }

    public function CargarTablaCodigos($monto){ // carga los codigos para su posterior revicion o hacer giftcards preechas(activacion)
        //dd($monto);

        $giftCreadas=DB::table('tarjeta_gift_card')
       ->where('TARJ_MONTO_INICIAL',$monto)
       ->where('TARJ_ESTADO','A')
       ->get();

       $cantGift=DB::table('CantidadGiftCard')
       ->get();
      // dd($giftCreadas);

      return view('giftCard.index',compact('giftCreadas','cantGift'));
    }




    public function IndexVentasGiftCard (){ // pantalla inicial de ventas carga solo el stock de giftcards

        
       $cantGift=DB::table('CantidadGiftCard')
       ->get();
     //  dd($cantGift);
        return view('giftCard.VentaSeleccion',compact('cantGift'));

    }

    public function CargarTablaCodigosVenta($monto){ //carga las giftcards seleccionadas en la tabla para posterios venta
        //dd($monto);

        $giftCreadas=DB::table('tarjeta_gift_card')
       ->where('TARJ_MONTO_INICIAL',$monto)
       ->where('TARJ_ESTADO','A')
       ->get();

       $cantGift=DB::table('CantidadGiftCard')
       ->get();
      // dd($giftCreadas);

      return view('giftCard.VentaSeleccion',compact('giftCreadas','cantGift'));
    }

    public function CargarVenta(Request $request){//  carga las giftcar seleccionadas en la pantalla para rellenar los datos de la venta 
      if(empty($request->all())){                  // caso contrario si se recarga devolvera  a la seleccion de giftcards
        //dd('nulo');
        $cantGift=DB::table('CantidadGiftCard')
        ->get();

        return view('giftCard.VentaSeleccion',compact('cantGift'));
      }

     // dd('no es nulo');
     // dd($request->tarjetas);
       //$collection = Collection::make($request->tarjetas);
       //dd($collection);

       $vender = DB::table('tarjeta_gift_card')
                    ->whereIn('TARJ_CODIGO',$request->tarjetas )
                    ->get();
                    
                 // dd($request->tarjetas,$vender);

        return view('giftCard.VentaGiftCard.VentaForm',compact('vender'));
    }

    

    public function VenderGiftcard(Request $request){  // captura los datos de la pantalla de asociacion de tarjetas con el cliente 
        //dd($request->all());                         // luego de eso deja las tarjetas vigentes para su posterior venta 
       $params_array= $request->all();
        //dd($request->all());
        $validate = \Validator::make($params_array,[
            // 'Desde' =>'required',
            // 'hasta' =>'required',
            'nombreComprador' =>'required',
            'RutComprador'=>'required',
            // 'FechaVencimiento'=>'required',
        ]);
        

        if($validate->fails()){

            $cantGift=DB::table('CantidadGiftCard')
            ->get();
            $errors = $validate->errors();
            Session::flash('error','Algo ha salido mal intentalo nuevamente');
           return view('giftCard.VentaSeleccion',compact('errors','cantGift'));



        }else{

            $TarjetasSeleccionadas = DB::table('tarjeta_gift_card')
                    ->whereIn('TARJ_CODIGO',$request->Codigos )
                    ->get();
            $cantidad = count($TarjetasSeleccionadas);
            //dd($cantidad);
                $Ncodigos=$request->Codigos;
                $date = Carbon::now();
       
                $date->addMonth(6);
                $date = $date->format('Y-m-d');
                
                try{
                DB::transaction(function () use ($TarjetasSeleccionadas,$Ncodigos,$date,$params_array,$cantidad) {
                    $j=0;
                        for ($i = 1; $i <= $cantidad; $i++)  {
                           
                            $updates = DB::table('tarjeta_gift_card')
                                ->where('TARJ_CODIGO', '=',$Ncodigos[$j])
                                ->where('TARJ_ESTADO','=','A')
                                ->update([
                                    'TARJ_FECHA_VENCIMIENTO' => $date,
                                    'TARJ_COMPRADOR_NOMBRE' => $params_array['nombreComprador'],
                                    'TARJ_COMPRADOR_RUT'=>$params_array['RutComprador'],
                                    'TARJ_ESTADO'=>'V'
                                ]);
                                $j=$j+1;
                        }
                       
                            
                    }); // acepta un numero que es la cantidad de veces q intenta hacer el procedimietno 

                }catch(Exception $e){
                    DB::rollBack();
                    $cantGift=DB::table('CantidadGiftCard')
                    ->get();
                   
                    Session::flash('error','Algo ha salido mal intentalo nuevamente');
                    dd($e);
                    return view('giftCard.VentaSeleccion',compact('cantGift'));

                } catch (\Throwable $e) {
                    DB::rollBack();
                    dd($e);
                    $cantGift=DB::table('CantidadGiftCard')
                    ->get();
                    Session::flash('error','Algo ha salido mal intentalo nuevamente');
                    // dd($e,'2catch');
                    return view('giftCard.VentaSeleccion',compact('cantGift'));
                }
                $cantGift=DB::table('CantidadGiftCard')
                ->get();


                Session::flash('success','Tarjetas Vendidas con Exito!!!');
                return view('giftCard.imprecion',compact('cantGift','TarjetasSeleccionadas'));
        }

    }
















    public function BloqueoTarjetasIndex(){

        return view('giftCard.BloqueoTargetas');
    }



    



























    public function BloqueoTarjetas(Request $request){
        dd($request->all());


    }










































    public function imprimir($giftcard){
        dd($giftcard);
       // dd($request->all());
        // $oculto = $request->oculto;
        // dd($oculto);

    }







    




















































     public  function ean13_check_digit($digits){
        //first change digits to a string so that we can access individual numbers
       //dd($digits);
        $digits =(string)$digits;
        $lengCadena= strlen($digits);
        $iteracion= 12-$lengCadena;
        $ceros='';
        for ($i =1 ; $i <= $iteracion; $i++) {
        $ceros .=''.'0';
        }
        //dd($ceros);

        $digits=$ceros.$digits;

        //dd($digits);
        // 1. Add the values of the digits in the even-numbered positions: 2, 4, 6, etc.
        $even_sum = $digits{1} + $digits{3} + $digits{5} + $digits{7} + $digits{9} + $digits{11};
        // 2. Multiply this result by 3.
        $even_sum_three = $even_sum * 3;
        // 3. Add the values of the digits in the odd-numbered positions: 1, 3, 5, etc.
        $odd_sum = $digits{0} + $digits{2} + $digits{4} + $digits{6} + $digits{8} + $digits{10};
        // 4. Sum the results of steps 2 and 3.
        $total_sum = $even_sum_three + $odd_sum;
        // 5. The check character is the smallest number which, when added to the result in step 4,  produces a multiple of 10.
        $next_ten = (ceil($total_sum/10))*10;
        $check_digit = $next_ten - $total_sum;
        return $digits . $check_digit;
    
    
    }


}
