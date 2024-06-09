<?php

namespace App\Http\Controllers;
use App\Models\Ville;
use App\Models\Hotel;
use App\Models\Restaurant;
use App\Models\Lieu;
use Illuminate\Http\Request;
use Google\Cloud\Firestore\FirestoreClient;
use Google\Cloud\Firestore\FieldValue;
use Illuminate\Support\Facades\Validator;

class VilleController extends Controller
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
      $villes = Ville::collection()->documents();
      $villesData = [];

      foreach ($villes as $ville) {
          $villeData = $ville->data();

          // Vérifiez que les clés existent avant de les utiliser
          $villeData['nom'] = $villeData['nom'] ?? 'Nom inconnu';
          $villeData['type'] = $villeData['type'] ?? 'Type inconnu';
          $villeData['localisation'] = $villeData['localisation'] ?? 'Localisation inconnue';
          $villeData['distance'] = $villeData['distance'] ?? 'Distance inconnue';
          $villeData['photo'] = isset($villeData['photo']) ? '<img src="' . $villeData['photo'] . '" alt="' . $villeData['nom'] . '">' : 'Photo indisponible';

          $villesData[] = $villeData;
      }

      return view('villes.index')->with('villesData', $villesData);
  }
  public function create()
  {
      return view('villes.ajouter');
  }
  public function store(Request $request)
{
    $data = $request->validate([
        'nom' => 'required|string|max:255',
        'type' => 'required|string|max:255',
        'localisation' => 'required|string',
        'photo' => 'required|string',
        'distance' => 'required|string',
    ]);

    $data['id'] = Ville::collection()->newDocument()->id();
    Ville::collection()->document($data['id'])->set($data);

    // Rediriger vers la liste des villes après l'ajout
    return redirect()->route('villes.index')->with('success', 'Ville ajoutée avec succès');
} 
public function show($id)
{
    $villeRef = $this->firestore->collection('ville')->document($id);
    $ville = $villeRef->snapshot()->data();

    $hotels = $this->formatSubCollection($villeRef->collection('hotels')->documents());
    $lieux = $this->formatSubCollection($villeRef->collection('lieux')->documents());
    $restaurants = $this->formatSubCollection($villeRef->collection('restaurants')->documents());

    // Utilisez $id pour passer la variable $villeId à la vue
    return view('villes.show', compact('ville', 'hotels', 'lieux', 'restaurants', 'id'));
}

private function formatSubCollection($documents)
{
    $formattedData = [];
    foreach ($documents as $document) {
        $data = $document->data();
        // Assurez-vous que chaque hôtel a une clé 'id'
        $data['id'] = $document->id();
        if (isset($data['localisation']) && $data['localisation'] instanceof \Google\Cloud\Core\GeoPoint) {
            $data['localisation'] = $data['localisation']->latitude() . ', ' . $data['localisation']->longitude();
        }
        $formattedData[] = $data;
    }
    return $formattedData;
}
public function edit($id)
{
    $ville = ville::collection()->document($id)->snapshot();

    if (!$ville->exists()) {
        return redirect()->route('villes.index')->with('error', 'Ville non trouvée');
    }

    return view('villes.update', ['ville' => $ville->data()]);
}
public function update(Request $request, $id)
{
    // Valider les données reçues
    $request->validate([
        'nom' => 'required|string|max:255',
        'type' => 'required|string|max:255',
        'localisation' => 'required|string',
        'photo' => 'required|string',
        'distance' => 'required|string',
    ]);

    // Construire un tableau associatif pour les données à mettre à jour
    $updateData = [
        ['path' => 'nom', 'value' => $request->input('nom')],
        ['path' => 'type', 'value' => $request->input('type')],
        ['path' => 'localisation', 'value' => $request->input('localisation')],
        ['path' => 'photo', 'value' => $request->input('photo')],
        ['path' => 'distance', 'value' => $request->input('distance')],
    ];

    // Mettre à jour le document dans Firestore
    Ville::collection()->document($id)->update($updateData);

    // Rediriger avec un message de succès
    return redirect()->route('villes.index')->with('success', 'Ville mise à jour avec succès');
}
public function destroy($id)
{
    Ville::collection()->document($id)->delete();

    // Rediriger vers la liste des villes après la suppression 
    return redirect()->route('villes.index')->with('success', 'Ville supprimée avec succès');
}
//gestion des hotels
public function showHotel($villeId, $hotelId)
{
    try {
        $hotelRef = $this->firestore->collection('ville')->document($villeId)->collection('hotels')->document($hotelId);
        $hotelSnapshot = $hotelRef->snapshot();
        
        if (!$hotelSnapshot->exists()) {
            return redirect()->route('villes.show', $villeId)->with('error', 'Hôtel non trouvé');
        }
        
        $hotelData = $hotelSnapshot->data();
        // Assurez-vous que chaque hôtel a une clé 'id'
        $hotelData['id'] = $hotelSnapshot->id();

        return view('villes.hotels.show', compact('hotelData', 'villeId'));
    } catch (\Exception $e) {
        return redirect()->route('villes.show', $villeId)->with('error', 'Une erreur s\'est produite lors de la récupération des données de l\'hôtel');
    }
}

