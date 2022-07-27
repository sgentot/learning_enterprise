<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmOrder extends Model
{
    use HasFactory;
    /**
     * Nombre de la tabla de la base de datos.
     * Database table name.
     */
    protected $table = 'cm_order';
    /**
     * Indicamos si los ids son auto incrementales.
     * Indicates if the IDs are auto-incrementing.
     * @var bool si true id autoincrementeal, si false no.
     */
    public $incrementing = true;
    /**
     * Por defecto Eloquent  asume que existe una clave primaria llamada id,
     * si este no es nuesto caso lo tenemos que indicar en la variable $primaryKey.
     * Eloquent asumes tha a primary key called id exists by default,
     * if it isn't our case we have to write the name in the var class $primaryKey.
     */
    protected $primaryKey = 'idorder';
 
    /**
     * Indicamos si el modelo tiene campos de tiempo de creación y actualización.
     * Indicates if the model should be timestamped.
     * @var bool
     */
    public $timestamps = true;
 
    /**
     * Definimos los campos de la tabla directamente en la variable de tipo array $fillable.
     * We define the fields of the table in the var $fillable directly.
     */
    protected $fillable =  array( 'idcustomer', 'order', 'ordertype',
                                  'description', 'units',
                                  'totalprice',
                                  'taxes', 'address');
}