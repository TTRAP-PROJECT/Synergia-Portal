<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationsController extends Controller
{

    public function getAllReservationByUser(Request $request)
    {
        if(Auth::check())
        {
            $userId = Auth::user()->getKey();

            // Récupérer toutes les réservations de l'utilisateur avec les informations importantes du service
            $reservations = Reservation::with('service')
                ->where('IDACHETEUR', $userId)
                ->get();

            // Compter le nombre de réservations par service
            $reservationCounts = $reservations->groupBy('IDSERVICE')
                ->map(function ($group) {
                    return $group->count();
                });

            return view('reservations', compact('reservations', 'reservationCounts'));
        }
        else
        {
            return response()->json("utilisateur non connecté");
        }
    }


}
