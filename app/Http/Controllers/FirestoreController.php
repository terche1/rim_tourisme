<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Cloud\Firestore\FirestoreClient;
class FirestoreController extends Controller
{
  public function testFirestore()
  {
    // Initialize Firestore
$firestore = new FirestoreClient([
  'projectId' => 'pfe1-4c9de',
]);

// Test connection by retrieving data from Firestore
$documents = $firestore->collection('ville')->documents();

// Array to hold Firestore document data
$documentDataArray = [];

foreach ($documents as $document) {
  // Add document data to the array
  $documentDataArray[] = $document->data();
}

// Convert the array to a JSON string
$jsonData = json_encode($documentDataArray);

// Output the JSON data
echo $jsonData;
}
}