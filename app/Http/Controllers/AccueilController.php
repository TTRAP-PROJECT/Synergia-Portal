<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\AvoteSondage;

use App\Models\POSTER_SONDAGE;
use App\Models\Cinema;
use App\Models\EvenementSportif;
use App\Models\Sondage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccueilController extends Controller
{

    public function get_donnees_accueil(Request $request)
    {
        $aujourdhui = Carbon::now();
        $sondages = Sondage::actif()->get();

        foreach ($sondages as $sondage) {
            $nombrePour = AvoteSondage::where('IDSONDAGE', $sondage->IDSONDAGE)->where('AVIS', 'POUR')->count();
            $nombreContre = AvoteSondage::where('IDSONDAGE', $sondage->IDSONDAGE)->where('AVIS', 'CONTRE')->count();
            $sondage->POUR = $nombrePour;
            $sondage->CONTRE = $nombreContre;
        }


        $annonces=Annonce::all();


        $sports = EvenementSportif::whereHas('s_e_r_v_i_c_e', function ($query) use ($aujourdhui) {
            $query->where('DATEPREVUE', '>', $aujourdhui)
                ->where('IDSTATUT', '=', 1);
        })->get();

        $cinemas = Cinema::where('DATEHEUREFILM', '>', $aujourdhui)
            ->whereHas('s_e_r_v_i_c_e', function ($query) {
                $query->where('IDSTATUT', '=', 1);
            })
            ->get();




        $events = $sports->merge($cinemas)->sortByDesc(function ($event) {
            return $event instanceof \App\Models\CINEMA ? $event->DATEHEUREFILM : $event->DATEEVENT;
        });

        $events = $events->take(4);

        // Retourner la vue avec les annonces et les sondages mis à jour
        return view('dashboard', compact( 'sondages','events','annonces'));
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
                    return redirect()->back()->withErrors(['error' => 'Vous avez déjà voté pour ce sondage.', 'idSondage' => $idSondage]);
                }

                // Insérer le vote dans la table A_VOTE_SONDAGE
                AvoteSondage::create([
                    'IDSONDAGE' => $idSondage,
                    'IDUTILISATEUR' => $userId,
                    'AVIS' => 'POUR' // Ou 'CONTRE' selon le cas
                ]);
                Auth::user()->increment('SOLDE', 10);
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

            if (Auth::check()) {

                $userId = Auth::user()->getKey(); // Obtient l'ID de l'utilisateur

                $voteExist = AvoteSondage::where('IDSONDAGE', $idSondage)
                    ->where('IDUTILISATEUR', $userId)
                    ->exists();

                if ($voteExist) {
                    return redirect()->back()->withErrors(['error' => 'Vous avez déjà voté pour ce sondage.', 'idSondage' => $idSondage]);
                }

                // Insérer le vote dans la table A_VOTE_SONDAGE
                AvoteSondage::create([
                    'IDSONDAGE' => $idSondage,
                    'IDUTILISATEUR' => $userId,
                    'AVIS' => 'CONTRE' // Ou 'CONTRE' selon le cas
                ]);

                Auth::user()->increment('SOLDE', 10);
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
    public function createSondageVue(Request $request)
    {
        if (Auth::check())
        {
            return view('sondageForm');
        }
        else
        {
            return redirect()->route('dashboard')->withErrors(['error' => 'Vous devez être connecté pour créer un sondage.']);
        }
    }
    public function createSondage(Request $request)
    {

            if (Auth::check()) {
                $userId = Auth::user()->IDUTILISATEUR;


                $dateDebut = now();

                $dateFin = now()->addDays($request->number);

                Sondage::create([
                    'NOMSONDAGE' => $request->nomSondage,
                    'IDUTILISATEUR'=>$userId,
                    'DATEDEBUT' => $dateDebut,
                    'DATEFIN' => $dateFin
                ]);
                $message='Votre sondage a bien été posté.';

//                    var_dump($request->nomSondage." ".$userId." ".$dateDebut." ".$dateFin);
//die();

                return redirect()->route('dashboard')->with('success', 'message');
            } else {
                // Redirection vers le tableau de bord avec un message d'erreur
                return redirect()->route('dashboard')->withErrors(['error' => 'Vous devez être connecté pour voter.']);
            }

    }



}
