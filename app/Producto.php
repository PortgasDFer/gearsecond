<?php

namespace AbarrotesSys;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'codebar';
    public $incrementing = false;
    protected $fillable = ['codebar','desc','total','pcompra','pventa','filtro','baja','unidad'];
}
