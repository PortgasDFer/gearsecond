<?php

namespace AbarrotesSys;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'ventas';
    protected $primaryKey = 'folio';
    public $incrementing = false;
}
