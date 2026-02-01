<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Check role (middleware should handle this, but double check)
        if (auth()->user()->rol === 'user') {
            abort(403);
        }

        $reservas = Reserva::with(['user', 'vacacion'])->latest()->paginate(20);
        $users = User::paginate(20);

        return view('admin.dashboard', compact('reservas', 'users'));
    }
}
