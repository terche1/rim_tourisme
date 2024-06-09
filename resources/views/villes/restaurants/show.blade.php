<!DOCTYPE html>
<html>
<head>
    <title>Détails du restaurant</title>
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
    <h1>Détails du restaurant</h1>
  
      <a href="{{ route('villes.show', $villeId) }}" class="back-btn">Retour à la liste des restaurants</a>
      <br>
      <br>
      <div class="detail">
      <label>Nom :</label>
      <p>{{ $restaurant['nom'] }}</p>
    </div>

    <div class="detail">
    <label>Description :</label>
    <p>{{ $restaurant['description'] }}</p>
  </div>
    <div class="detail">
    <label>Localisation:</label>
    <p><p>{{ $restaurant['localisation']->latitude() . ', ' . $restaurant['localisation']->longitude() }}</p></p>
    </div>
    <div class="detail">
    <label>Photo :</label>
    <p><img src="{{ $restaurant['photo'] }}" ></p>
    </div>
      </div>
</body>
</html>
