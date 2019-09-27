<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Vendedor extends Authenticatable
{
    protected $table="vendedores";

     public $timestamps = false;  
}
