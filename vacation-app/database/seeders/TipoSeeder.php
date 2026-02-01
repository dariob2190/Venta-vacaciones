<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tipo;

class TipoSeeder extends Seeder
{
    public function run()
    {
        $tipos = ['Luxury Beach', 'Exotic Adventure', 'Urban Retreat', 'Romantic Getaway', 'Safari'];
        foreach ($tipos as $nombre) {
            Tipo::firstOrCreate(['nombre' => $nombre]);
        }
    }
}
