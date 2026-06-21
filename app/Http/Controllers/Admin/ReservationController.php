<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['utilisateur', 'vehicule', 'conducteur'])->orderByDesc('date_reservation')->get();
        return view('admin.reservations.index', compact('reservations'));
    }
}
