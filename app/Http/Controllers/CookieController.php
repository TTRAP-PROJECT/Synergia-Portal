<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importez la facade Auth
use App\Models\UTILISATEUR; // Assurez-vous d'importer le modèle User

class CookieController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Récupérez l'utilisateur connecté
        $cookieCount = $user->NBCOOKIES ?? 0; // Utilisez NBCOOKIES pour obtenir le nombre de cookies
        return view('pageCookie', compact('cookieCount'));
    }

    public function click(Request $request)
    {
        $user = Auth::user(); // Récupérez l'utilisateur connecté
        $accumulatedCookies = $request->input('count', 0); // Récupérez le nombre de cookies accumulés depuis la requête
        $user->increment('NBCOOKIES', $accumulatedCookies); // Incrémentez le nombre de cookies
        return response()->json(['success' => true]);
    }

}
