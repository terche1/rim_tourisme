<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }
    public function home()
    {
      $user = session('user');

    return view('home', ['user' => $user]);
    }
    public function login(Request $request)
    {
        // Valider les données
        $validator = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        try {
            // Authentification Firebase
            $firebaseAuth = Firebase::auth();
            $signInResult = $firebaseAuth->signInWithEmailAndPassword($request->email, $request->password);

            // Récupérer les informations sur l'utilisateur connecté
            $user = $signInResult->data();

            // Journaliser les données utilisateur pour vérifier la structure
            Log::info('User Data:', $user);
// Enregistrer l'utilisateur dans la session
session(['user' => $user]);
           // Rediriger vers la route 'home' après une connexion réussie
        return redirect()->route('home');
        } catch (\Exception $e) {
            Session::flash('error', 'La connexion a échouée: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
