<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tamañoemp extends Model
{
    protected $table = 'tamañoemp';
    protected $primaryKey='id_Tamaño_Emp';
    public $timestamps = false;


    protected $fillable = [
        'Tipo_Tamaño'

    ];
}
