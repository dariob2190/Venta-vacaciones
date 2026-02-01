<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservaController extends Controller
{
    public function index()
    {
        $reservas = Reserva::where('id_user', Auth::id())
            ->with(['vacacion.fotos'])
            ->latest()
            ->paginate(10);
            
        return view('user.reservas', compact('reservas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_vacacion' => 'required|exists:vacacions,id',
        ]);

        $exists = Reserva::where('id_user', Auth::id())
            ->where('id_vacacion', $request->id_vacacion)
            ->exists();

        if ($exists) {
            return back()->with('error', 'You already have a reservation for this package.');
        }

        try {
            Reserva::create([
                'id_user' => Auth::id(),
                'id_vacacion' => $request->id_vacacion,
            ]);
            return back()->with('success', 'Reservation made successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error making the reservation.');
        }
    }

    public function destroy($id)
    {
        $reserva = Reserva::findOrFail($id);
        
        if ($reserva->id_user !== Auth::id() && !in_array(Auth::user()->rol, ['admin', 'advanced'])) {
            return back()->with('error', 'You do not have permission to cancel this reservation.');
        }

        try {
            $reserva->delete();
            return back()->with('success', 'Reservation cancelled successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error cancelling the reservation.');
        }
    }
}