public function createHotel($villeId)
{
  $default= "0.000000, 0.000000";
    return view('villes.hotels.create', compact('villeId' , 'default'));
}

public function storeHotel(Request $request, $villeId)
{
    // Valider les données du formulaire
    $validatedData = $request->validate([
        'nom' => 'required|string|max:255',
        'categorie' => 'required|string|max:255',
        'localisation' => 'required|string',
        'photo' => 'required|string',
    ]);

    // Créer un nouvel hôtel pour cette ville
    $hotelRef = $this->firestore->collection('ville')->document($villeId)->collection('hotels')->newDocument();
    $hotelRef->set($validatedData);

    // Rediriger avec un message de succès
    return redirect()->route('villes.show', $villeId)->with('success', 'Hôtel ajouté avec succès');
}
public function editHotel($villeId, $hotelId)
{
    $hotelSnapshot = $this->firestore->collection('ville')->document($villeId)->collection('hotels')->document($hotelId)->snapshot();
    $hotel = $hotelSnapshot->data();

    if (empty($hotel)) {
        return redirect()->route('villes.show', $villeId)->with('error', 'Hôtel non trouvé');
    }

    if (isset($hotel['localisation']) && $hotel['localisation'] instanceof \Google\Cloud\Core\GeoPoint) {
        $geoPoint = $hotel['localisation'];
        $hotel['localisation'] = $geoPoint->latitude() . ', ' . $geoPoint->longitude();
    }

    // Passer l'hôtel sous forme d'objet plutôt que de tableau
    $hotelObject = (object) $hotel;

    return view('villes.hotels.edit', compact('hotelObject', 'villeId', 'hotelId'));
}
public function updateHotel(Request $request, $villeId, $hotelId)
{
    // Valider les données du formulaire
    $validatedData = $request->validate([
        'nom' => 'required|string|max:255',
        'categorie' => 'required|string|max:255',
        'localisation' => 'required|string',
        'photo' => 'required|string',
    ]);

    try {
        // Mettre à jour l'hôtel dans Firestore
        $this->firestore
            ->collection('ville')
            ->document($villeId)
            ->collection('hotels')
            ->document($hotelId)
            ->set($validatedData, ['merge' => true]);  // Utilisation de 'merge' pour ne pas écraser les champs existants

        // Rediriger avec un message de succès
        return redirect()->route('villes.show', $villeId)->with('success', 'Hôtel mis à jour avec succès');
    } catch (\Exception $e) {
        // En cas d'erreur, rediriger avec un message d'erreur
        return redirect()->route('villes.show', $villeId)->with('error', 'Une erreur s\'est produite lors de la mise à jour de l\'hôtel');
    }
}
public function destroyHotel($villeId, $hotelId)
{
    $this->firestore->collection('ville')->document($villeId)->collection('hotels')->document($hotelId)->delete();

    // Rediriger avec un message de succès
    return redirect()->route('villes.show', $villeId)->with('success', 'Hôtel supprimé avec succès');
}

//gestion restaurant
public function showRestaurant($villeId, $restaurantId)
{
    try {
        $restaurant = $this->firestore->collection('ville')->document($villeId)->collection('restaurants')->document($restaurantId)->snapshot()->data();
        
        if (!$restaurant) {
            return redirect()->route('villes.show', $villeId)->with('error', 'Restaurant non trouvé');
        }
        
        return view('villes.restaurants.show', compact('restaurant', 'villeId', 'restaurantId'));
    } catch (\Exception $e) {
        return redirect()->route('villes.show', $villeId)->with('error', 'Une erreur s\'est produite lors de la récupération des données du restaurant');
    }
}

public function createRestaurant($villeId)
{
    // Créez une variable pour les coordonnées de localisation pré-remplies
    $defaultLocalisation = "0.000000, 0.000000"; // Par défaut, vous pouvez changer ces valeurs selon vos besoins

    // Passez la variable villeId et les coordonnées de localisation à la vue
    return view('villes.restaurants.create', compact('villeId', 'defaultLocalisation'));
}

public function storeRestaurant(Request $request, $villeId)
{
    $validatedData = $request->validate([
        'nom' => 'required|string|max:255',
        'description' => 'nullable|string',
        'localisation' => 'required|string',
        'photo' => 'nullable|string',
    ]);

    $restaurantRef = $this->firestore->collection('ville')->document($villeId)->collection('restaurants')->newDocument();
    $restaurantRef->set($validatedData);

    return redirect()->route('villes.show', $villeId)->with('success', 'Restaurant ajouté avec succès');
}

public function editRestaurant($villeId, $restaurantId)
{
    $restaurant = $this->firestore->collection('ville')->document($villeId)->collection('restaurants')->document($restaurantId)->snapshot()->data();
  
    if (!$restaurant) {
        return redirect()->route('villes.show', $villeId)->with('error', 'Restaurant non trouvé');
    }

    return view('villes.restaurants.edit', compact('restaurant', 'villeId', 'restaurantId'));
}

