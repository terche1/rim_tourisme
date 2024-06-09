<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Google\Cloud\Firestore\FirestoreClient;
class Restaurant extends Model
{
    use HasFactory;
    

    protected $fillable = [
        'nom', 'description', 'localisation', 'photo'
    ];

    // Vous pouvez également ajouter des relations avec d'autres modèles si nécessaire
    // Par exemple, une relation avec la ville
    public function ville()
    {
        return $this->belongsTo(Ville::class);
    }
}
