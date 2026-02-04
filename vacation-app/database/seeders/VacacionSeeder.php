<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vacacion;
use App\Models\Tipo;
use App\Models\Foto;

class VacacionSeeder extends Seeder
{
    public function run()
    {
        $lujo = Tipo::where('nombre', 'Luxury Beach')->first();
        $aventura = Tipo::where('nombre', 'Exotic Adventure')->first();
        $urbano = Tipo::where('nombre', 'Urban Retreat')->first();
        $romantico = Tipo::where('nombre', 'Romantic Getaway')->first();

        if ($lujo) {
            $v = Vacacion::create([
                'titulo' => 'Private Villa in Maldives',
                'descripcion' => 'Escape to a world of endless blue. Stay in an overwater villa with private pool, personal butler, and exclusive access to the coral reef. Includes sunset cruise and spa treatments.',
                'precio_por_persona' => 4500,
                'id_tipo' => $lujo->id,
                'pais' => 'Maldives',
                'ciudad' => 'Malé',
                'duracion_dias' => 7,
                'itinerario' => "Day 1: Arrival by seaplane.\nDay 2: Snorkeling safari.\nDay 3: Sunset cruise.\nDay 4: Spa day.\nDay 5: Private beach dinner.\nDay 6: Leisure time.\nDay 7: Departure."
            ]);
        }

        if ($romantico) {
            $v = Vacacion::create([
                'titulo' => 'Santorini Cliffside Suites',
                'descripcion' => 'Watch the world famous sunset from your private jacuzzi suitable for honeymooners. Experience the white and blue magic of Oia with private wine tasting tours.',
                'precio_por_persona' => 3200,
                'id_tipo' => $romantico->id,
                'pais' => 'Greece',
                'ciudad' => 'Oia',
                'duracion_dias' => 5,
                'itinerario' => "Day 1: Arrival and check-in.\nDay 2: Wine tasting tour.\nDay 3: Sunset catamaran cruise.\nDay 4: Exploration of Fira.\nDay 5: Departure."
            ]);
        }

        if ($urbano) {
            $v = Vacacion::create([
                'titulo' => 'Kyoto Luxury Ryokan',
                'descripcion' => 'Immerse yourself in Japanese tradition with modern luxury. Kaiseki dinner, private onsen, and bamboo forest tours included. A zen experience like no other.',
                'precio_por_persona' => 2800,
                'id_tipo' => $urbano->id,
                'pais' => 'Japan',
                'ciudad' => 'Kyoto',
                'duracion_dias' => 6,
                'itinerario' => "Day 1: Arrival in Kyoto.\nDay 2: Kinkaku-ji and bamboo forest.\nDay 3: Tea ceremony.\nDay 4: Fushimi Inari Taisha.\nDay 5: Nara day trip.\nDay 6: Departure."
            ]);
        }

        if ($urbano) {
            $v = Vacacion::create([
                'titulo' => 'Parisian Elegance',
                'descripcion' => 'Stay in the heart of Paris with a view of the Eiffel Tower. Champagne tasting, private Louvre tour, and dinner at 3-star Michelin restaurants.',
                'precio_por_persona' => 2500,
                'id_tipo' => $urbano->id,
                'pais' => 'France',
                'ciudad' => 'Paris',
                'duracion_dias' => 4,
                'itinerario' => "Day 1: Arrival and welcome dinner.\nDay 2: Louvre Museum private tour.\nDay 3: Seine river cruise.\nDay 4: Departure."
            ]);
        }
        
        if ($aventura) {
             $v = Vacacion::create([
                'titulo' => 'Aspen Ski Chalet',
                'descripcion' => 'World-class skiing meets 5-star comfort. Private chef, ski-in/ski-out access, and evening spa treatments. The ultimate winter wonderland experience.',
                'precio_por_persona' => 3800,
                'id_tipo' => $aventura->id,
                'pais' => 'USA',
                'ciudad' => 'Aspen',
                'duracion_dias' => 7,
                'itinerario' => "Day 1: Arrival and equipment fitting.\nDay 2: Skiing lessons.\nDay 3: Full day skiing.\nDay 4: Spa relaxation.\nDay 5: Snowmobile tour.\nDay 6: Apres-ski party.\nDay 7: Departure."
            ]);
        }

        if ($lujo) {
            $v = Vacacion::create([
               'titulo' => 'Dubai Royal Suite',
               'descripcion' => 'Experience the impossible in Dubai. Stay in a suite in the clouds, desert safari in a G-Wagon, and private yacht cruise around the Palm.',
               'precio_por_persona' => 5500,
               'id_tipo' => $lujo->id,
               'pais' => 'UAE',
               'ciudad' => 'Dubai',
               'duracion_dias' => 5,
               'itinerario' => "Day 1: Arrival and Burj Khalifa visit.\nDay 2: Desert safari.\nDay 3: Yacht cruise.\nDay 4: Gold Souk shopping.\nDay 5: Departure."
           ]);
       }
    }
}
