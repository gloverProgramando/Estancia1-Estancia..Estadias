<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEmpresa extends Model
{
    protected $table = 'user_empresa';

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'id_empresa');
    }
}
