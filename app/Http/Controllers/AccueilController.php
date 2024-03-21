<?php

namespace App\Http\Controllers;

use App\Models\ANNONCE;
use App\Models\AvoteSondage;
use App\Models\Sondage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccueilController extends Controller
{

    public function get_donnees_accueil(Request $request)
    {
        $sondages = Sondage::all();
        $annonces = ANNONCE::all();

        return view('dashboard', compact('annonces', 'sondages'));
    }


    public function votePour(Request $request, int $idSondage)
    {
        try {
            // Vérifier si l'utilisateur est authentifié
            if (Auth::check()) {
                // Récupérer l'ID de l'utilisateur authentifié
                $userId = Auth::user()->getKey(); // Obtient l'ID de l'utilisateur

                // Vérifier si l'utilisateur a déjà voté pour ce sondage
                $voteExist = AvoteSondage::where('IDSONDAGE', $idSondage)
                    ->where('IDUTILISATEUR', $userId)
                    ->exists();

                // Si l'utilisateur a déjà voté, renvoyer à la page précédente avec un message d'erreur
                if ($voteExist) {
                    return redirect()->back()->withErrors(['error'=>'Vous avez déjà voté pour ce sondage.','idSondage'=>$idSondage]);
                }

                $sondage = Sondage::findOrFail($idSondage);
                $sondage->increment('POUR');
                $sondage->save();

                AvoteSondage::create([
                    'IDSONDAGE' => $idSondage,
                    'IDUTILISATEUR' => $userId,
                ]);

                // Redirection vers le tableau de bord avec un message de succès
                return redirect()->route('dashboard')->with('success', 'Votre vote a été enregistré avec succès.')->with('idSondage', $idSondage);
            } else {
                // Redirection vers le tableau de bord avec un message d'erreur
                return redirect()->route('dashboard')->withErrors(['error' => 'Vous devez être connecté pour voter.']);
            }
        } catch (\Exception $e) {
            // Redirection vers le tableau de bord avec un message d'erreur
            return redirect()->route('dashboard')->withErrors(['error' => 'Une erreur est survenue lors de l\'enregistrement de votre vote.']);
        }
    }


    public function voteContre(Request $request, int $idSondage)
    {
        try {
            // Vérifier si l'utilisateur est authentifié
            if (Auth::check()) {
                // Récupérer l'ID de l'utilisateur authentifié
                $userId = Auth::user()->getKey(); // Obtient l'ID de l'utilisateur

                // Vérifier si l'utilisateur a déjà voté pour ce sondage
                $voteExist = AvoteSondage::where('IDSONDAGE', $idSondage)
                    ->where('IDUTILISATEUR', $userId)
                    ->exists();

                // Si l'utilisateur a déjà voté, renvoyer à la page précédente avec un message d'erreur
                if ($voteExist) {
                    return redirect()->back()->withErrors(['error'=>'Vous avez déjà voté pour ce sondage.','idSondage'=>$idSondage]);
                }

                $sondage = Sondage::findOrFail($idSondage);
                $sondage->increment('CONTRE');
                $sondage->save();

                AvoteSondage::create([
                    'IDSONDAGE' => $idSondage,
                    'IDUTILISATEUR' => $userId,
                ]);

                // Redirection vers le tableau de bord avec un message de succès
                return redirect()->route('dashboard')->with('success', 'Votre vote a été enregistré avec succès.')->with('idSondage', $idSondage);
            } else {
                // Redirection vers le tableau de bord avec un message d'erreur
                return redirect()->route('dashboard')->withErrors(['error' => 'Vous devez être connecté pour voter.']);
            }
        } catch (\Exception $e) {
            // Redirection vers le tableau de bord avec un message d'erreur
            return redirect()->route('dashboard')->withErrors(['error' => 'Une erreur est survenue lors de l\'enregistrement de votre vote.']);
        }
    }


}
