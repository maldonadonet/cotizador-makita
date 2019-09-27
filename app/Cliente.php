<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\vendedor;

class Cliente extends Model
{
    protected $table = 'clientes';
    
    public function vendedores() {
        return $this->belongsTo(Vendedor::class);
    }

    public function cotizaciones(){
        return $this->hasMany(Cotizacion::class);
    }
      
    
}
