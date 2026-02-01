<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    use HasFactory;

    protected $table = 'tipos';

    protected $fillable = [
        'nombre',
    ];

    public function vacacions()
    {
        return $this->hasMany(Vacacion::class, 'id_tipo');
    }
}