public function updateRestaurant(Request $request, $villeId, $restaurantId)
{
    $validatedData = $request->validate([
        'nom' => 'required|string|max:255',
        'description' => 'nullable|string',
        'localisation' => 'required|string',
        'photo' => 'nullable|string',
    ]);

    $this->firestore->collection('ville')->document($villeId)->collection('restaurants')->document($restaurantId)->set($validatedData);

    return redirect()->route('villes.show', $villeId)->with('success', 'Restaurant mis à jour avec succès');
}

public function destroyRestaurant($villeId, $restaurantId)
{
    $this->firestore->collection('ville')->document($villeId)->collection('restaurants')->document($restaurantId)->delete();

    return redirect()->route('villes.show', $villeId)->with('success', 'Restaurant supprimé avec succès');
}

// Méthode pour afficher un lieu avec ses commentaires et likes
public function showLieu($villeId, $lieuId)
{
    // Récupérer les données du lieu
    $lieuRef = $this->firestore->collection('ville')->document($villeId)->collection('lieux')->document($lieuId);
    $lieu = $lieuRef->snapshot()->data();

    // Vérifier si le lieu existe
    if (empty($lieu)) {
        return redirect()->route('villes.show', $villeId)->with('error', 'Lieu non trouvé');
    }

    // Récupérer les commentaires du lieu
    $comments = $lieuRef->collection('comments')->documents();
    $commentsList = [];
    foreach ($comments as $comment) {
        $commentsList[] = $comment->data();
    }

    // Récupérer les likes du lieu
    $likes = $lieuRef->collection('likes')->documents();
    $likesList = [];
    foreach ($likes as $like) {
        $likesList[] = $like->data();
    }

    // Afficher la vue avec les données du lieu, les commentaires et les likes
    return view('villes.lieux.show', [
        'lieu' => $lieu,
        'comments' => $commentsList,
        'likes' => $likesList,
        'villeId' => $villeId,
        'lieuId' => $lieuId,
    ]);
}

// Méthode pour créer un nouveau lieu

public function createLieu(Request $request, $villeId)
{
    // Validation des données du lieu
    $validator = Validator::make($request->all(), [
        'nom' => 'required|string|max:255',
        'categorie' => 'required|string|max:255',
        'description' => 'required|string',
        'photo' => 'required|string|url',
    ]);

    // Redirection en cas d'erreur de validation
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Création du lieu
    $lieuData = [
        'nom' => $request->input('nom'),
        'categorie' => $request->input('categorie'),
        'description' => $request->input('description'),
        'photo' => $request->input('photo'),
    ];

    $this->firestore->collection('ville')->document($villeId)->collection('lieux')->add($lieuData);

    // Redirection avec un message de succès
    return redirect()->route('villes.show', $villeId)->with('success', 'Lieu créé avec succès');
}

// Méthode pour afficher le formulaire de modification d'un lieu
public function editLieu($villeId, $lieuId)
{
    // Récupérer les données du lieu
    $lieuRef = $this->firestore->collection('ville')->document($villeId)->collection('lieux')->document($lieuId);
    $lieu = $lieuRef->snapshot()->data();

    // Vérifier si le lieu existe
    if (empty($lieu)) {
        return redirect()->route('villes.show', $villeId)->with('error', 'Lieu non trouvé');
    }

    // Afficher la vue de modification du lieu
    return view('villes.lieux.edit', [
        'lieu' => $lieu,
        'villeId' => $villeId,
        'lieuId' => $lieuId,
    ]);
}

// Méthode pour mettre à jour les informations d'un lieu
public function updateLieu(Request $request, $villeId, $lieuId)
{
    // Validation des données du lieu
    $validator = Validator::make($request->all(), [
        'nom' => 'required|string|max:255',
        'categorie' => 'required|string|max:255',
        'description' => 'required|string',
        'photo' => 'required|string|url',
    ]);

    // Redirection en cas d'erreur de validation
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Mise à jour des informations du lieu
    $lieuRef = $this->firestore->collection('ville')->document($villeId)->collection('lieux')->document($lieuId);
    $lieuRef->update([
      ['path' => 'nom', 'value' => $request->input('nom')],
      ['path' => 'categorie', 'value' => $request->input('categorie')],
      ['path' => 'description', 'value' => $request->input('description')],
      ['path' => 'photo', 'value' => $request->input('photo')],
  ]);

    // Redirection avec un message de succès
    return redirect()->route('villes.show',  $villeId)->with('success', 'Lieu mis à jour avec succès');
}

// Méthode pour supprimer un lieu
public function destroyLieu($villeId, $lieuId)
{
    // Suppression du lieu
    $this->firestore->collection('ville')->document($villeId)->collection('lieux')->document($lieuId)->delete();

    // Redirection avec un message de succès
    return redirect()->route('villes.show', $villeId)->with('success', 'Lieu supprimé avec succès');
}


}

