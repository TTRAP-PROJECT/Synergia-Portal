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

    public function annulerReservation(Request $request)
    {

        if (Auth::check()) {

            $reservationId = $request->input('idService');

            $reservation = Reservation::find($reservationId);

            if ($reservation) {

                if ($reservation->IDACHETEUR === Auth::user()->IDUTILISATEUR) {

                    $reservation->delete();

                    return redirect()->route('getReservations')->with('success', 'La réservation a été annulée avec succès.');
                } else {
                    return redirect()->route('services')->with('error', 'Vous n\'êtes pas autorisé à annuler cette réservation.');
                }
            } else {
                  return redirect()->route('services')->with('error', 'La réservation à annuler n\'existe pas.');
            }
        } else {
               return redirect()->route('login')->with('error', 'Vous devez être connecté pour annuler une réservation.');
        }
    }

}
