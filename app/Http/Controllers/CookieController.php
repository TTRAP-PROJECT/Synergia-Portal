<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importez la facade Auth
use App\Models\Utilisateur; // Assurez-vous d'importer le modèle User

class CookieController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Récupérez l'utilisateur connecté
//        $money=$user->SOLDE;
        $cookieCount = $user->NBCOOKIES ?? 0; // Utilisez NBCOOKIES pour obtenir le nombre de cookies
        return view('pageCookie', compact('cookieCount',));
    }

    public function click(Request $request)
    {
        $user = Auth::user(); // Récupérez l'utilisateur connecté
        $accumulatedCookies = $request->input('count', 0); // Récupérez le nombre de cookies accumulés depuis la requête
        $user->increment('NBCOOKIES', $accumulatedCookies);
        return response()->json(['success' => true]);
    }

    public function echangeCookieMonnaie(Request $request)
    {
        $user = Auth::user();
        $message = ""; // Initialiser la variable message

        $transactionAmount = $request->input('transaction_amount', 0); // Récupérez le montant de la transaction depuis la requête

        $soldeCookie=$user->NBCOOKIES;

        if ($transactionAmount == 1000) {
            if($soldeCookie<1000)
            {
                $message = "Vous n'avez pas assez de cookie :(";
                return redirect()->route('pageCookie')->with('fail', $message);
            }
            else
            {
                // Si la transaction est de 10000 cookies
                $user->increment('SOLDE', 10);
                $user->decrement('NBCOOKIES', 1000);
                $message = "Transaction de 1000 cookies effectuée avec succès.";
            }
        } elseif ($transactionAmount == 10000) {
            if($soldeCookie<10000)
            {
                $message = "Vous n'avez pas assez de cookie :(";
                return redirect()->route('pageCookie')->with('fail', $message);
            }
            else
            {
                // Si la transaction est de 10000 cookies
                $user->increment('SOLDE', 100);
                $user->decrement('NBCOOKIES', 10000);
                $message = "Transaction de 10000 cookies effectuée avec succès.";
            }


        }


        return redirect()->route('pageCookie')->with('success', $message);
    }

}
