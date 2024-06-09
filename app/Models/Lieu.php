<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lieu extends Model
{
    use HasFactory;

    protected $fillable = [
      'nom', 'categorie', 'description', 'photo'
  ];

  public function ville()
  {
      return $this->belongsTo(Ville::class);
  }
}
