<!DOCTYPE html>
<html>
<head>
    <title>Détails de l'hôtel</title>
      <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h1 {
            color: #333;
        }

        .detail {
            margin-bottom: 20px;
        }

        .detail label {
            font-weight: bold;
        }

        .detail p {
            margin-top: 0;
        }
        
        .detail img {
            max-width: 20%;
            height: auto;
            display: block;
            margin-top: 10px;
        }

        .back-btn {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            margin-top: 20px;
        }

        .back-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
  <div class="container">
    <h1>Détails de l'hôtel</h1>
  
      <a href="{{ route('villes.show', $villeId) }}" class="back-btn">Retour à la liste des hôtels</a>
      <br>
      <br>
      <div class="detail">
      <label>Nom :</label>
      <p>{{ $hotelData['nom'] }}</p>
    </div>

    <div class="detail">
    <label>Categorie:</label>
    <p>{{ $hotelData['categorie'] }}</p>
  </div>
     <div class="detail">
            <label>Localisation:</label>
            @if(is_array($hotelData['localisation']))
                <p>{{ $hotelData['localisation']['latitude'] . ', ' . $hotelData['localisation']['longitude'] }}</p>
            @elseif(is_string($hotelData['localisation']))
                @php
                    list($latitude, $longitude) = explode(',', $hotelData['localisation']);
                @endphp
                <p>{{ $latitude . ', ' . $longitude }}</p>
            @else
                <p>Localisation inconnue</p>
            @endif
        </div>
    <div class="detail">
    <label>Image:</label>
    <p><img src="{{ $hotelData['photo'] }}" ></p>
    </div>
      </div>
</body>
</html>
