<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Google\Cloud\Firestore\FirestoreClient;
class Hotel extends Model
{
  protected $fillable = ['nom', 'categorie', 'photo'];

  // Relation avec la ville
  public function ville()
  {
      return $this->belongsTo(Ville::class);
  }
}
