<?php

namespace App\Modelos\ProductosEnTrancito;

use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{

    protected $table = 'producto';

    protected $primaryKey = 'ARCODI';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'ARCODI','ARCBAR','ARDESC',
    ];

    public function scopeCodigo($query, $codigo)
    {

        if($codigo ){
            return $query->where('ARCODI', $codigo);
        }

    }

    public function scopeCodigoBarra($query, $codigoBarra)
    {
        if($codigoBarra ){
            return $query->where('ARCBAR', $codigoBarra);
        }

    }

    public function scopeDescripcion($query, $descripcion)
    {
        if($descripcion){
    // return $query->orWhereLike('descripcion',$descripcion)->take(10);
            return $query->where('ARDESC','like', '%'.$descripcion.'%')->take(10);
        }

    }

    public function scopeSelectItems($query)
    {

            return $query->select('ARCODI AS codigo_producto ','ARCBAR  AS codigoBarra','ARDESC AS descripcion');


    }

}
