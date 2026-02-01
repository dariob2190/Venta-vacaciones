<?php

namespace App\Http\Controllers;

use App\Models\Vacacion;
use App\Models\Tipo;
use Illuminate\Http\Request;

class VacacionController extends Controller
{
    public function index(Request $request)
    {
        $query = Vacacion::with(['tipo', 'fotos']);

        if ($request->has('titulo') && $request->titulo != '') {
            $query->where('titulo', 'like', '%' . $request->titulo . '%');
        }

        if ($request->has('pais') && $request->pais != '') {
             $query->where('pais', 'like', '%' . $request->pais . '%');
        }

        if ($request->has('id_tipo') && $request->id_tipo != '') {
            $query->where('id_tipo', $request->id_tipo);
        }

        if ($request->has('precio_min') && $request->precio_min != '') {
            $query->where('precio_por_persona', '>=', $request->precio_min);
        }
        if ($request->has('precio_max') && $request->precio_max != '') {
            $query->where('precio_por_persona', '<=', $request->precio_max);
        }

        $vacacions = $query->paginate(9);
        $tipos = Tipo::all();

        return view('vacaciones.index', compact('vacacions', 'tipos'));
    }

    public function show($id)
    {
        $vacacion = Vacacion::with(['tipo', 'fotos', 'comentarios.user'])->findOrFail($id);
        
        // Check if user has reserved this vacation (for showing/hiding comment form)
        $hasReserved = false;
        if (auth()->check()) {
            $hasReserved = \App\Models\Reserva::where('id_user', auth()->id())
                            ->where('id_vacacion', $id)
                            ->exists();
        }

        $related_vacations = Vacacion::where('id', '!=', $id)
            ->where('id_tipo', $vacacion->id_tipo)
            ->inRandomOrder()
            ->limit(3)
            ->get();

        return view('vacaciones.show', compact('vacacion', 'hasReserved', 'related_vacations'));
    }

    // Admin Methods

    public function adminIndex()
    {
        $vacacions = Vacacion::with('tipo')->paginate(10);
        return view('vacaciones.admin_index', compact('vacacions'));
    }

    public function create()
    {
        $tipos = Tipo::all();
        return view('vacaciones.create', compact('tipos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:100',
            'pais' => 'required|string|max:50',
            'ciudad' => 'required|string|max:50',
            'precio_por_persona' => 'required|numeric|min:0',
            'duracion_dias' => 'required|integer|min:1',
            'descripcion' => 'required|string',
            'itinerario' => 'required|string',
            'id_tipo' => 'required|exists:tipos,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $vacacion = new Vacacion($request->except('foto'));

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('vacaciones', 'private');
            $vacacion->foto = $path;
        }

        $vacacion->save();

        return redirect()->route('vacaciones.admin_index')->with('success', 'Experience created successfully.');
    }

    public function edit($id)
    {
        $vacacion = Vacacion::findOrFail($id);
        $tipos = Tipo::all();
        return view('vacaciones.edit', compact('vacacion', 'tipos'));
    }

    public function update(Request $request, $id)
    {
        $vacacion = Vacacion::findOrFail($id);

        $request->validate([
            'titulo' => 'required|string|max:100',
            'pais' => 'required|string|max:50',
            'ciudad' => 'required|string|max:50',
            'precio_por_persona' => 'required|numeric|min:0',
            'duracion_dias' => 'required|integer|min:1',
            'descripcion' => 'required|string',
            'itinerario' => 'required|string',
            'id_tipo' => 'required|exists:tipos,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'delete_image' => 'nullable|boolean'
        ]);

        $vacacion->fill($request->except(['foto', 'delete_image']));

        if ($request->has('delete_image') && $request->delete_image) {
             $vacacion->foto = null;
        }

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('vacaciones', 'private');
            $vacacion->foto = $path;
        }

        $vacacion->save();

        return redirect()->route('vacaciones.admin_index')->with('success', 'Experience updated successfully.');
    }

    public function destroy($id)
    {
        $vacacion = Vacacion::findOrFail($id);
        $vacacion->delete();

        return redirect()->route('vacaciones.admin_index')->with('success', 'Experience deleted successfully.');
    }
}
