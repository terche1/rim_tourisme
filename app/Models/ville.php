<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Google\Cloud\Firestore\FirestoreClient;

class ville extends Model
{ 
  protected $fillable = ['nom', 'type', 'localisation', 'photo', 'distance', 'id'];

  public static function getFirebase()
  {
      return app('Firebase');
  }
   // Utilisez Firestore pour accéder à Firestore
   public static function collection()
   {
       // Créez une instance du client Firestore
       $firestore = new FirestoreClient();

       // Retournez la collection Firestore
       return $firestore->collection('ville');
   }
}
