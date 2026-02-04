<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacacion extends Model
{
    use HasFactory;

    protected $table = 'vacacions';

    protected $fillable = [
        'titulo',
        'descripcion',
        'precio_por_persona',
        'id_tipo',
        'pais',
        'ciudad',
        'duracion_dias',
        'itinerario',
    ];

    public function tipo()
    {
        return $this->belongsTo(Tipo::class, 'id_tipo');
    }

    public function fotos()
    {
        return $this->hasMany(Foto::class, 'id_vacacion');
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'id_vacacion');
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'id_vacacion');
    }

    public function getUrlAttribute()
    {
        $foto = $this->fotos->first();
        
        if (!$foto) {
            return 'https://placehold.co/800x600?text=No+Image';
        }

        // Check if file exists in storage, if not return placeholder
        if (str_starts_with($foto->ruta, 'http')) {
            return $foto->ruta;
        }

        if (file_exists(public_path('storage/' . $foto->ruta))) {
             return asset('storage/' . $foto->ruta);
        }

        return 'https://placehold.co/800x600?text=No+Image';
    }
}
