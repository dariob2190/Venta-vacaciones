<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComentarioController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_vacacion' => 'required|exists:vacacions,id',
            'texto' => 'required|string|max:1000',
        ]);

        // Verify reservation exists
        $hasReserved = Reserva::where('id_user', Auth::id())
            ->where('id_vacacion', $request->id_vacacion)
            ->exists();

        if (!$hasReserved) {
            return back()->with('error', 'You must book the package to comment.');
        }

        try {
            Comentario::create([
                'id_user' => Auth::id(),
                'id_vacacion' => $request->id_vacacion,
                'texto' => $request->texto,
            ]);
            return back()->with('success', 'Comment added.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error posting the comment.');
        }
    }

    public function update(Request $request, $id)
    {
        $comentario = Comentario::findOrFail($id);

        if ($comentario->id_user !== Auth::id()) {
            return back()->with('error', 'You do not have permission to edit this comment.');
        }

        $request->validate([
            'texto' => 'required|string|max:1000',
        ]);

        try {
            $comentario->update(['texto' => $request->texto]);
            return back()->with('success', 'Comment updated.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error updating the comment.');
        }
    }

    public function destroy($id)
    {
        $comentario = Comentario::findOrFail($id);

        if ($comentario->id_user !== Auth::id()) {
            return back()->with('error', 'You do not have permission to delete this comment.');
        }

        try {
            $comentario->delete();
            return back()->with('success', 'Comment deleted.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting the comment.');
        }
    }
}
