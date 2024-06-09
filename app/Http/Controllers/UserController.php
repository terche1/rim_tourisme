<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Cloud\Firestore\FirestoreClient;
use Kreait\Firebase\Factory;



class UserController extends Controller
{
  protected $firestore;



    public function __construct()
    {
        $this->firestore = new FirestoreClient([
            'projectId' => 'pfe1-4c9de', // Remplacez par l'ID de votre projet Firestore
        ]);
    }
  

  public function index()
  {
    $usersRef = $this->firestore->collection('users');
    $documents = $usersRef->documents();
    $users = [];

    foreach ($documents as $document) {
        if ($document->exists()) {
            $data = $document->data();
            $data['userId'] = $document->id(); // Ajoutez l'ID du document comme userId
            $users[] = $data;
        }
    }

      return view('users.index', compact('users'));
  }

  public function show($id)
  {
      $userRef = $this->firestore->collection('users')->document($id);
      $snapshot = $userRef->snapshot();

      if ($snapshot->exists()) {
          $user = $snapshot->data();
          return view('users.show', compact('user'));
      }

      return redirect()->route('users.index')->with('error', 'Utilisateur non trouvé.');
  }

  public function edit($id)
  {
      $userRef = $this->firestore->collection('users')->document($id);
      $snapshot = $userRef->snapshot();

      if ($snapshot->exists()) {
          $user = $snapshot->data();
          $user['id'] = $id; 
          return view('users.edit', compact('user'));
      }

      return redirect()->route('users.index')->with('error', 'Utilisateur non trouvé.');
  }

  public function update(Request $request, $id)
  {
      $userRef = $this->firestore->collection('users')->document($id);
      $userRef->set($request->all());

      return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès.');
  }

  public function destroy($id)
  {
      $userRef = $this->firestore->collection('users')->document($id);
      $userRef->delete();

      return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès.');
  }
}
